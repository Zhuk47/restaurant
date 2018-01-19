<?php

namespace App\Http\Controllers;

use App\Category;
use App\Food;
use App\FoodPrice;
use App\Ingredient;
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
            'name' => 'required|max:30',
        ]);

        if ($validator->fails()) {
            return redirect('/food')
                ->withInput()
                ->withErrors($validator);
        }

        $food = new Food;
        $food->name = $request->name;
        $food->category_id = $request->category_id;
        $food->save();

        $food_price = new FoodPrice;
        $food_price->food_id = $food->id;
        $food_price->save();

        return redirect('/food')->with('alert', "Блюдо " . $food->name . " категории " . $food->category->name . " добавлено.");
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
            'name' => 'required|max:30',
        ]);

        if ($validator->fails()) {
            return redirect('/foodupd/' . $food->id)
                ->withInput()
                ->withErrors($validator);
        }

        $food->name = $request->name;
        $food->category_id = $request->category_id;
        $food->save();

        return redirect('/food');
    }

    public function delete(Food $food)
    {
        $food->ingredients()->detach();
        $food->foodPrice()->delete();
        $food->delete();

        return redirect('/food')->with('delAlert', "Блюдо " . $food->name . " категории " . $food->category->name . " удалено.");
    }

    public function content(Food $food)
    {
        $ingredients = $food->ingredients;

        $food->mass = $food->currentTotalWeight();
        $food->save();

        $allIngredients = Ingredient::get();

        return view('/content', [
            'food' => $food,
            'ingredients' => $ingredients,
            'allIngredients' => $allIngredients
        ]);
    }

    public function addIngredient(Food $food, Ingredient $oneIngredient, Request $request)
    {
        $food->ingredients()->attach($oneIngredient->id, ["mass" => $request->mass]);

        return redirect('/food/' . $food->id . '/content')->with('alert', "Ингредиент " . $oneIngredient->name . " в количестве " . $request->mass . " г. добавлен.");
    }

    public function delIngredient(Food $food, Ingredient $ingredient)
    {
        $ingredient->foods()->detach($food->id);

        return redirect('/food/' . $food->id . '/content')->with('delAlert', "Ингредиент " . $ingredient->name . " удален.");
    }

    public function savePrice(Food $food, Request $request)
    {
        $cost_price = $food->currentNetCost();

        FoodPrice::where('food_id', $food->id)->delete();
        $food_price = new FoodPrice;
        $food_price->food_id = $food->id;
        $food_price->netCost = $cost_price;
        $food_price->price = $request->price;
        $food_price->save();

        return redirect('/food/' . $food->id . '/content');
    }

    public function history(Food $food)
    {
        $prices = FoodPrice::withTrashed()->where('food_id', $food->id)->get();

        return view('history', [
            'prices' => $prices,
            'food' => $food,
            'min' => $food->getMinDate()
        ]);
    }

    public function searchPrice(Request $request, Food $food)
    {
        $prices = FoodPrice::withTrashed()->where('food_id', $food->id)->get();

        foreach ($prices as $price) {
            $date = str_replace("T", " ", $request->date);
            $created = substr($price->created_at, 0, 19);
            $deleted = substr($price->deleted_at, 0, 19);

            if ($created <= $date && $date <= $deleted) {
                return redirect()->back()->with('history_message', "Стоимость " . $food->name . " на " . $date . " составляла " . $price->price . " грн. Себестоимость ингредиентов - " . $price->netCost . "грн.");
            } elseif ($created <= $date && $deleted == null) {
                return redirect()->back()->with('history_message', "Стоимость " . $food->name . " на " . $date . " составляет " . $price->price . " грн. Себестоимость ингредиентов - " . $price->netCost . "грн.");
            } else null;
        }
    }

    public function menu()
    {
        $categories = Category::orderBy('id', 'asc')->get();

        return view('menu', [
            'categories' => $categories
        ]);
    }
}
