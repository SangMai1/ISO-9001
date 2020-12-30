<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestLichSuSuaChua;
use App\Models\Lichsusuachuas;
use App\Models\Nhanviens;
use App\Models\taisans;
use App\Models\xes;
use App\Util\CommonUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LichsusuachuasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lichsusuachuas = CommonUtil::readViewConfig(Lichsusuachuas::class, $request)->get();
        $taisans = taisans::pluck('tentaisan', 'id');
        $nhanviens = Nhanviens::pluck('ten', 'id');
        if($request->has('no-layout')) {
            return view('lich-su-sua-chua.table-include', compact(['lichsusuachuas', 'taisans', 'nhanviens']));
        }
        return view('lich-su-sua-chua.danh-sach', compact(['lichsusuachuas', 'taisans', 'nhanviens']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idTaiSan = taisans::pluck('tentaisan', 'id');
        $idNhanVien = Nhanviens::pluck('ten', 'id');
        return view('/lich-su-sua-chua/them-moi', compact(['idTaiSan', 'idNhanVien']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestLichSuSuaChua $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $lichsusuachuas = new Lichsusuachuas();
        $lichsusuachuas->taisanid = $request->taisanid;
        $lichsusuachuas->nguoidisua = $request->nguoidisua;
        $lichsusuachuas->thoigiansua = $request->thoigiansua;
        $lichsusuachuas->giatien = $request->giatien;
        $lichsusuachuas->ghichu = $request->ghichu;
        Session::flash('message', $lichsusuachuas->save() ? 'addSuccess' : 'addFailed');
        return view('message');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lichsusuachuas  $lichsusuachuas
     * @return \Illuminate\Http\Response
     */
    public function show(Lichsusuachuas $lichsusuachuas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lichsusuachuas  $lichsusuachuas
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $lichsusuachua = Lichsusuachuas::find($request->id);
        $idTaiSan = taisans::pluck('tentaisan', 'id');
        $idNhanVien = Nhanviens::pluck('ten', 'id');
        if(!$lichsusuachua) abort(404);
        return view('/lich-su-sua-chua/cap-nhat', compact(['lichsusuachua', 'idTaiSan', 'idNhanVien']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lichsusuachuas  $lichsusuachuas
     * @return \Illuminate\Http\Response
     */
    public function update(RequestLichSuSuaChua $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $lichsusuachua = Lichsusuachuas::find($request->id);
        if(!$lichsusuachua){
            Session::flash('message', 'notFoundItem');
        } else {
            $lichsusuachua->taisanid = $request->taisanid;
            $lichsusuachua->nguoidisua = $request->nguoidisua;
            $lichsusuachua->thoigiansua = $request->thoigiansua;
            $lichsusuachua->giatien = $request->giatien;
            $lichsusuachua->ghichu = $request->ghichu;
            Session::flash('message', $lichsusuachua->update() ? 'updateSuccess' : 'updateFailed');
        }
        return view('message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lichsusuachuas  $lichsusuachuas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $id = $request->input('id');
        $result = Lichsusuachuas::find($id)->delete();
        Session::flash('message', $result ? 'deleteSuccess' : 'deleteFailed');
        return view('message');
    }
}
