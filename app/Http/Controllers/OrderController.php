<?php

namespace App\Http\Controllers;

use App\Order;
use App\Table;
use App\User;

class OrderController extends Controller
{
    public function create(User $user, Table $table)
    {
        $order = new Order;
        $order->table_id = $table->id;
        $order->user_id = $user->id;
        $order->save();

        foreach ($table->orders as $order) {
            echo 'Added!' . " Номер заказа - " . $order->id . " Номер стола - " . $table->id . " ID официанта - " . $user->id;
        }
    }

    public function info(Table $table)
    {
        return view('/tableinfo', [
            'table' => $table
        ]);
    }
}
