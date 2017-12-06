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

Auth::routes();

    Route::get('/home', 'HomeController@index')->name('adminHome');
    Route::get('/register-new-employee', function () {
        return view('adminViews\register');
    });
    Route::get('/base-employee', function () {
        return view('adminViews\employeebase');
    });
    Route::post('/home', 'Auth\RegisterController@create');

    Route::get('/info/{id}', 'AdminController@show');
    Route::get('/delete/{id}', 'AdminController@deleteEmployee')->name('deleteEmployee');


