<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    StudentRegistration,
    CandidateLog,
    CandidateInfo,
    MockDates,
    PurchasedMock,
    PriceTable,
    speakingTime,
    StudentsPurhcasedMockTimes
};
use DB;

class SpeakingTimeController extends Controller
{
    public function speakingTimeSlots(Request $request){
        // dd($request->all());
        $date = $request->params['date'];
        $branch = $request->params['branch'];
        $getMockDates = MockDates::where('branch' , $branch)
        ->where('date', $date)
        ->first();

        
        $getMockDatesTime = DB::table('speaking_times')
                ->join('mock_dates','speaking_times.mock_date_id', '=', 'mock_dates.id')
                ->where('speaking_times.mock_date_id', $getMockDates->id)
                ->select('speaking_times.*', 'mock_dates.date as date', 'mock_dates.branch')
                ->get();
                
        // dd($request->all(),$getMockDates,$date,$branch,$getMockDatesTime);  

        return response()->json([
            'time_slots' => $getMockDatesTime
        ]);
    }

    public function mockDateTime($id){
        $candidateID = $id;

        // $getMockDate = DB::table('students_purhcased_mock_times as st')
        // ->join('mock_dates', 'mock_dates.id', '=', 'st.mock_dates_id')
        // ->where('st.candidate_logs_id', $candidateID)
        // ->where('st.speaking_time_id', null)
        // ->get();

        $getMockDateWithTime = DB::table('students_purhcased_mock_times as st')
        ->join('mock_dates', 'mock_dates.id', '=', 'st.mock_dates_id')
        ->join('speaking_times','speaking_times.id', '=', 'st.speaking_time_id')
        ->where('st.candidate_logs_id', $candidateID)
        ->get();

        // $getMockDatewithSpeakingTimes = MockDates::where('id',1)->with('SpeakingTimes')->get();
        // $getMockDatewithSpeakingTimes = CandidateLog::where('id', $candidateID)
        //     ->with('BookedMockTime','BookedMockTime.MockDate','BookedMockTime.SpeakingTime')->get();

        $getMockDatewithSpeakingTimes = StudentsPurhcasedMockTimes::where('candidate_logs_id', $candidateID)
        ->where('speaking_time_id', null)->with('MockDate','MockDate.SpeakingTimes')
        ->get();

        $getMockDates = MockDates::where('total_allocation', '<' , 40)
                        ->get();

        // dd($getMockDatewithSpeakingTimes,$getMockDateWithTime,$getMockDates);

        return view('register.studentRegistration.candidateTimeSlots', compact('getMockDatewithSpeakingTimes','getMockDateWithTime','getMockDates'));
    }

    public function newTimeSlot(Request $request){
        $dateId = $request->date_id;
        
    }

    public function mockDateChange(Request $request){
        // dd($request->input());

        $oldDateId = $request->old_date_id;
        $candidateId = $request->candidate_id;
        $NewMockDateId = $request->new_mock_date;

        StudentsPurhcasedMockTimes::where('candidate_logs_id', $candidateId)
                                ->where('mock_dates_id', $oldDateId)
                                ->update([
                                    'mock_dates_id' => $NewMockDateId
                                ]);

        MockDates::where('id', $oldDateId)
                ->decrement('total_allocation',1);

        MockDates::where('id', $NewMockDateId)
                ->Increment('total_allocation',1);
        
        return redirect()->back()->with('success', 'Date Changed');
    }
}
