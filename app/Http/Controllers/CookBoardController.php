<?php

namespace App\Http\Controllers;

use App\Food;
use App\Order;
use Illuminate\Http\Request;

class CookBoardController extends Controller
{
    public function index()
    {
        $orders = Order::where('deleted_at', '=', NULL)->get();
        foreach ($orders as $order)
        {
            foreach ($order->foods as $food)
            {
                $food->name;
            }
        }
       //$foods = Food::orderBy('id', 'asc')->get();
        return view('cookBoard', [
            'orders' => $orders
        ]);
    }


    public function readyFoodInOrder()
    {
        $orders = Order::where('deleted_at', '=', NULL)->get();
        foreach ($orders as $order)
        {
            foreach ($order->foods as $food)
            {
                $food->name;
            }
        }
        //$foods = Food::orderBy('id', 'asc')->get();
        return view('cookBoard', [
            'orders' => $orders
        ]);
    }



    public function ajaxRequest()
    {
        return response()->json(['response' => 'This is POST method']);
    }
}
