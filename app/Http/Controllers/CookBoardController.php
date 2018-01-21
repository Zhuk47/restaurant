<?php

namespace App\Http\Controllers;

use App\Food;
use App\Order;

class CookBoardController extends Controller
{
    public function index()
    {
        $orders = Order::where('deleted_at', '=', NULL)->get();
        foreach ($orders as $order) {
            foreach ($order->foods as $food) {
                $food->name;
            }
        }
//       $foods = Food::orderBy('id', 'asc')->get();
        return view('cookBoard', [
            'orders' => $orders
        ]);
    }

    public function readyFoodInOrder(Order $order, Food $food, $created_at)
    {
        $order->foods()->wherePivot('created_at', $created_at)->updateExistingPivot($food->id, ['deleted_at' => date('Y-m-d H:i:s')]);
        foreach ($order->foods as $oneFood) {
            if ($food->id == $oneFood->id) {
                $in = $oneFood->pivot->dateTimeInCook;
                $out = $oneFood->pivot->deleted_at;
                $res = strtotime($out) - strtotime($in);
                $result = date("H:i:s", mktime(0, 0, $res));
                $order->foods()->wherePivot('created_at', $created_at)->updateExistingPivot($food->id, ['timeInCook' => $result]);
            }
        }

        return redirect('/cookboard');
    }

    public function ajaxRequest()
    {
        return response()->json(['response' => 'This is POST method']);
    }
}
