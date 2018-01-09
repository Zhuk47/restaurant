<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Table;

class OrderController extends Controller
{
    public function create(Table $table)
    {
        if ($table->isFree == 0) {
            $order = new Order;
            $order->table_id = $table->id;
            $order->user_id = \Auth::user()->id;
            $order->save();

            $categories = Category::orderBy('id', 'asc')->get();

            return view('order', [
                'table' => $table,
                'categories' => $categories,
                'order' => $order
            ]);
        }
        else{
            echo "Не может быть больше оного заказа!!!";
        }
    }

    public function update(Table $table, Order $order)
    {

        $categories = Category::orderBy('id', 'asc')->get();

        return view('order_upd', [
            'categories' => $categories,
            'table' => $table,
            'order' => $order
        ]);
    }

    public function info(Table $table)
    {
        return view('/tableinfo', [
            'table' => $table
        ]);
    }
}
