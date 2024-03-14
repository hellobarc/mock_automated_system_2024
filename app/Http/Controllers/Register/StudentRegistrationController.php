<?php

namespace App\Http\Controllers\Register;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\{
    StudentRegistration,
    CandidateLog,
    CandidateInfo,
    MockDates,
    PurchasedMock,
    PriceTable,
    OfferPrice,
    SpeakingTime,
    MockAdvisors,
    StudentsPurhcasedMockTimes
};
use App\Rules\SelectedDates;


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
        $getMockDatesUttara = MockDates::where('branch', 'uttara')
                            ->where('total_allocation','<',40)
                            ->get();
        $getMockDatesMirpur = MockDates::where('branch', 'mirpur')
                            ->where('total_allocation','<',40)
                            ->get();

        // $getMockPrices = DB::table('price_tables')
        //                     ->join('offer_prices','price_tables.id', '=', 'offer_prices.price_table_id')
        //                     ->select('offer_prices.*','price_tables.*','offer_prices.price as offer_price')
        //                     ->where('price_tables.offer_status','active')
        //                     ->get();
        $getMockOffers = OfferPrice::get();

        $getMockAdvisors = MockAdvisors::get();

        return view('register.studentRegistration.registrationForm2', compact('getMockDatesUttara','getMockDatesMirpur','getMockOffers','getMockAdvisors'));
    }

    

    public function candidateFormStore(Request $request){
        dd($request->input());
        DB::beginTransaction();
        try{        
            $request->validate(
                [
                'full_name' => 'required|string|max:50',
                'email' => 'required|string|max:50',
                'phone_number' => 'required|string|max:20',
                'student_source' => 'required|max:20',
                'purpose_of_ielts' => 'required|max:20',
                'selected_dates' => 'required',
                // 'payment_recieved' => 'required|max:20',
                'selected_dates' => ['required', new SelectedDates],
                ]
            );

            
            $selected_dates_form = $request->selected_dates;

            $dates_with_count = array_count_values($selected_dates_form);
            $dates_keys = array_keys($dates_with_count);
            $dates_count = array_values($dates_with_count);
            $selected_dates = [];
            $iterateDates = count($dates_with_count);

            for($i=0 ; $i<$iterateDates ; $i++){
                if($dates_count[$i] % 2 == 0){
                    
                }
                else{
                    array_push($selected_dates, $dates_keys[$i]);
                }
            }

            
            $dates_ids = [];
            foreach($selected_dates as $dates_id){
                $request->validate([
                    'time_Slot-'.$dates_id => 'required'
                ]);
                array_push($dates_ids,'time_Slot-'.$dates_id);
            }

            // dd($selected_dates_form,$dates_with_count, $dates_keys,$iterateDates,$dates_count,$selected_dates);
            $fullName = $request->full_name;
            $email = $request->email;
            $phoneNumber = $request->phone_number;
            $BranchName = $request->branch_name_for_mock;
            $studentSource = $request->student_source;
            $purposeOfIELTS = $request->purpose_of_ielts;
            $price = $request->price;
            $mockNumbers = $request->mock_number;
            $package = $request->package;
            $payment_recieved = $request->payment_recieved;
            $mockOffers = $request->mock_offers;
            $advisor_id = $request->advisor_name; 
            $studentBatchNo = $request->student_batch_no;
            $regular_package = $request->regular; 
            $free_package = $request->free; 
            $offered_package = $request->offered; 

            $time = time();
            $studentID = Helper::UniqueID(5).substr($BranchName,0,1).date('dmy',$time);

            $candidateLog = CandidateLog::create(
                [
                'unique_id' => $studentID,
                'full_name' => $fullName,
                'email' => $email,
                ]
            );

            CandidateInfo::create(
                [
                'candidate_log_id' => $candidateLog->id,
                'advisor_id' => $advisor_id,
                'branch_name_for_mock' => $BranchName,
                'purpose_of_ielts' => $purposeOfIELTS,
                'student_batch_no' => $studentBatchNo,
                'phone_number' => $phoneNumber,
                'student_source' => $studentSource
                ]
            );

            if( $BranchName == 'uttara' ){
                foreach($selected_dates as $dates){
                    MockDates::where('id',$dates)
                            ->where('branch','uttara')
                            ->increment('total_allocation',1);
                }
            }
            else{
                foreach($selected_dates as $dates){
                    MockDates::where('id',$dates)
                            ->where('branch','mirpur')
                            ->increment('total_allocation',1);
                }
            }

            if( $regular_package == 'on'){
                PurchasedMock::create([
                    'package' => 'regular',
                    'number_of_mocks_regular' => $request->number_of_mocks_regular,
                    'total_amount_regular' => $request->total_amount_regular,
                    'payment_recieved_regular' => $request->payment_recieved_regular,
                ]);
            }

            if( $free_package == 'on'){
                PurchasedMock::create([
                    'package' => 'free',
                    'free_number_of_mocks' => $request->free_number_of_mocks,
                    'free_current_batch_no' => $request->free_current_batch_no,
                ]);
            }

            if( $offered_package == 'on' ){
                PurchasedMock::create([
                    'package' => 'offered',
                    'number_of_mocks_offered' => $request->number_of_mocks_offered,
                    'number_of_mocks_offered_free' => $request->number_of_mocks_offered_free,
                    'number_of_mocks_offered_paid' => $request->number_of_mocks_offered_paid,
                    'total_amount_offered' => $request->total_amount_offered,
                    'payment_recieved_offered' => $request->payment_recieved_offered,
                ]);
            }

            $countForSelectedTimeslots = count($dates_ids);

            for($i=0;$i<$countForSelectedTimeslots;$i++){
                $dates_id = explode('-',$dates_ids[$i]);
                // dd($dates_ids[$i]);
                $speakingTimeId = $dates_ids[$i];
                // dd($request->$speakingTimeId);
                StudentsPurhcasedMockTimes::create([
                    'candidate_logs_id' => $candidateLog->id,
                    'mock_dates_id' => $dates_id[1],
                    'speaking_time_id' => $request->$speakingTimeId
                ]);

                SpeakingTime::where('id', $request->$speakingTimeId)
                            ->increment('assinged_count',1);
            }
            DB::commit();

            return redirect()->back()->with('success', 'Student Registered');
        }
        catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('fail', $e);
        }
        
    }

    public function candidateEdit($id){
        $getCandidateData = DB::table('candidate_logs')
                            ->join('candidate_infos','candidate_logs.id','=','candidate_infos.id')
                            ->where('candidate_logs.id', $id)
                            ->select('candidate_logs.*','candidate_infos.*')
                            ->first();

        $getMockDatesUttara = MockDates::where('branch', 'uttara')
                            ->where('total_allocation','<',40)
                            ->get();
        $getMockDatesMirpur = MockDates::where('branch', 'mirpur')
                            ->where('total_allocation','<',40)
                            ->get();

        $getMockPrices = DB::table('price_tables')
                            ->join('offer_prices','price_tables.id', '=', 'offer_prices.price_table_id')
                            ->select('offer_prices.*','price_tables.*','offer_prices.price as offer_price')
                            ->where('price_tables.offer_status','active')
                            ->get();

        return view('register.studentRegistration.candidateEdit', compact('getCandidateData','getMockPrices','getMockDatesMirpur','getMockDatesUttara'));
    }

    public function candidateEditStore(Request $request){
        $studentID = $request->id;

        CandidateLog::where('id', $studentID)
            ->update(
                [
                'full_name' => $request->full_name,
                'email' => $request->email
                ]
            );

        CandidateInfo::where('candidate_log_id', $studentID)
            ->update(
                [
                'purpose_of_ielts' => $request->purpose_of_ielts,
                'phone_number' => $request->phone_number,
                'student_source' => $request->student_source
                ]
            );
        return redirect()->back()->with('success', 'Information Edited Successfully');
    }

    public function candidateDelete($id){
        CandidateLog::find($id)->delete();
        CandidateInfo::find($id)->delete();

        return redirect()->back()->with('success', 'Candidate Deleted Successfully');
    }

    public function purchaseNewMock(Request $request){
        // dd($request->input());

        DB::beginTransaction();
        try{
            $request->validate([
                'package' => 'required',
                'mock_number' => 'required',
                'payment_recieved' => 'required',
                'mock_offers' => 'required',
            ]);

            $candidateLogId = $request->id;
            $BranchName = $request->branch_name;
            $package   = $request->package;
            $mockNumbers = $request->mock_number;
            $payment_recieved = $request->payment_recieved;
            $mockOffers = $request->mock_offers;
            $time = time();


            $selected_dates_form = $request->selected_dates;

            $dates_with_count = array_count_values($selected_dates_form);
            $dates_keys = array_keys($dates_with_count);
            $dates_count = array_values($dates_with_count);
            $selected_dates = [];
            $iterateDates = count($dates_with_count);

            for($i=0 ; $i<$iterateDates ; $i++){
                if($dates_count[$i] % 2 == 0){
                    
                }
                else{
                    array_push($selected_dates, $dates_keys[$i]);
                }
            }

            $dates_ids = [];
            foreach($selected_dates as $dates_id){
                // $request->validate([
                //     'time_Slot-'.$dates_id => 'required'
                // ]);
                array_push($dates_ids,'time_Slot-'.$dates_id);
            }

            if( $BranchName == 'uttara' ){
                foreach($selected_dates as $dates){
                    MockDates::where('id',$dates)
                            ->where('branch','uttara')
                            ->increment('total_allocation',1);
                }
            }
            else{
                foreach($selected_dates as $dates){
                    MockDates::where('id',$dates)
                            ->where('branch','mirpur')
                            ->increment('total_allocation',1);
                }
            }

            $getMockPrices = PriceTable::where('mock_number', $mockNumbers)
                            ->first();
            $payment_total = $getMockPrices->mock_price;

            if(isset($mockOffers)){
                $payment_total = $request->mock_offers;
            }
            
            if($payment_recieved < $payment_total ){
                $due_fees = $payment_total-$payment_recieved;

                PurchasedMock::create(
                    [
                    'candidate_log_id' => $candidateLogId,
                    'mock_number' => $mockNumbers,
                    'date' => date('d-m-y', $time),
                    'payment_status' => 'due',
                    'paid_fees' => $payment_recieved,
                    'due_fees' => $due_fees,
                    'total_fees' => $payment_total,
                    ]
                );
            }
            elseif( $payment_recieved == $payment_total ){
                PurchasedMock::create(
                    [
                    'candidate_log_id' => $candidateLogId,
                    'date' => date('d-m-y', $time),
                    'mock_number' => $mockNumbers,
                    'payment_status' => 'paid',
                    'paid_fees' => $payment_recieved,
                    'total_fees' => $payment_total
                    ]
                );
            }

            $countForSelectedTimeslots = count($dates_ids);

            for($i=0;$i<$countForSelectedTimeslots;$i++){
                $dates_id = explode('-',$dates_ids[$i]);
                // dd($dates_ids[$i]);
                $speakingTimeId = $dates_ids[$i];
                // dd($request->$speakingTimeId);
                StudentsPurhcasedMockTimes::create([
                    'candidate_logs_id' => $candidateLogId,
                    'mock_dates_id' => $dates_id[1],
                    'speaking_time_id' => $request->$speakingTimeId
                ]);

                SpeakingTime::where('id', $request->$speakingTimeId)
                            ->increment('assinged_count',1);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Purchased New Mock');
        }
        catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('fail', $e);
        }
    }


    
}