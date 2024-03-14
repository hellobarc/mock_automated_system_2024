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
    SpeakingTime,
    OfferPrice,
    MockAdvisors,
    StudentsPurhcasedMockTimes
};
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('admin.home');
    }

    public function registerHome()
    {
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

    public function assessorHome()
    {
        return view('assessor.home');
    }

    public function moderatorHome()
    {
        return view('moderator.home');
    }

    public function editorHome()
    {
        return view('editor.home');
    }

    public function accountsHome()
    {
        return view('accounts.home');
    }

    public function invigilatorHome()
    {
        return view('invigilator.home');
    }
}
