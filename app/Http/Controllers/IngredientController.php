<?php

namespace App\Http\Controllers;

use App\Ingredient;
use App\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::get();
        foreach ($ingredients as $ingredient) {
            $prices = $ingredient->prices->sortByDesc('dateTime')->first();
            return view('ingredient', [
                'ingredients' => $ingredients,
                'prices' => $prices
            ]);
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('/ingredient')
                ->withInput()
                ->withErrors($validator);
        }

        $ingredient = new Ingredient;
        $ingredient->name = $request->name;

        $ingredient->save();

        return redirect('/ingredient/'.$ingredient->id.'/price');
    }

    public function edit(Ingredient $ingredient)
    {
        return view('ingredientupd', ['ingredient' => $ingredient]);
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('/ingredient')
                ->withInput()
                ->withErrors($validator);
        }

        $ingredient->name = $request->name;
        $ingredient->save();
        $price = new Price;
        $price->ingredient_id = $ingredient->id;
        $price->price = $request->price;
        $price->save();

        return redirect('/ingredient');
    }

    public function delete(Ingredient $ingredient)
    {
        $ingredient->prices()->delete();
        $ingredient->delete();

        return redirect('/ingredient');
    }

    public function editPrice(Ingredient $ingredient)
    {
        return view('price', ['ingredient' => $ingredient]);
    }

    public function setPrice(Request $request, Ingredient $ingredient)
    {
        $price = new Price;
        $price->ingredient_id = $ingredient->id;
        $price->price = $request->price;
        $price->save();

        return redirect('/ingredient');
    }
}
