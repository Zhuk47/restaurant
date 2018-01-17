<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkTimeController extends Controller
{
    public function index()
    {
        echo \Auth::user()->name . PHP_EOL;
    }
}
