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
    speakingTime
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
}
