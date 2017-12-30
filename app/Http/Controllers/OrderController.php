<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Table;

class OrderController extends Controller
{
    public function create(User $user, Table $table)
    {
        $order = new Order;
        $order->table_id = $table->id;
        $order->user_id = $user->id;
        $order->save();

        foreach ($table->orders as $order) {
            echo 'Added!' . " " . $order->id . " " . $table->id . " " . $user->id;
        }
    }
}
