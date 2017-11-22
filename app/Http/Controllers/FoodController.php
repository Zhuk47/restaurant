<?php

namespace App\Http\Controllers;

use App\Category;
use App\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::orderBy('id', 'asc')->get();
        $categories = Category::orderBy('id', 'asc')->get();

        return view('food', [
            'foods' => $foods,
            'categories' => $categories
        ]);
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'category_id' => '',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('/food')
                ->withInput()
                ->withErrors($validator);
        }

        $food = new Food;
        $food->name = $request->name;
        $food->category_id = $request->category_id;
        $food->price = $request->price;
        $food->save();

        return redirect('/food');
    }

    public function edit(Food $food)
    {
        $categories = Category::orderBy('id', 'asc')->get();

        return view('foodupd', [
            'food' => $food,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Food $food)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'category_id' => '',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('/food')
                ->withInput()
                ->withErrors($validator);
        }

        $food->name = $request->name;
        $food->category_id = $request->category_id;
        $food->price = $request->price;
        $food->save();

        return redirect('/food');
    }

    public function delete(Food $food)
    {
        $food->delete();

        return redirect('/food');
    }

    public function content(Food $food)
    {

    }

    public function addContent()
    {

    }
}
