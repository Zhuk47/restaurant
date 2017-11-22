<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->get();

        return view('category', [
            'categories' => $categories
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('/category')
                ->withInput()
                ->withErrors($validator);
        }

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return redirect('/category');
    }

    public function edit(Category $category)
    {
        return view('categoryupd', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('/category')
                ->withInput()
                ->withErrors($validator);
        }

        $category->name = $request->name;
        $category->save();

        return redirect('/category');
    }

    public function delete(Category $category)
    {
        $category->delete();

        return redirect('/category');
    }
}
