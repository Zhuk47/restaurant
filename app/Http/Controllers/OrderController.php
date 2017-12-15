<?php

namespace App\Http\Controllers;

use App\Order;

class OrderController extends Controller
{
    public function create($user_id, $table_id)
    {
        $order = new Order;
        $order->table_id = $table_id;
        $order->user_id = $user_id;
        $order->save();
        echo 'Added!';
    }
}
