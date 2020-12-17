<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\REQUEST;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CauhinhsController;


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
    Route::get('/danh-sach',[CauhinhsController::class, 'index'])->name('cauhinh.list'); // Hiển thị danh sách cấu hình
    Route::get('/them-moi', [CauhinhsController::class, 'create']); // Thêm mới cấu hình
    Route::post('/luu',  [CauhinhsController::class, 'store']); // Xử lý thêm mới cấu hình
    Route::get('/chinh-sua/{id}',  [CauhinhsController::class, 'edit']); // Sửa cấu hình
    Route::post('/cap-nhat',  [CauhinhsController::class, 'update']); // Xử lý sửa cấu hình
    Route::get('/tim-kiem',  [CauhinhsController::class, 'search']);
    Route::get('/da-xoa', [CauhinhsController::class, 'getDeleteCauhinhs'])->name('getDeleteCauhinhs');
    Route::get('/da-xoa/{id}', [CauhinhsController::class, 'restoreDeletedCauhinhs'])->name('restoreDeletedCauhinhs');
    Route::get('/khoi-phuc/{id}', [CauhinhsController::class, 'deletePermanently'])->name('deletePermanently');
});
Route::resource('cauhinhs', CauhinhsController::class);


