<?php

namespace App\Http\Controllers\Register;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{
    StudentRegistration
};

use App\Helpers\Helper;

class StudentRegistrationController extends Controller
{
    public function candidateForm(){
        return view('register.studentRegistration.registrationForm2');
    }

    public function candidateList(){
        $getCandidateData = StudentRegistration::get();
        return view('register.studentRegistration.candidateList');
    }
    public function candidateFormStore(Request $request){
        // dd($request);
        $request->validate([
            'full_name' => 'required|string|max:50',
            'email' => 'required|string|max:50',
            'phone_number' => 'required|string|max:20',
            'branch_name_for_mock' => 'required|max:20',
            'student_source' => 'required|max:20',
            'price' => 'required|max:20'
        ]);

       
        $fullName = $request->full_name;
        $email = $request->email;
        $phoneNumber = $request->phone_number;
        $BranchName = strtoupper($request->branch_name_for_mock);
        $date = $request->date;
        $studentSource = $request->student_source;
        $price = $request->price;

        $time = time();
        $studentID = Helper::UniqueID(5).substr($BranchName,0,1).date('dmy',$time);
        dd($studentID);

        StudentRegistration::create([
            'student_id' => $studentID,
            'full_name' => $fullName,
            'email' => $email,
            'phone_number' => $phoneNumber,
            'branch_name_for_mock' => $BranchName,
            'date' => $date,
            'student_source' => $studentSource,
            'price' => $price
        ]);
        return redirect()->back()->with('success', 'Student Registered');
    }
}
