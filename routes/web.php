<?php

use App\Events\Notify;
use App\Http\Controllers\MenuController;
use App\Models\Notification;
use App\Models\User;
use App\Util\PusherUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Pusher\Pusher;

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
Route::get('/doc', function () {
    return view('doc');
}); // Thêm documentation cho layout

Route::post('/noti', function (Request $req) {
    try {
        $user = null;
        if ($req->has('all')) {
            $user = User::all();
        } else {
            $user = User::find($req->userid);
            if (!$user) return;
        }
        Notification::sendNotifications($user, ['user' => Auth::user()->id, 'message' => $req->message], 'text-from');
    } catch (\Throwable $th) {
        Session::flash('message', "addSuccess");
    }
    return view('home', ['users' => User::all()]);
});

Route::get('/', function (Request $req) {
    return view('home', ['users' => User::all()]);
});

Route::get('/home', function () {
    return redirect('/');
})->name('home');
Auth::routes(['register' => true]);

Route::group(['prefix' => '/cau-hinh'], function () {
    Route::get('/danh-sach', 'App\Http\Controllers\CauhinhsController@index')->name('cauhinh.list'); // Hiển thị danh sách cấu hình
    Route::get('/them-moi', 'App\Http\Controllers\CauhinhsController@create')->name('cauhinh.create'); // Thêm mới cấu hình
    Route::post('/them-moi', 'App\Http\Controllers\CauhinhsController@store')->name('cauhinh.store'); // Xử lý thêm mới cấu hình
    Route::get('/chinh-sua',  'App\Http\Controllers\CauhinhsController@edit')->name('cauhinh.edit'); // Sửa cấu hình
    Route::post('/cap-nhat',  'App\Http\Controllers\CauhinhsController@update')->name('cauhinh.update'); // Xử lý sửa cấu hình
    Route::get('/tim-kiem',  'App\Http\Controllers\CauhinhsController@search')->name('cauhinh.search'); // Xử lý tìm kiếm cấu hình
    Route::post('/xoa', 'App\Http\Controllers\CauhinhsController@destroy')->name('cauhinh.destroy'); // Xử lý xóa cấu hình
    // Route::get('/da-xoa', 'App\Http\Controllers\CauhinhsController@getDeleteCauhinhs')->name('getDeleteCauhinhs'); // Hiển thị danh sách cấu hình đã xóa
    // Route::get('/da-xoa/{id}', 'App\Http\Controllers\CauhinhsController@deletePermanently')->name('deletePermanently'); // Xóa hoàn toàn cấu hình
    // Route::get('/khoi-phuc/{id}', 'App\Http\Controllers\CauhinhsController@restoreDeletedCauhinhs')->name('restoreDeletedCauhinhs'); // Khôi phục cấu hình đã xóa
});

Route::group(['prefix' => '/danh-muc'], function () {
    Route::get('/danh-sach', 'App\Http\Controllers\DanhmucsController@index')->name('danhmuc.list'); // Hiển thị danh sách danh mục chức danh
    Route::get('/them-moi', 'App\Http\Controllers\DanhmucsController@create')->name('danhmuc.create'); // màn hình thêm mới danh mục
    Route::post('/them-moi', 'App\Http\Controllers\DanhmucsController@store')->name('danhmuc.store'); // Xử lý thêm mới danh mục
    Route::get('/chinh-sua', 'App\Http\Controllers\DanhmucsController@edit')->name('danhmuc.edit'); // Màn hình sửa danh mục
    Route::post('/cap-nhat', 'App\Http\Controllers\DanhmucsController@update')->name('danhmuc.update'); // Xử lý sửa danh mục
    Route::get('/xoa', 'App\Http\Controllers\DanhmucsController@destroy')->name('danhmuc.delete'); // Xóa danh mục
    Route::get('/search', 'App\Http\Controllers\DanhmucsController@search')->name('danhmuc.search'); // Tìm kiếm danh mục
});

Route::group(['prefix' => '/chuc-nang',], function () {
    Route::get('/danh-sach', 'App\Http\Controllers\ChucnangsController@index')->name('chucnang.list'); // Hiển thị danh sách chức năng
    Route::get('/them-moi', 'App\Http\Controllers\ChucnangsController@create')->name('chucnang.create'); // Thêm mới chức năng
    Route::post('/them-moi', 'App\Http\Controllers\ChucnangsController@store')->name('chucnang.store'); // Xử lý thêm mới chức năng
    Route::get('/chinh-sua', 'App\Http\Controllers\ChucnangsController@edit')->name('chucnang.edit');; // Cập nhật chức năng
    Route::post('/cap-nhat', 'App\Http\Controllers\ChucnangsController@update')->name('chucnang.update'); // Xử lý cập nhật chức năng
    Route::post('/xoa', 'App\Http\Controllers\ChucnangsController@delete')->name('chucnang.delete'); // Xóa chức năng
    Route::get('/search', 'App\Http\Controllers\ChucnangsController@search')->name('chucnang.search'); // Tìm kiếm chức năng
});

Route::group(['prefix' => '/menu',], function () {
    Route::get('/user-menu', 'App\Http\Controllers\MenuController@getUserMenu')->name('menu.list'); // Lấy menu cho user
    Route::get('/danh-sach', 'App\Http\Controllers\MenuController@index')->name('menu.list'); // Hiển thị danh sách menu
    Route::get('/them-moi', 'App\Http\Controllers\MenuController@create')->name('menu.create'); // Thêm mới menu
    Route::post('/them-moi', 'App\Http\Controllers\MenuController@store')->name('menu.store'); // Xử lý thêm mới menu
    Route::get('/chinh-sua', 'App\Http\Controllers\MenuController@edit')->name('menu.edit');; // Cập nhật menu
    Route::post('/cap-nhat', 'App\Http\Controllers\MenuController@update')->name('menu.update'); // Xử lý cập nhật menu
    Route::post('/cap-nhat-vi-tri', 'App\Http\Controllers\MenuController@updatePos')->name('menu.update.pos'); // Xử lý cập nhật menu
    Route::post('/xoa', 'App\Http\Controllers\MenuController@destroy')->name('menu.delete'); // Xóa menu
});


Route::group(['prefix' => '/nhom'], function () {
    Route::get('/danh-sach', 'App\Http\Controllers\NhomsController@index')->name('nhom.list'); // Hiển thị danh sách nhóm
    Route::get('/them-moi', 'App\Http\Controllers\NhomsController@create')->name('nhom.create'); // Thêm mới nhóm
    Route::post('/them-moi', 'App\Http\Controllers\NhomsController@store')->name('nhom.store'); // Xử lý thêm mới nhóm
    Route::get('/chinh-sua', 'App\Http\Controllers\NhomsController@edit')->name('nhom.edit'); // Cập nhật nhóm
    Route::post('/cap-nhat', 'App\Http\Controllers\NhomsController@update')->name('nhom.update'); // Xử lý cập nhật nhóm
    Route::post('/xoa', 'App\Http\Controllers\NhomsController@deleteAll')->name('nhom.delete'); // Xóa nhóm
    Route::get('/search', 'App\Http\Controllers\NhomsController@search')->name('nhom.search'); // Tìm kiếm nhóm
});

Route::group(['prefix' => '/nhan-vien'], function () {
    Route::get('/danh-sach', 'App\Http\Controllers\NhanviensController@index')->name('nhanvien.list'); // Hiển thị danh sách nhân viên
    Route::get('/them-moi', 'App\Http\Controllers\NhanviensController@create')->name('nhanvien.create'); // màn hình thêm mới nhân viên
    Route::post('/them-moi', 'App\Http\Controllers\NhanviensController@store')->name('nhanvien.store'); // Xử lý thêm mới nhân viên
    Route::get('/chinh-sua', 'App\Http\Controllers\NhanviensController@edit')->name('nhanvien.edit'); // Màn hình sửa nhân viên
    Route::post('/cap-nhat', 'App\Http\Controllers\NhanviensController@update')->name('nhanvien.update'); // Xử lý sửa nhân viên
    Route::post('/xoa', 'App\Http\Controllers\NhanviensController@destroy')->name('nhanvien.delete'); // Xóa  nhân viên
    Route::get('/search', 'App\Http\Controllers\NhanviensController@search')->name('nhanvien.search'); // Tìm kiếm  nhân viên
});

Route::group(['prefix' => '/tai-san'], function () {
    Route::get('/danh-sach', 'App\Http\Controllers\TaisansController@index')->name('taisan.list'); // Hiển thị danh sách tài sản
    Route::get('/them-moi', 'App\Http\Controllers\TaisansController@create')->name('taisan.create'); // Thêm mới tài sản
    Route::post('/them-moi', 'App\Http\Controllers\TaisansController@store')->name('taisan.store'); // Xử lý thêm mới tài sản
    Route::get('/chinh-sua', 'App\Http\Controllers\TaisansController@edit')->name('taisan.edit'); // Cập nhật tài sản
    Route::post('/cap-nhat', 'App\Http\Controllers\TaisansController@update')->name('taisan.update'); // Xử lý cập nhật tài sản
    Route::post('/xoa', 'App\Http\Controllers\TaisansController@destroy')->name('taisan.delete'); // Xóa tài sản
    Route::get('/chuyen', 'App\Http\Controllers\TaisansController@chuyen')->name('taisan.chuyen'); // Chuyển giao tài sản
    Route::post('/chuyen-giao', 'App\Http\Controllers\TaisansController@chuyengiao')->name('taisan.chuyengiao'); // Chuyển giao tài sản
    // Route::get('/search', 'App\Http\Controllers\NhomsController@search')->name('nhom.search'); // Tìm kiếm tài sản
});

Route::group(['prefix' => '/xe'], function () {
    Route::get('/danh-sach', 'App\Http\Controllers\XesController@index')->name('xe.list'); // Hiển thị danh sách xe
    Route::get('/them-moi', 'App\Http\Controllers\XesController@create')->name('xe.create'); // Thêm mới xe
    Route::post('/them-moi', 'App\Http\Controllers\XesController@store')->name('xe.store'); // Xử lý thêm mới xe
    Route::get('/chinh-sua', 'App\Http\Controllers\XesController@edit')->name('xe.edit'); // Cập nhật xe
    Route::post('/cap-nhat', 'App\Http\Controllers\XesController@update')->name('xe.update'); // Xử lý cập nhật xe
    Route::post('/xoa', 'App\Http\Controllers\XesController@destroy')->name('xe.delete'); // Xóa xe
    Route::get('/search', 'App\Http\Controllers\XesController@search')->name('xe.search'); // Tìm kiếm xe
});

Route::group(['prefix' => '/lich-su-sua-chua'], function () {
    Route::get('/danh-sach', 'App\Http\Controllers\LichsusuachuasController@index')->name('lichsusuachua.list'); // Hiển thị danh sách lịch sử sửa chữa
    Route::get('/them-moi', 'App\Http\Controllers\LichsusuachuasController@create')->name('lichsusuachua.create'); // Thêm mới lịch sử sửa chữa
    Route::post('/them-moi', 'App\Http\Controllers\LichsusuachuasController@store')->name('lichsusuachua.store'); // Xử lý thêm mới lịch sử sửa chữa
    Route::get('/chinh-sua', 'App\Http\Controllers\LichsusuachuasController@edit')->name('lichsusuachua.edit'); // Cập nhật lịch sử sửa chữa
    Route::post('/cap-nhat', 'App\Http\Controllers\LichsusuachuasController@update')->name('lichsusuachua.update'); // Xử lý cập nhật lịch sử sửa chữa
    Route::post('/xoa', 'App\Http\Controllers\LichsusuachuasController@destroy')->name('lichsusuachua.delete'); // Xóa lịch sử sửa chữa
    // Route::get('/search', 'App\Http\Controllers\NhomsController@search')->name('nhom.search'); // Tìm kiếm lịch sử sửa chữa
});

Route::group(['prefix' => '/lich-xuat-xe'], function () {
    Route::get('/danh-sach', 'App\Http\Controllers\LichxuatxesController@index')->name('lichxuatxe.list'); // Hiển thị danh sách lịch xuất xe
    Route::get('/them-moi', 'App\Http\Controllers\LichxuatxesController@create')->name('lichxuatxe.create'); // Thêm mới lịch xuất xe
    Route::post('/them-moi', 'App\Http\Controllers\LichxuatxesController@store')->name('lichxuatxe.store'); // Xử lý thêm mới lịch xuất xe
    Route::get('/chinh-sua', 'App\Http\Controllers\LichxuatxesController@edit')->name('lichxuatxe.edit'); // Cập nhật lịch xuất xe
    Route::post('/cap-nhat', 'App\Http\Controllers\LichxuatxesController@update')->name('lichxuatxe.update'); // Xử lý cập nhật lịch xuất xe
    Route::post('/xoa', 'App\Http\Controllers\LichxuatxesController@destroy')->name('lichxuatxe.delete'); // Xóa lịch xuất xe
    // Route::get('/search', 'App\Http\Controllers\NhomsController@search')->name('nhom.search'); // Tìm kiếm lịch xuất xe
});

Route::group(['prefix' => '/u'], function () {
    Route::group(['prefix' => '/nhan-vien'], function () {
        Route::get('/i', 'App\Http\Controllers\u\NhanVienController@getInfo')->name('u.nhanvien.info');
    });
    Route::group(['prefix' => '/thong-bao'], function () {
        Route::get('/doc', 'App\Http\Controllers\u\NotificationController@readNotificationsOfUser')->name('u.thongbao.docthongbao'); // Xác định người dùng đã đọc thông báo
        Route::get('/chua-doc', 'App\Http\Controllers\u\NotificationController@getNotificationOfUser')->name('u.thongbao.chuadoc'); // Lấy thông báo chưa đọc
    });
    Route::group(['prefix' => '/cuoc-hop'], function () {
        Route::get('/them-moi', 'App\Http\Controllers\u\CuocHopController@create')->name('u.cuochop.create');
        Route::post('/them-moi', 'App\Http\Controllers\u\CuocHopController@store')->name('u.cuochop.store');
    });
});
