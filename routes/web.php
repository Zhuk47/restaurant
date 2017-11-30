<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::resource('ingredient', 'IngredientController');

Route::get('/ingredient', 'IngredientController@index');
Route::post('/ingredient', 'IngredientController@create');
Route::get('/ingredientupd/{ingredient}', 'IngredientController@edit');
Route::patch('/ingredientupd/{ingredient}', 'IngredientController@update');
Route::delete('/ingredient/{ingredient}', 'IngredientController@delete');
Route::get('/ingredient/{ingredient}/price', 'IngredientController@editPrice');
Route::post('/ingredient/{ingredient}/price', 'IngredientController@setPrice');

Route::get('/food', 'FoodController@index');
Route::post('/food', 'FoodController@create');
Route::delete('/food/{food}', 'FoodController@delete');
Route::get('/foodupd/{food}', 'FoodController@edit');
Route::patch('/foodupd/{food}', 'FoodController@update');
Route::get('/food/{food}/content', 'FoodController@content');
Route::post('/food/{food}/content/{oneIngredient}', 'FoodController@addIngredient');
Route::delete('/food/{food}/content/{ingredient}', 'FoodController@delIngredient');

Route::get('/category', 'CategoryController@index');
Route::post('/category', 'CategoryController@create');
Route::get('/categoryupd/{category}', 'CategoryController@edit');
Route::patch('/categoryupd/{category}', 'CategoryController@update');
Route::delete('/category/{category}', 'CategoryController@delete');