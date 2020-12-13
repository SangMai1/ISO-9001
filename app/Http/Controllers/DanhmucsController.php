<?php

namespace App\Http\Controllers;

use App\Models\Danhmucs;
use App\Util\CommonUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DanhmucsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $danhmucs = Danhmucs::all()->where('daxoa',0);
        return view('/danh-muc/danh-sach',["danhmucs" => $danhmucs,"temdm"=>"","loaiDm"=>"-1"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Hiển thị trang thêm danh mục
	    return view('/danh-muc/them-moi');
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
            'loai' => 'required',
        ],[
            'ma.required' => 'Mã không được bỏ trống',
            'ten.required' => 'Tên không được bỏ trống',
            'loai.required' => 'Loại không được bỏ trống',
        ]);

        $allRequest  = $request->all();
        $ma = $allRequest['ma'];
        $ten = $allRequest['ten'];
        $loai = $allRequest['loai'];
	
        $danhmuc = new Danhmucs();
        $danhmuc -> ten = $ten;
        $danhmuc -> ma = $ma;
        $danhmuc -> loai = $loai;
        $danhmuc -> nguoitao = CommonUtil::getValueCauhinh("USER_ADMIN");
        $danhmuc -> ngaytao = Carbon::now();
        $danhmuc -> nguoisua = CommonUtil::getValueCauhinh("USER_ADMIN");
        $danhmuc -> ngaysua = Carbon::now();
        $danhmuc -> daxoa = "0";
        if($danhmuc->save()){
            Session::flash('success', 'Thêm mới thành công');
        } else {
            Session::flash('error', 'Thêm mới thất bại!');
        }
	
        //Thực hiện chuyển trang
        return redirect()->Route('danhmuc.add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Danhmucs  $danhmucs
     * @return \Illuminate\Http\Response
     */
    public function show(Danhmucs $danhmucs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Danhmucs  $danhmucs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $danhmuc = Danhmucs::find($id);
        return view('/danh-muc/chinh-sua', compact('danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Danhmucs  $danhmucs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Danhmucs $danhmucs)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $request->validate([
            'ma' => 'required',
            'ten' => 'required',
            'loai' => 'required',
        ],[
            'ma.required' => 'Mã không được bỏ trống',
            'ten.required' => 'Tên không được bỏ trống',
            'loai.required' => 'Loại không được bỏ trống',
        ]);

        $allRequest  = $request->all();
        $ma = $allRequest['ma'];
        $ten = $allRequest['ten'];
        $loai = $allRequest['loai'];

        $danhmuc = Danhmucs::find($request->id);
        $danhmuc -> ten = $ten;
        $danhmuc -> ma = $ma;
        $danhmuc -> loai = $loai;
        $danhmuc -> nguoisua = CommonUtil::getValueCauhinh("USER_ADMIN");
        $danhmuc -> ngaysua = Carbon::now();
 
        if($danhmuc->update()){
            Session::flash('success', 'Cập nhật thành công');
        } else {
            Session::flash('error', 'Cập nhật thất bại');
        }
        
        //Thực hiện chuyển trang
        return  redirect()->Route('danhmuc.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Danhmucs  $danhmucs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        //Thực hiện câu lệnh xóa với giá trị id = $id trả về
        $danhmuc = Danhmucs::find($id);
        $danhmuc -> nguoisua = CommonUtil::getValueCauhinh("USER_ADMIN");
        $danhmuc -> ngaysua = Carbon::now();
        $danhmuc -> daxoa = 1;
 
        if($danhmuc->update()){
            Session::flash('success', 'Xóa  thành công!');
        } else {
            Session::flash('error', 'Xóa thất bại!');
        }
        
        //Thực hiện chuyển trang
        return redirect()->Route('danhmuc.list');
    }

    public function find(Request $request){
        $tendm = $request -> tendm ;
        $loaiDm = $request -> loaidm;
        $sql = " SELECT * FROM danhmucs WHERE daxoa = 0 ";
        if(isset($request -> tendm) && $tendm != ""){
            $sql = $sql . " AND ten like '%" . $tendm ."%' ";
        }
        if(isset($request -> loaidm) && $loaiDm >= 0){
            $sql = $sql . " AND loai = " . $loaiDm ." ";
        }

        $danhmucs = DB::select($sql);
        return view('/danh-muc/danh-sach',["danhmucs" => $danhmucs,"tendm"=>$tendm,"loaiDm"=>$loaiDm]);
    }
}
