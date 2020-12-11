<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\REQUEST;
use Illuminate\Support\Facades\DB;


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


Route::get('/example', function () {
    return view('example');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/list', function(){
    return view('/layouts/default-form/demo');
});

Route::get('/input', function(){
    return view('/layouts/default-form/demo1');
});

Route::group(['prefix' => '/cau-hinh'], function () {
    Route::get('/danh-sach',['as'=>'cauhinh','uses'=> 'App\Http\Controllers\CauhinhsController@index']); // Hiển thị danh sách cấu hình
    Route::get('/them-moi', 'App\Http\Controllers\CauhinhsController@create'); // Thêm mới cấu hình
    Route::post('/them-moi', 'App\Http\Controllers\CauhinhsController@store'); // Xử lý thêm mới cấu hình
    Route::get('/{id}/chinh-sua', 'App\Http\Controllers\CauhinhsController@edit'); // Sửa cấu hình
    Route::post('/cap-nhat', 'App\Http\Controllers\CauhinhsController@update'); // Xử lý sửa cấu hình
    Route::get('/{id}/xoa', 'App\Http\Controllers\CauhinhsController@destroy'); // Xóa cấu hình
});

Route::group(['prefix' => '/chuc-nang'], function () {
    Route::get('/danh-sach', 'App\Http\Controllers\ChucnangsController@index')->name('viewChucNang'); // Hiển thị danh sách chức năng
    Route::get('/them-moi', 'App\Http\Controllers\ChucnangsController@create')->name('add'); // Thêm mới chức năng
    Route::post('/them-moi', 'App\Http\Controllers\ChucnangsController@store')->name('addChucNang'); // Xử lý thêm mới chức năng
    Route::get('/cap-nhat-edit/{id}', 'App\Http\Controllers\ChucnangsController@edit')->name('edit'); // Cập nhật chức năng
    Route::post('/cap-nhat/{id}', 'App\Http\Controllers\ChucnangsController@update')->name('editChucNang'); // Xử lý cập nhật chức năng
    Route::get('/xoa/{id}', 'App\Http\Controllers\ChucnangsController@destroy')->name('xoa'); // Xóa chức năng
});


