<?php

namespace App\Http\Controllers\Register;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{
    StudentRegistration,
    CandidateLog,
    CandidateInfo,
    MockDates
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
        // dd($getMockDates);
        return view('register.studentRegistration.registrationForm2', compact('getMockDates'));
    }

    
    public function candidateFormStore(Request $request){

        $request->validate([
            'full_name' => 'required|string|max:50',
            'email' => 'required|string|max:50',
            'phone_number' => 'required|string|max:20',
            'branch_name_for_mock' => 'required|max:20',
            'student_source' => 'required|max:20',
            'purpose_of_ielts' => 'required|max:20',
            'price' => 'required|max:20',
            'selected_date' => 'required|string|max:20'
        ]);

        $fullName = $request->full_name;
        $email = $request->email;
        $phoneNumber = $request->phone_number;
        $BranchName = $request->branch_name_for_mock;
        $studentSource = $request->student_source;
        $purposeOfIELTS = $request->purpose_of_ielts;
        $price = $request->price;

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
