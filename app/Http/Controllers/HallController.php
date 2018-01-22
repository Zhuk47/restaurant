<?php
/**
 * Created by PhpStorm.
 * User: Kulibacks
 * Date: 28.11.2017
 * Time: 17:17
 */

namespace App\Http\Controllers;

use App\Order;
use App\Table;

class HallController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $tables = Table::all();
        return (view('hall', ['orders' => $orders], ['tables' => $tables]));
    }

    public function ajax()
    {
        $tables = Table::all();
        $arr = [];
        foreach ($tables as $table) {

            $arr[$table->id] = $table->isFree;
        }
        return $arr;
    }

    public function adminAjax()
    {
        $tables = Table::all();
        $arr = [];
        foreach ($tables as $table) {

            $arr[$table->id] = $table->isFree;
        }
        return $arr;
    }
}