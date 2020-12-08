<?php

use Illuminate\Support\Facades\Route;

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
    return view('example');
});

Auth::routes(['register' => false]);

<<<<<<< HEAD
=======

Route::get('/example', function () {
    return view('example');
});

>>>>>>> e9854c24173bf6978b1bf0420f0a776ed310826a
Route::get('/list', function(){
    return view('/layouts/default-form/demo');
});

Route::get('/input', function(){
    return view('/layouts/default-form/demo1');
});

<<<<<<< HEAD
Route::get('/sc', function(){ return view('sc'); });

=======
>>>>>>> e9854c24173bf6978b1bf0420f0a776ed310826a
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
