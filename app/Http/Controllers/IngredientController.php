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

        return view('ingredient', [
            'ingredients' => $ingredients
        ]);
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

        return redirect('/ingredient');
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

        return redirect('/ingredient');
    }

    public function delete(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect('/ingredient');
    }
}
