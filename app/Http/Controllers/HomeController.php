<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('register.home');
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
