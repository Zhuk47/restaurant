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
//        echo "Стол №" . $table->id . "</br>";
        foreach ($table->orders as $order) {
//            echo "Заказ №" . $order->id . "</br>";
//            echo "Официант: " . $order->user->name . " " . $order->user->surname . "</br>";
//            echo "Блюда в заказе: </br>";
            foreach ($order->foods as $food) {
                foreach ($food->foodPrice as $price) {
//                    print_r($food->name . " - " . $price->price . " грн. </br>");

                    return view('/tableinfo', [
                        'table' => $table
                    ]);
                }
            }
        }
    }
}
