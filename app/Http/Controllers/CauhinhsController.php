<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestCauHinh;
use App\Models\Cauhinhs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CauhinhsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cauHinhs = DB::table('cauhinhs')->where('daxoa',null)->get();
        if (Session::get('no-layout') == true) {
            return view('cau-hinh.table-include', compact(['cauHinhs']));
        }
        return view('/cau-hinh/danh-sach', compact(['cauHinhs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Hiển thị trang thêm cấu hình
	    return view('cau-hinh.them-moi');
    }

    public function search(Request $request){
        $search = $request->get('search');
        $cauHinhs = Cauhinhs::where('ten', 'like', '%'.$search.'%')->paginate(3);
        return view('cau-hinh/danh-sach',['cauHinhs'=> $cauHinhs]);
       
    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestCauHinh $request)
    {   
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $cauHinh = new Cauhinhs();
        $cauHinh->ma = $request->ma;
        $cauHinh->ten = $request->ten;
        $cauHinh->giatri = $request->giatri;
        $cauHinh->nguoitao = "admin";
        $cauHinh->nguoisua = "admin";

        Session::flash('message', $cauHinh->save() ? 'addSuccess' : 'addFailed');

        return view('message');

    }
	

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cauhinhs  $cauhinhs
     * @return \Illuminate\Http\Response
     */
    public function show(Cauhinhs $cauhinhs)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cauhinhs  $cauhinhs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cauhinh = Cauhinhs::find($id);
        // dd($cauhinh);
        return view('/cau-hinh/cap-nhat', compact(['cauhinh']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cauhinhs  $cauhinhs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cauhinhs $cauhinhs)
    {
        $validator = Validator::make($request->all(), [
            'ma' => 'required|string',
            'ten' => 'required|string',
            'giatri' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->Back()->withInput()->withErrors($validator);
        }
 
        $cauhinh = Cauhinhs::find($request->id);
        $cauhinh->ma = $request->ma;
        $cauhinh->ten = $request->ten;
        $cauhinh->giatri = $request->giatri;
        $cauhinh->nguoisua = "EDadmin";
        $cauhinh->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        Session::flash('message', $cauhinh->update() ? 'updateSuccess' : 'updateFailed');
        // if ($cauhinh->update()) {
        //     Session::flash('message', 'Cập nhật thành công');
        //     Session::flash('alert-class', 'alert-success');
        //     return redirect()->route('cauhinh.list');
        // } else {
        //     Session::flash('message', 'Cập nhật thất bại');
        //     Session::flash('alert-class', 'alert-danger');
        // }
        return Back();
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cauhinhs  $cauhinhs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request )
    {
     date_default_timezone_set("Asia/Ho_Chi_Minh");    
     $id = $request->input('id');
     $result = Cauhinhs::where([['id', $id], ['daxoa', null]]) ->update(
             ["daxoa" => Carbon::now('Asia/Ho_Chi_Minh'), "nguoisua" => "DESadmin",]
         );
     Session::flash("message", $result ? "deleteSuccess" : "deleteFailed");
     return view('message');
    }

    
    // public function getDeleteCauhinhs() 
    // {
    //     $cauhinhs = Cauhinhs::all()->where('daxoa');
    //     return view('/cau-hinh/da-xoa',['cauhinhs'=>$cauhinhs]);
    // }

    // public function restoreDeletedCauhinhs($id) 
    // {
    //     $cauhinhs = Cauhinhs::find($id);
    //     $cauhinhs -> daxoa = null;
    //     $cauhinhs->update();
    //     return redirect()->route('cauhinh.list')
    //     ->with('success', 'Khôi phục user thành công !!');
    // }

    // public function deletePermanently($id)
    // {
    //     $cauhinh = Cauhinhs::where('id', $id)->withTrashed()->first();

    //     $cauhinh->forceDelete();

    //     return redirect()->route('cauhinh.list')
    //         ->with('success', 'Cấu hình đã được xóa hoàn toàn !!');
    // }
}
