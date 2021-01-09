<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestTaisan;
use App\Models\Danhmucs;
use App\Models\taisans;
use App\Util\CommonUtil;
use Illuminate\Http\Request;
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
        $taisans = CommonUtil::readViewConfig(taisans::class, $request)->get();
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
        $danhMucs = Danhmucs::all()->where('loai', 2)->pluck('ten', 'id');
        return view('/tai-san/them-moi', compact(['danhMucs']));
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

    
}
