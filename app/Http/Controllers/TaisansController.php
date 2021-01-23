<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestTaisan;
use App\Models\Danhmucs;
use App\Models\Nhanviens;
use App\Models\PhongBan;
use App\Models\taisans;
use App\Models\User;
use App\Util\CommonUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TaisansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $taisans = CommonUtil::readViewConfig(taisans::class, $request)->orderBy('created_at', 'DESC')->get();
        if($request->has('no-layout')) {
            return view('tai-san.include', compact(['taisans']));
        }
        return view('tai-san.danh-sach', compact(['taisans']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nhanViens = DB::table('nhanviens')->select('id', 'ten');
        $soHuus = DB::table('phongbans')->select('id', 'ten')->union($nhanViens)->get();
        $danhMucs = Danhmucs::all()->where('loai', 2)->pluck('ten', 'id');
        return view('/tai-san/them-moi', compact(['danhMucs', 'soHuus']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestTaisan $request)
    {
        $taisan = new taisans();
        $taisan->mataisan = $request->mataisan;
        $taisan->tentaisan = $request->tentaisan;
        $taisan->loaitaisanid = $request->loaitaisanid;
        $taisan->giatien = $request->giatien;
        $taisan->khauhao = $request->khauhao;
        $taisan->trangthai = $request->trangthai;
        $taisan->sohuu = $request->sohuu;
        Session::flash('message', $taisan->save() ? 'addSuccess' : 'addFailed');
        return view('message');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\taisans  $taisans
     * @return \Illuminate\Http\Response
     */
    public function show(taisans $taisans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\taisans  $taisans
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $taisans = taisans::find($request->id);
        $danhMucs = Danhmucs::all()->where('loai', 2)->pluck('ten', 'id');
        if(!$taisans) return abort(404);
        return view('/tai-san/cap-nhat', compact(['taisans', 'danhMucs']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\taisans  $taisans
     * @return \Illuminate\Http\Response
     */
    public function update(RequestTaisan $request)
    {
        
        $taisan = taisans::find($request->id);
        if(!$taisan){
            Session::flash('message', 'notFoundItem');
        } else {
            $taisan->mataisan = $request->mataisan;
            $taisan->tentaisan = $request->tentaisan;
            $taisan->loaitaisanid = $request->loaitaisanid;
            $taisan->giatien = $request->giatien;
            $taisan->khauhao = $request->khauhao;
            $taisan->sohuu = $request->sohuu;
            Session::flash('message', $taisan->update() ? 'updateSuccess' : 'updateFailed');
        }
        
        return view('message');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\taisans  $taisans
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
                $id = $request->input('id');
        $result = taisans::find($id)->delete();
        Session::flash('message', $result ? 'deleteSuccess' : 'deleteFailed');
        return view('message');
    }

    public function chuyen(Request $request)
    {
        $taisans = taisans::find($request->id);
        if(!$taisans) return abort(404);
        $nhanViens = Nhanviens::pluck('ten', 'id');
        $phongBans = PhongBan::pluck('ten', 'id');
        switch($taisans->sohuu_type){
            case null:
                $taisans->sohuu = '"Không có người sở hữu"'; break;
            case 1:
                $taisans->sohuu = 'Phòng ban: '. ($phongBans[$taisans->sohuu_id] ?? '"Không tồn tại phòng ban có id' . $taisans->sohuu_id .'"'); break;
            case 2: 
                $taisans->sohuu = 'Nhân viên: ' . ($nhanViens['1'] ?? '"Không tồn tại nhân viên có id ' . $taisans->sohuu_id .'"'); break;
        } 
        return view('/tai-san/chuyen-giao', compact(['nhanViens', 'phongBans', 'taisans']));
    }
    
    public function chuyengiao(Request $req)
    {
        $taisan = taisans::find($req->id);

        $soHuu = [0, null];
        switch($taisan->sohuu_type){
            case 1:
                $pb = PhongBan::find($taisan->sohuu_id);
                $soHuu = [1, $pb ? $pb : null];
                break;
            case 2:
                $u = User::where('nhanvienid', $taisan->nhanvienid);
                $soHuu = [1, $u ? $u : null];
                break;
        }

        // tài sản có sở hữu
        switch($req->sohuu_type){
            case null:  
                
                
        }
        // không sở hữu

        
        return view('message');

    }
}
