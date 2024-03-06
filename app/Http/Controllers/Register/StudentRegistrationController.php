<?php

namespace App\Http\Controllers\Register;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{
    StudentRegistration,
    CandidateLog,
    CandidateInfo,
    MockDates,
    PuchasedMock,
    PriceTable
};
use DB;

use App\Helpers\Helper;

class StudentRegistrationController extends Controller
{   
    public function candidateList(){
        $getCandidateData = DB::table('candidate_logs')
                            ->join('candidate_infos','candidate_logs.id','=','candidate_infos.id')
                            ->select('candidate_logs.*','candidate_infos.*')
                            ->get();

        return view('register.studentRegistration.candidateList',compact('getCandidateData'));
    }
    
    public function candidateForm(){
        $getMockDates = MockDates::get();
        $getMockPrices = DB::table('price_tables')
            ->join('offer_prices','price_tables.id', '=', 'offer_prices.price_table_id')
            ->select('offer_prices.*','price_tables.*','offer_prices.price as offer_price')
            ->where('price_tables.offer_status','active')
            ->get();
            
        // dd($getMockPrices);
        return view('register.studentRegistration.registrationForm2', compact('getMockDates','getMockPrices'));
    }

    
    public function candidateFormStore(Request $request){

        $request->validate([
            'full_name' => 'required|string|max:50',
            'email' => 'required|string|max:50',
            'phone_number' => 'required|string|max:20',
            'branch_name_for_mock' => 'required|max:20',
            'student_source' => 'required|max:20',
            'purpose_of_ielts' => 'required|max:20',
            'selected_date' => 'required|string|max:20',
            'mock_number' => 'required|max:10',
            'payment_recieved' => 'required|max:20',
        ]);

        $fullName = $request->full_name;
        $email = $request->email;
        $phoneNumber = $request->phone_number;
        $BranchName = $request->branch_name_for_mock;
        $studentSource = $request->student_source;
        $purposeOfIELTS = $request->purpose_of_ielts;
        $price = $request->price;
        $mockNumbers = $request->mock_number;
        $payment_recieved = $request->payment_recieved;
        $mockOffers = $request->mock_offers;
        
        $time = time();
        $studentID = Helper::UniqueID(5).substr($BranchName,0,1).date('dmy',$time);

        $candidateLog = CandidateLog::create([
            'unique_id' => $studentID,
            'full_name' => $fullName,
            'email' => $email,
        ]);

        CandidateInfo::create([
            'candidate_log_id' => $candidateLog->id,
            'branch_name_for_mock' => $BranchName,
            'purpose_of_ielts' => $purposeOfIELTS,
            'phone_number' => $phoneNumber,
            'student_source' => $studentSource
        ]);

        MockDates::create([
            'date' => $request->selected_date,
            'total_allocation' => 2
        ]);

        $getMockPrices = PriceTable::where('mock_number', $mockNumbers)
                        ->first();
        $payment_total = $getMockPrices->mock_price;

        if(isset($mockOffers)){
            $payment_total = $request->mock_offers;
        }
        
        if($payment_recieved < $getMockPrices->mock_price){
            $due_fees = $payment_total-$payment_recieved;

            PurchasedMock::create([
                'candidate_log_id' => $candidateLog->id,
                'mock_number' => $mockNumbers,
                'date' => date('d-m-y', $time),
                'payment_status' => 'due',
                'paid_fees' => $payment_recieved,
                'due_fees' => $due_fees,
                'total_fees' => $payment_total,
            ]);
        }
        elseif($payment_recieved == $getMockPrices->mock_price){
            PurchasedMock::create([
                'candidate_log_id' => $candidateLog->id,
                'date' => date('d-m-y', $time),
                'mock_number' => $mockNumbers,
                'payment_status' => 'paid',
                'paid_fees' => $payment_recieved,
            ]);
        }
        
        return redirect()->back()->with('success', 'Student Registered');
    }

    public function candidateEdit($id){
        $getCandidateData = DB::table('candidate_logs')
                            ->join('candidate_infos','candidate_logs.id','=','candidate_infos.id')
                            ->where('candidate_logs.id', $id)
                            ->select('candidate_logs.*','candidate_infos.*')
                            ->first();
        return view('register.studentRegistration.candidateEdit', compact('getCandidateData'));
    }

    public function candidateEditStore(Request $request){
        $studentID = $request->id;

        CandidateLog::where('id', $studentID)
            ->update([
                'full_name' => $request->full_name,
                'email' => $request->email
            ]);

        CandidateInfo::where('candidate_log_id', $studentID)
            ->update([
                'purpose_of_ielts' => $request->purpose_of_ielts,
                'phone_number' => $request->phone_number,
                'student_source' => $request->student_source
            ]);
        return redirect()->back()->with('success', 'Information Edited Successfully');
    }

    public function candidateDelete($id){
        CandidateLog::find($id)->delete();
        CandidateInfo::find($id)->delete();

        return redirect()->back()->with('success', 'Candidate Deleted Successfully');
    }
}
