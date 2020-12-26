<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestNhanVien;
use App\Models\Danhmucs;
use App\Models\Nhanviens;
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
        $chucDanhs = Danhmucs::all()->where('loai',0)->pluck("ten","id");
        $phongBans = Danhmucs::all()->where('loai',1)->pluck("ten","id");
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
        $chucDanhs = Danhmucs::all()->where('loai',0)->pluck("ten","id");
        $phongBans = Danhmucs::all()->where('loai',1)->pluck("ten","id");
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
        date_default_timezone_set("Asia/Ho_Chi_Minh");     
        $nhanVien = new Nhanviens();
        $user = new users();

        $nhanVien -> ten = $request -> ten;
        $nhanVien -> ma = $request -> ma;
        $nhanVien -> email = $request -> email;
        $nhanVien -> ngaysinh = $request -> ngaysinh;
        $nhanVien -> gioitinh = $request -> gioitinh;
        $nhanVien -> hesoluong = $request -> hesoluong;
        $nhanVien -> chucdanhid = $request -> chucdanhid;
        $nhanVien -> phongbanid = $request -> phongbanid;
        $nhanVien -> nguoitao = Auth::user()->username;
        $nhanVien -> nguoisua = Auth::user()->username;
        
        Session::flash('message', $nhanVien->save() ? 'addSuccess' : 'addFailed');
        $user -> username = $request -> email;
        $user -> password = Hash::make($request->password);
        $user -> email = $request -> email;
        $user -> nhanvienid = $nhanVien->id;
        $user -> nguoitao = Auth::user()->username;
        $user -> nguoisua = Auth::user()->username;
        $user->save(); 

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
        date_default_timezone_set("Asia/Ho_Chi_Minh");     
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
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        
        $id = $request->input('id');
        $result = Nhanviens::find($id)->delete();
        $result1 = users::where('nhanvienid',$id)->delete();
        Session::flash("message", $result && $result1 ? "deleteSuccess" : "deleteFailed");
        return view('message');
    }

    public function render(Request $request)
    {
        $ten = CommonUtil::convert_name(strtolower($request->ten));
        $searchPreArr = explode(" ", $ten);
        $username = $searchPreArr[count($searchPreArr)-1];
        $password = CommonUtil::getValueCauhinh("PASSWORDDEFAULT"); //cấu hình pass default = 12345678

        for ($i = 0; $i < count($searchPreArr) - 1; $i++) {
            $username = $username . $searchPreArr[$i][0];
        }
        $username = $username . CommonUtil::getValueCauhinh("EMAILDEFAULT");
        $id = DB::table('nhanviens')->max("id");
        $ma = $id < 10 ? "NV0".$id : "NV".$id;
        
        return response()->json(json_encode(["username"=>$username,"password"=>$password,"ma"=>$ma]));
    }

}
