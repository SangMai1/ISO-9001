<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestDanhMuc;
use App\Models\Danhmucs;
use App\Util\CommonUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DanhmucsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $danhMucs = CommonUtil::readViewConfig(Danhmucs::class, $request)->where('loai',$request->loai)->get();
        return view('/danh-muc/danh-sach',["danhMucs" => $danhMucs,"tendm"=>"","loaiDm"=>$request->loai]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //Hiển thị trang thêm danh mục
	    return view('/danh-muc/them-moi',['loaiDm'=>$request->loai]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestDanhMuc $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");     
	
        $danhMuc = new Danhmucs();
        $danhMuc -> ten = $request->ten;
        $danhMuc -> ma = $request->ma;
        $danhMuc -> loai = $request->loai;
        $danhMuc -> nguoitao = Auth::user()->username;
        $danhMuc -> nguoisua = Auth::user()->username;

        Session::flash('message', $danhMuc->save() ? 'addSuccess' : 'addFailed');

        return view('message');
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
    public function edit(Request $request)
    {
        $danhmuc = Danhmucs::find($request->id);
        if (!$danhmuc) return abort(404);
        return view('/danh-muc/chinh-sua', compact('danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Danhmucs  $danhmucs
     * @return \Illuminate\Http\Response
     */
    public function update(RequestDanhMuc $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $danhmuc = Danhmucs::find($request->id);
        
 
        if (!$danhmuc) {
            Session::flash('message', 'notFoundItem');
        } else {
            $danhmuc -> ten = $request->ten;
            $danhmuc -> ma = $request->ma;
            $danhmuc -> loai = $request->loai;
            $danhmuc -> nguoisua = Auth::user()->username ;
            Session::flash('message', $danhmuc->update() ? 'updateSuccess' : 'updateFailed');
        }

        return view('message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Danhmucs  $danhmucs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
 
        $id = $request->input('id');
        $result = Danhmucs::find($id)->delete();
        Session::flash("message", $result ? "deleteSuccess" : "deleteFailed");
        return view('message');
    }

    public function search(Request $request){
        $tendm = $request -> tendm ;
        $loaiDm = $request -> loaidm;
        $sql = " SELECT * FROM danhmucs WHERE 1=1 ";
        if(isset($request -> tendm) && $tendm != ""){
            $sql = $sql . " AND ten like '%" . $tendm ."%' ";
        }
        if(isset($request -> loaidm) && $loaiDm >= 0){
            $sql = $sql . " AND loai = " . $loaiDm ." ";
        }

        $danhMucs = DB::select($sql);
        return view('/danh-muc/danh-sach',["danhMucs" => $danhMucs,"tendm"=>$tendm,"loaiDm"=>$loaiDm]);
    }
}
