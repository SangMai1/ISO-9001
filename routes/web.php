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
    return view('welcome');
});

Auth::routes(['register' => false]);

<<<<<<< HEAD
Route::get('/list', function(){
    return view('/layouts/default-form/demo');
});

Route::get('/input', function(){
    return view('/layouts/default-form/demo1');
});

=======
Route::get('/sc', function(){ return view('sc'); });
>>>>>>> 793ac84c5a28ff8873a1c43fb12dae93c21ac000

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
