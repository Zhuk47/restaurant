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

        return redirect('/food');
    }

    public function content(Food $food)
    {

        $ingredients = $food->ingredients;

        $cost_price = $food->currentNetCost($food);
        $total_weight = $food->currentTotalWeight($food);

        $food->mass = $total_weight;
        $food->save();

        $allIngredients = Ingredient::get();

        return view('/content', [
            'food' => $food,
            'ingredients' => $ingredients,
            'allIngredients' => $allIngredients,
            'cost_price' => $cost_price,
            'total_weight' => $total_weight
        ]);
    }

    public function addIngredient(Food $food, Ingredient $oneIngredient, Request $request)
    {
        $food->ingredients()->attach($oneIngredient->id, ["mass" => $request->mass]);

        return redirect('/food/' . $food->id . '/content');
    }

    public function delIngredient(Food $food, Ingredient $ingredient)
    {
        $ingredient->foods()->detach($food->id);

        return redirect('/food/' . $food->id . '/content');
    }

    public function setPrice(Food $food, Request $request)
    {

        $cost_price = $food->currentNetCost($food);

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
            'food' => $food
        ]);
    }

    public function searchPrice(Request $request, Food $food)
    {
        $prices = FoodPrice::withTrashed()->where('food_id', $food->id)->get();
        foreach ($prices as $price) {
            if ($price->created_at <= $request->date && $request->date <= $price->deleted_at) {
                echo "Стоимость блюда - " . $price->price . " грн. </br>";
                echo "Себестоимость ингредиентов - " . $price->netCost . " грн. </br>";
            } elseif ($price->created_at <= $request->date && $price->deleted_at === null) {
                echo $price->price;
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
