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

//Route::get('/', function () {
//    return view('adminViews.home');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('adminHome');

Route::post('/', 'Auth\RegisterController@create');

Route::get('logout', 'Auth\LoginController@logout');

Route::get('/', 'StartPageController@index')->name('start');

Route::group(['middleware' => ['guest']], function () {
    //only guests can access these routes


});

Route::group(['middleware' => ['auth']], function () {
    //only authorized users can access these routes


});

Route::group(['middleware' => ['admin']], function () {
    //only admins can access these routes

    //food routes
    Route::get('/food', 'FoodController@index');
    Route::post('/food', 'FoodController@create');
    Route::delete('/food/{food}', 'FoodController@delete');
    Route::get('/foodupd/{food}', 'FoodController@edit');
    Route::patch('/foodupd/{food}', 'FoodController@update');
    Route::get('/food/{food}/history', 'FoodController@history');
    Route::get('/food/{food}/content', 'FoodController@content');
    Route::post('/food/{food}/content', 'FoodController@setPrice');
    Route::post('/food/{food}/content/{oneIngredient}', 'FoodController@addIngredient');
    Route::delete('/food/{food}/content/{ingredient}', 'FoodController@delIngredient');

    //category routes
    Route::get('/category', 'CategoryController@index');
    Route::post('/category', 'CategoryController@create');
    Route::get('/categoryupd/{category}', 'CategoryController@edit');
    Route::patch('/categoryupd/{category}', 'CategoryController@update');
    Route::delete('/category/{category}', 'CategoryController@delete');

    //ingredient routes
    Route::get('/ingredient', 'IngredientController@index');
    Route::post('/ingredient', 'IngredientController@create');
    Route::get('/ingredientupd/{ingredient}', 'IngredientController@edit');
    Route::patch('/ingredientupd/{ingredient}', 'IngredientController@update');
    Route::delete('/ingredient/{ingredient}', 'IngredientController@delete');
    Route::get('/ingredient/{ingredient}/price', 'IngredientController@editPrice');
    Route::post('/ingredient/{ingredient}/price', 'IngredientController@setPrice');
    Route::get('/ingredient/{ingredient}/history', 'IngredientController@history');

    //employee manage routes
    Route::get('/info/{id}', 'AdminController@show');
    Route::get('/delete/{id}', 'AdminController@deleteEmployee')->name('deleteEmployee');
    Route::get('/register-new-employee', function () {
        return view('adminViews/register');
    });
    Route::get('/base-employee', function () {
        return view('adminViews/employeebase');
    });

    //articles routes
    Route::resource('articles', 'ArticleController');
});

Route::group(['middleware' => ['waiter']], function () {
    //only waiters can access these routes

    //table and orders routes
    Route::get('/user/{user}/hall', 'HallController@index');
    Route::get('/user/{user}/table/{table}', 'OrderController@create');
});

Route::group(['middleware' => ['cook']], function () {
    //only cooks can access these routes


});

Route::get('/guest-registration', function(){
    return view('clientViews/regform');
})->name('clientreg');

Route::post('/addclient', 'GuestController@add');