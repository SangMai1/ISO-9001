<?php

namespace App\Http\Controllers;

use App\Models\Danhmucs;
use App\Models\Nhanviens;
use App\Models\users;
use App\Util\CommonUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class NhanviensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nhanviens = Nhanviens::all()->where('daxoa',0);
        return view('/nhan-vien/danh-sach',["nhanviens" => $nhanviens]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $chucdanhs = Danhmucs::all()->where('daxoa',0)->where('loai',0)->pluck("ten","id");
        $phongbans = Danhmucs::all()->where('daxoa',0)->where('loai',1)->pluck("ten","id");
        return view('/nhan-vien/them-moi',["chucdanhs"=>$chucdanhs,"phongbans"=>$phongbans]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");     
    
        $request->validate([
            'ma' => 'required',
            'ten' => 'required',
            'email' => 'required',
        ],[
            'ma.required' => 'Mã không được bỏ trống',
            'ten.required' => 'Tên không được bỏ trống',
            'email.required' => 'Email không được bỏ trống',
        ]);
	
        $nhanvien = new Nhanviens();
        $user = new users();

        $nhanvien -> ten = $request -> ten;
        $nhanvien -> ma = $request -> ma;
        $nhanvien -> email = $request -> email;
        $nhanvien -> ngaysinh = $request -> ngaysinh;
        $nhanvien -> gioitinh = $request -> gioitinh;
        $nhanvien -> hesoluong = $request -> hesoluong;
        $nhanvien -> chucdanhid = $request -> chucdanhid;
        $nhanvien -> phongbanid = $request -> phongbanid;
        $nhanvien -> nguoitao = CommonUtil::getValueCauhinh("USER_ADMIN");
        $nhanvien -> nguoisua = CommonUtil::getValueCauhinh("USER_ADMIN");
        $nhanvien -> daxoa = "0";
       
        if($nhanvien->save()){
            $user -> username = $request -> username;
            $user -> password = $request -> password;
            $user -> nhanvienid = $nhanvien -> id;
            $user -> nguoitao = CommonUtil::getValueCauhinh("USER_ADMIN");
            $user -> nguoisua = CommonUtil::getValueCauhinh("USER_ADMIN");
            $user -> daxoa = "0";
            $user->save();
            Session::flash('success', 'Thêm mới thành công');
        } else {
            Session::flash('error', 'Thêm mới thất bại!');
        }
	
        //Thực hiện chuyển trang
        return redirect()->Route('nhanvien.add');
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
    public function edit($id)
    {
        echo 'vao day';
        $nhanvien = Nhanviens::find($id);
        $chucdanhs = Danhmucs::all()->where('daxoa',0)->where('loai',0)->pluck("ten","id");
        $phongbans = Danhmucs::all()->where('daxoa',0)->where('loai',1)->pluck("ten","id");
        return view('/nhan-vien/chinh-sua',["chucdanhs"=>$chucdanhs,"phongbans"=>$phongbans,"nhanvien"=>$nhanvien]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nhanviens  $nhanviens
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nhanviens $nhanviens)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");     
    
        $request->validate([
            'ma' => 'required',
            'ten' => 'required',
            'email' => 'required',
        ],[
            'ma.required' => 'Mã không được bỏ trống',
            'ten.required' => 'Tên không được bỏ trống',
            'email.required' => 'Email không được bỏ trống',
        ]);
	
        $nhanvien = Nhanviens::find($request-> id);

        $nhanvien -> ten = $request -> ten;
        $nhanvien -> ma = $request -> ma;
        $nhanvien -> email = $request -> email;
        $nhanvien -> ngaysinh = $request -> ngaysinh;
        $nhanvien -> gioitinh = $request -> gioitinh;
        $nhanvien -> hesoluong = $request -> hesoluong;
        $nhanvien -> chucdanhid = $request -> chucdanhid;
        $nhanvien -> phongbanid = $request -> phongbanid;
        $nhanvien -> nguoisua = CommonUtil::getValueCauhinh("USER_ADMIN");
       
        if($nhanvien->update()){
            Session::flash('success', 'Cập nhật thành công');
        } else {
            Session::flash('error', 'Cập nhật thất bại');
        }
	
        //Thực hiện chuyển trang
        return redirect()->Route('nhanvien.list');
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
        $ids = $request -> ids;
        $list_id = explode(",",$ids);
        //Thực hiện câu lệnh xóa với giá trị id = $id trả về
        foreach ($list_id as $list) {
            Nhanviens::where('id', $list)->update([
                "daxoa" => "1",
                "nguoisua" => CommonUtil::getValueCauhinh("USER_ADMIN")
            ]);
            users::where('nhanvienid', $list)->update([
                "daxoa" => "1",
                "nguoisua" => CommonUtil::getValueCauhinh("USER_ADMIN")
            ]);
        }
        
        //Thực hiện chuyển trang
        return redirect()->Route('nhanvien.list');
    }
}
