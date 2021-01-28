<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestNhanVien;
use App\Models\ChucDanh;
use App\Models\Danhmucs;
use App\Models\HoSoNhanVien;
use App\Models\Nhanviens;
use App\Models\PhongBan;
use App\Models\User;
use App\Models\users;
use App\Util\CommonUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class NhanviensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nhanViens = CommonUtil::readViewConfig(Nhanviens::class, $request)->get();
        $chucDanhs = ChucDanh::all()->pluck("ten","id");

        $phongBans = PhongBan::all()->pluck("ten","id");
        if (Session::get('no-layout') == true) {
            return view('/nhan-vien/danh-sach', compact(['nhanViens','chucDanhs','phongBans']));
        }
        return view('/nhan-vien/danh-sach', compact(['nhanViens','chucDanhs','phongBans']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $chucDanhs = ChucDanh::all()->pluck("ten","id");
        $phongBans = PhongBan::all()->pluck("ten","id");
        return view('/nhan-vien/them-moi',["chucDanhs"=>$chucDanhs,"phongBans"=>$phongBans]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestNhanVien $request)
    {
        $nhanviens = $request->except('id');
        $nhanviens['ma'] = $this->getMaNhanVien();
        try {
            DB::transaction(function() use($nhanviens){
                Nhanviens::create($nhanviens);
                User::create($nhanviens);
            });
            Session::flash('message', "addSuccess");
        } catch (\Throwable $th) {
            Session::flash('message', "addFailed");
        }
        return view('message');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nhanviens  $nhanviens
     * @return \Illuminate\Http\Response
     */
    public function show(Nhanviens $nhanviens)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nhanviens  $nhanviens
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $nhanvien = Nhanviens::find($request->id);
        $chucDanhs = Danhmucs::all()->where('loai',0)->pluck("ten","id");
        $phongBans = Danhmucs::all()->where('loai',1)->pluck("ten","id");
        if (!$nhanvien) return abort(404);
        return view('/nhan-vien/chinh-sua',["chucDanhs"=>$chucDanhs,"phongBans"=>$phongBans,"nhanvien"=>$nhanvien]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nhanviens  $nhanviens
     * @return \Illuminate\Http\Response
     */
    public function update(RequestNhanVien $request)
    {
                $nhanvien = Nhanviens::find($request-> id);
       
        if (!$nhanvien) {
            Session::flash('message', 'notFoundItem');
        } else {
            $nhanvien -> ten = $request -> ten;
            $nhanvien -> ma = $request -> ma;
            $nhanvien -> email = $request -> email;
            $nhanvien -> ngaysinh = $request -> ngaysinh;
            $nhanvien -> gioitinh = $request -> gioitinh;
            $nhanvien -> hesoluong = $request -> hesoluong;
            $nhanvien -> chucdanhid = $request -> chucdanhid;
            $nhanvien -> phongbanid = $request -> phongbanid;
            $nhanvien -> nguoisua = Auth::user()->username;
            Session::flash('message', $nhanvien->update() ? 'updateSuccess' : 'updateFailed');
        }
        return view('message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nhanviens  $nhanviens
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
                
        $id = $request->input('id');
        $result = Nhanviens::find($id)->delete();
        $result1 = users::where('nhanvienid',$id)->delete();
        Session::flash("message", $result && $result1 ? "deleteSuccess" : "deleteFailed");
        return view('message');
    }

    public function getMaNhanVien(){ 
        return 'NV' . DB::table('nhanviens')->max("id");
    }
}
