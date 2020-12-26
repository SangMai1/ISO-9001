<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestNhom;
use App\Models\chucnangs;
use App\Models\nhoms;
use App\Models\nhomsvachucnangs;
use App\Util\CommonUtil;
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
    public function index(Request $request)
    {
        $nhoms = CommonUtil::readViewConfig(nhoms::class, $request)->get();
        // $idChucNang = DB::table('chucnangs')->pluck('ten', 'id');
        if($request->has('no-layout')) {
            return view('nhom.table-include', compact(['nhoms']));
        }
        return view('nhom.danh-sach', compact(['nhoms']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idChucNang = DB::table('chucnangs')->pluck('ten', 'id');
        return view('/nhom/them-moi', compact(['idChucNang']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestNhom $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $nhom = new nhoms();
        $nhom->ma = $request->ma;
        $nhom->ten = $request->ten;
        $nhom->nguoitao = "sang";
        $nhom->nguoisua = "sang";
        
        Session::flash('message', $nhom->save() ? 'addSuccess' : 'addFailed');
            $nhomid = $nhom->id;
            $chucnangid = $request->input('chucnangs');    
            foreach($chucnangid as $chucs){
                $nhomsvachucnangs = new nhomsvachucnangs();
                $nhomsvachucnangs -> nhomid = $nhomid;
                $nhomsvachucnangs -> chucnangid = $chucs;
                $nhomsvachucnangs->save();
            }
            
        return view('message');
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
    public function edit(Request $request)
    {
        $nhoms = nhoms::find($request->id);
        $idChucNang = DB::table('chucnangs')->pluck('ten', 'id');
        $chucNangCheck = DB::table('nhomsvachucnangs')->where('nhomid', $request->id)->get();
        return view('/nhom/cap-nhat', compact(['nhoms', 'idChucNang', 'chucNangCheck']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\nhoms  $nhoms
     * @return \Illuminate\Http\Response
     */
    public function update(RequestNhom $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");


        $nhom = nhoms::find($request->id);
        $nhom->ma = $request->ma;
        $nhom->ten = $request->ten;
        $nhom->nguoisua = "admin";
        nhomsvachucnangs::where('nhomid', $request->id)->delete();
        
        
         Session::flash('message', $nhom->update() ? 'updateSuccess' : 'updateFailed');
            $nhomid = $nhom->id;
            $chucnangid = $request->input('chucnangids');
            foreach ($chucnangid as $chucs) {
                $nhomsvachucnangs = new nhomsvachucnangs();
                $nhomsvachucnangs->nhomid = $nhomid;
                $nhomsvachucnangs->chucnangid = $chucs;
                $nhomsvachucnangs->save();
                
            }
       
        return view('message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\nhoms  $nhoms
     * @return \Illuminate\Http\Response
     */

    public function deleteAll(Request $request)
    {

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $id = $request->input('id');
        $result = nhoms::find($id)->delete();
        Session::flash("message", $result ? "deleteSuccess" : "deleteFailed");
        return view('message');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $nhoms = nhoms::where('ten', 'like', '%' . $search . '%')->get();
        $idChucNang = DB::table('chucnangs')->where('daxoa', 0)->pluck('ten', 'id');
        return view('/nhom/danh-sach', compact(['nhoms', 'idChucNang']));
    }
}
