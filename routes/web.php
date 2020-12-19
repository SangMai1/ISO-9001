<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\REQUEST;
use Illuminate\Support\Facades\Auth;
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

Route::get('/doc', function(){return view('doc');}); // Thêm documentation cho layout
Route::get('/', function () {return view('example');});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes(['register' => false]);
Route::get('/example', function () {return view('example');});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/list', function(){ return view('/layouts/default-form/demo'); });
Route::get('/input', function(){ return view('/layouts/default-form/demo1'); });


Route::group(['prefix' => '/cau-hinh'], function () {
    Route::get('/danh-sach','App\Http\Controllers\CauhinhsController@index')->name('cauhinh.list'); // Hiển thị danh sách cấu hình
    Route::get('/them-moi', 'App\Http\Controllers\CauhinhsController@create'); // Thêm mới cấu hình
    Route::post('/them-moi', 'App\Http\Controllers\CauhinhsController@store'); // Xử lý thêm mới cấu hình
    Route::get('/{id}/chinh-sua', 'App\Http\Controllers\CauhinhsController@edit'); // Sửa cấu hình
    Route::post('/cap-nhat', 'App\Http\Controllers\CauhinhsController@update'); // Xử lý sửa cấu hình
    Route::get('/{id}/xoa', 'App\Http\Controllers\CauhinhsController@destroy'); // Xóa cấu hình
});
Route::group(['prefix' => '/danh-muc'], function () {
    Route::get('/danh-sach', 'App\Http\Controllers\DanhmucsController@index')->name('danhmuc.list'); // Hiển thị danh sách danh mục
    Route::get('/them-moi', 'App\Http\Controllers\DanhmucsController@create')->name('danhmuc.add'); // màn hình thêm mới danh mục
    Route::post('/them-moi', 'App\Http\Controllers\DanhmucsController@store')->name('danhmuc.save'); // Xử lý thêm mới danh mục
    Route::get('/chinh-sua/{id}', 'App\Http\Controllers\DanhmucsController@edit')->name('danhmuc.edit'); // Màn hình sửa danh mục
    Route::post('/cap-nhat', 'App\Http\Controllers\DanhmucsController@update')->name('danhmuc.update'); // Xử lý sửa danh mục
    Route::get('/xoa/{id}', 'App\Http\Controllers\DanhmucsController@destroy')->name('danhmuc.delete'); // Xóa danh mục
    Route::get('/search', 'App\Http\Controllers\DanhmucsController@find')->name('danhmuc.find'); // Tìm kiếm danh mục
});
Route::group(['prefix' => '/chuc-nang'], function () {
    Route::get('/danh-sach', 'App\Http\Controllers\ChucnangsController@index')->name('viewChucNang'); // Hiển thị danh sách chức năng
    Route::get('/them-moi', 'App\Http\Controllers\ChucnangsController@create')->name('add'); // Thêm mới chức năng
    Route::post('/them-moi', 'App\Http\Controllers\ChucnangsController@store')->name('addChucNang'); // Xử lý thêm mới chức năng
    Route::get('/cap-nhat-edit/{id}', 'App\Http\Controllers\ChucnangsController@edit')->name('edit'); // Cập nhật chức năng
    Route::post('/cap-nhat', 'App\Http\Controllers\ChucnangsController@update')->name('editChucNang'); // Xử lý cập nhật chức năng
    Route::post('/xoa', 'App\Http\Controllers\ChucnangsController@deleteAll')->name('xoaChucNang'); // Xóa chức năng
    Route::get('/search', 'App\Http\Controllers\ChucnangsController@search')->name('searchChucNang'); // Tìm kiếm chức năng
});

Route::group(['prefix' => '/nhom'], function () {
    Route::get('/danh-sach', 'App\Http\Controllers\NhomsController@index')->name('viewNhoms'); // Hiển thị danh sách nhóm
    Route::get('/them-moi', 'App\Http\Controllers\NhomsController@create')->name('themnhom'); // Thêm mới nhóm
    Route::post('/them-moi', 'App\Http\Controllers\NhomsController@store')->name('addNhom'); // Xử lý thêm mới nhóm
    Route::get('/cap-nhat-edit/{id}', 'App\Http\Controllers\NhomsController@edit')->name('editnhom'); // Cập nhật nhóm
    Route::post('/cap-nhat', 'App\Http\Controllers\NhomsController@update')->name('editNhom'); // Xử lý cập nhật nhóm
    Route::post('/xoa', 'App\Http\Controllers\NhomsController@deleteAll')->name('xoaNhom'); // Xóa nhóm
    Route::get('/search', 'App\Http\Controllers\NhomsController@search')->name('searchNhom'); // Tìm kiếm nhóm
});

Route::group(['prefix' => '/nhan-vien'], function () {
    Route::get('/danh-sach', 'App\Http\Controllers\NhanviensController@index')->name('nhanvien.list'); // Hiển thị danh sách nhân viên
    Route::get('/them-moi', 'App\Http\Controllers\NhanviensController@create')->name('nhanvien.add'); // màn hình thêm mới nhân viên
    Route::post('/them-moi', 'App\Http\Controllers\NhanviensController@store')->name('nhanvien.save'); // Xử lý thêm mới nhân viên
    Route::get('/chinh-sua/{id}', 'App\Http\Controllers\NhanviensController@edit')->name('nhanvien.edit'); // Màn hình sửa nhân viên
    Route::post('/cap-nhat', 'App\Http\Controllers\NhanviensController@update')->name('nhanvien.update'); // Xử lý sửa nhân viên
    Route::post('/xoa', 'App\Http\Controllers\NhanviensController@destroy')->name('nhanvien.delete'); // Xóa  nhân viên
    Route::get('/search', 'App\Http\Controllers\NhanviensController@find')->name('nhanvien.find'); // Tìm kiếm  nhân viên
    Route::post('/render', 'App\Util\CommonUtil@render')->name('nhanvien.render');
});
