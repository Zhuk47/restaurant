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
        if (!isset($ingredients)) {
            foreach ($ingredients as $ingredient) {
                $prices = $ingredient->prices->sortByDesc('dateTime')->first();
                return view('ingredient', [
                    'ingredients' => $ingredients,
                    'prices' => $prices
                ]);
            }
        } else return view('ingredient', [
            'ingredients' => $ingredients
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return redirect('/ingredient')
                ->withInput()
                ->withErrors($validator);
        }

        $ingredient = new Ingredient;
        $ingredient->name = $request->name;

        $ingredient->save();

        return redirect('/ingredient/' . $ingredient->id . '/price');
    }

    public function edit(Ingredient $ingredient)
    {
        return view('ingredientupd', ['ingredient' => $ingredient]);
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect('/ingredientupd/' . $ingredient->id)
                ->withInput()
                ->withErrors($validator);
        }

        Price::where('ingredient_id', $ingredient->id)->delete();
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
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect('/ingredient/' . $ingredient->id . '/price')
                ->withInput()
                ->withErrors($validator);
        }

        $price = new Price;
        $price->ingredient_id = $ingredient->id;
        $price->price = $request->price;
        $price->save();

        return redirect('/ingredient');
    }

    public function history(Ingredient $ingredient)
    {
        $prices = Price::withTrashed()->where('ingredient_id', $ingredient->id)->get();

        $minPrice = Price::withTrashed()->where('ingredient_id', $ingredient->id)->orderBy('created_at', 'asc')->first();
        $min = substr(str_replace(" ", "T", $minPrice->created_at), 0, 16);

        return view('ingredienthistory', [
            'prices' => $prices,
            'ingredient' => $ingredient,
            'min' => $min
        ]);
    }

    public function searchPrice(Request $request, Ingredient $ingredient)
    {
        $prices = Price::withTrashed()->where('ingredient_id', $ingredient->id)->get();
        foreach ($prices as $price) {
            $date = str_replace("T"," ",$request->date);
            $created = substr($price->created_at, 0, 19);
            $deleted = substr($price->deleted_at, 0, 19);

            if ($created <= $date && $date <= $deleted) {
                return redirect()->back()->with('history_message', "Стоимость ".$ingredient->name." на ".$date." составляла ".$price->price." грн.");
            } elseif ($created <= $date && $deleted == null) {
                return redirect()->back()->with('history_message', "Стоимость ".$ingredient->name." на ".$date." составляет ".$price->price." грн.");
            } else null;
        }
    }
}
