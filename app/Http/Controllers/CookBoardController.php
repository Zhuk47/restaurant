<?php

namespace App\Http\Controllers;

use App\Food;
use App\Order;
use Illuminate\Http\Request;

class CookBoardController extends Controller
{
    public function index()
    {
        //$foods = Food::orderBy('id', 'asc')->get();
        //$categories = Category::orderBy('id', 'asc')->get();

        return view('cookBoard', [
            //'foods' => $foods,
            //'categories' => $categories,
            'csrf_token' => csrf_token()
        ]);
    }

    public function ajaxRequest()
    {
        return response()->json(['response' => 'This is POST method']);
    }
}
