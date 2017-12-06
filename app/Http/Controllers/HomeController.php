<?php

namespace App\Http\Controllers;

use App\User;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->role_id == 1)
        {
            return view('adminViews\home');
        }
        elseif(\Auth::user()->role_id == 2)
        {
            return view('auth\login');

        }
        elseif(\Auth::user()->role_id == 3)
        {
            return view('auth\register');
        }
        return null;
    }
}
