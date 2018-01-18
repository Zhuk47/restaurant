<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class WorkTimeController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('work-time', compact('users'));
    }
}
