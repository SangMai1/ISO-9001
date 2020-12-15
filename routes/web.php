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

Route::get('/a/b', function () {
    return view('example');
});

Auth::routes(['register' => false]);


Route::get('/example', function () {
    return view('example');
});

Route::get('/list', function(){
    return view('/layouts/default-form/demo');
});

Route::get('/input', function(){
    return view('/layouts/default-form/demo1');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/doc', function(){return view('doc');});
