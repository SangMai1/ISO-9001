<?php

namespace App\Http\Controllers;

use App\Models\chucnangs;
use App\Models\nhoms;
use App\Models\nhomsvachucnangs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class NhomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nhoms = DB::table('nhoms')->where('daxoa', 0)->get();
        $idChucNang = DB::table('chucnangs')->where('daxoa', 0)->pluck('ten', 'id');
        return view('/nhom/danh-sach', compact(['nhoms', 'idChucNang']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idChucNang = DB::table('chucnangs')->where('daxoa', 0)->pluck('ten', 'id');
        return view('/nhom/them-moi', compact(['idChucNang']));
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

        $validator = Validator::make($request->all(), [
            'ma' => 'required|string|min:1',
            'ten' => 'required|string|min:1'
        ]);

        if ($validator->fails()) {
            return redirect()->Back()->withInput()->withErrors($validator);
        }

        $nhom = new nhoms();
        $nhom->ma = $request->ma;
        $nhom->ten = $request->ten;
        $nhom->nguoitao = "sang";
        $nhom->nguoisua = "sang";
        $nhom->daxoa = "0";

        
        if ($nhom->save()) {
            $nhomid = $nhom->id;
            $chucnangid = $request->input('chucnangs');    
            foreach($chucnangid as $chucs){
                $nhomsvachucnangs = new nhomsvachucnangs();
                $nhomsvachucnangs -> nhomid = $nhomid;
                $nhomsvachucnangs -> chucnangid = $chucs;
                $nhomsvachucnangs->save();
                Session::flash('message', 'Thêm mới thành công');
                Session::flash('alert-class', 'alert-sucess');
            }
            
        }
        
       else {
            Session::flash('message', 'Thêm mới thất bại!');
            Session::flash('alert-class', 'alert-danger');
        }
        return Back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\nhoms  $nhoms
     * @return \Illuminate\Http\Response
     */
    public function show(nhoms $nhoms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\nhoms  $nhoms
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $nhoms = DB::select("select n.id, n.ma, n.ten as tennhom,cn.id as idchucnang, cn.ten as tenchucnang FROM nhoms n
LEFT JOIN nhomsvachucnangs nvcn ON nvcn.nhomid = n.id 
LEFT JOIN chucnangs cn ON cn.id = nvcn.chucnangid
where n.id=$id and n.daxoa = 0 AND cn.daxoa = 0
");

        
        return response()->json($nhoms);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\nhoms  $nhoms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, nhoms $nhoms, nhomsvachucnangs $nhomsvachucnangs)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $validator = Validator::make($request->all(), [
            'ma' => 'required|string|min:1',
            'ten' => 'required|string|min:1'
        ]);

        if ($validator->fails()) {
            return redirect()->Back()->withInput()->withErrors($validator);
        }

        $nhom = nhoms::find($request->id);
        $nhom->ma = $request->ma;
        $nhom->ten = $request->ten;
        $nhom->nguoisua = "admin";
        $nhom->ngaysua = Carbon::now();
        nhomsvachucnangs::where('nhomid', $request->id)->delete();
        
        // foreach($nhomsvachucnangss as $nhomss){
        //     $nhomss->delete();
        // }
        // $nhomsvachucnangss->delete();
        if ($nhom->update()) {
            $nhomid = $nhom->id;
            $chucnangid = $request->input('chucnangids');
            foreach ($chucnangid as $chucs) {
                $nhomsvachucnangs = new nhomsvachucnangs();
                $nhomsvachucnangs->nhomid = $nhomid;
                $nhomsvachucnangs->chucnangid = $chucs;
                $nhomsvachucnangs->save();
                Session::flash('message', 'Thêm mới thành công');
                Session::flash('alert-class', 'alert-sucess');
            }
        } else {
            Session::flash('message', 'Cập nhật thất bại');
            Session::flash('alert-class', 'alert-danger');
        }
        return Back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\nhoms  $nhoms
     * @return \Illuminate\Http\Response
     */
    public function destroy(nhoms $nhoms)
    {
        //
    }

    public function deleteAll(Request $request)
    {

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $list_id = $request->input('idss');

        foreach ($list_id as $list) {
            nhoms::where('id', $list)->update([
                "daxoa" => "1",
                "nguoisua" => "ai do",
                "ngaysua" => Carbon::now()

            ]);
        }
        return redirect()->route('viewNhoms');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $nhoms = nhoms::where('ten', 'like', '%' . $search . '%')->get();
        $idChucNang = DB::table('chucnangs')->where('daxoa', 0)->pluck('ten', 'id');
        return view('/nhom/danh-sach', compact(['nhoms', 'idChucNang']));
    }
}
