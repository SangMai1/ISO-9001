<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestXe;
use App\Models\Lichsusuachuas;
use App\Models\Nhanviens;
use App\Models\taisans;
use App\Models\xes;
use App\Util\CommonUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class XesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $xes = CommonUtil::readViewConfig(xes::class, $request)->orderBy('created_at', 'DESC')->get();
        $taisans = taisans::pluck('tentaisan', 'id');
        $nhanviens = Nhanviens::pluck('ten', 'id');
        $soLanSuaChua = Lichsusuachuas::all();
        if($request->has('no-layout')) {
            return view('xe.table-include', compact(['xes', 'taisans', 'nhanviens', 'soLanSuaChua']));
        }
        return view('xe.danh-sach', compact(['xes', 'taisans', 'nhanviens', 'soLanSuaChua']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $idNhanVien = Nhanviens::whereNotExists(function($query){
                            $query->select(DB::raw('id'))->from('xes')->whereRaw('xes.nhanvienid = nhanviens.id');
                        })->pluck('ten', 'id');

         $idTaiSan = taisans::whereNotExists(function($query){
                        $query->select(DB::raw('id'))->from('xes')->whereRaw('taisans.id = xes.taisanid');
                    })->pluck('tentaisan', 'id');
    
        return view('/xe/them-moi', compact(['idTaiSan', 'idNhanVien']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestXe $request)
    {
                $xe = new xes();
        $xe->taisanid = $request->taisanid;
        $xe->bienso = $request->bienso;
        $xe->socho = $request->socho;
        $xe->nhanvienid = $request->nhanvienid;
        Session::flash('message', $xe->save() ? 'addSuccess' : 'addFailed');
        return view('message');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\xes  $xes
     * @return \Illuminate\Http\Response
     */
    public function show(xes $xes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\xes  $xes
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $xe = xes::find($request->id);
        $idTaiSan = taisans::pluck('tentaisan', 'id');
        $idNhanVien = Nhanviens::pluck('ten', 'id');
        if(!$xe) abort(404);
        return view('/xe/cap-nhat', compact(['xe', 'idTaiSan', 'idNhanVien']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\xes  $xes
     * @return \Illuminate\Http\Response
     */
    public function update(RequestXe $request)
    {
        
        $xe = xes::find($request->id);
        if(!$xe){
            Session::flash('message', 'notFoundItem');
        } else {
            $xe->taisanid = $request->taisanid;
            $xe->bienso = $request->bienso;
            $xe->socho = $request->socho;
            $xe->nhanvienid = $request->nhanvienid;
            Session::flash('message', $xe->update() ? 'updateSuccess' : 'updateFailed');
        }
        
        return view('message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\xes  $xes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
                $id = $request->input('id');
        $result = xes::find($id)->delete();
        Session::flash('message', $result ? 'deleteSuccess' : 'deleteFailed');
        return view('message');
    }

    public function search(Request $request){
        $taisans = taisans::pluck('tentaisan', 'id');
        $nhanviens = Nhanviens::pluck('ten', 'id');
        $search = $request->input('search');
        $xes = xes::query()
            ->leftJoin('taisans', 'xes.taisanid', '=', 'taisans.id')
            ->leftJoin('nhanviens', 'nhanviens.id', '=', 'xes.nhanvienid')
            ->where('taisans.tentaisan', 'like', '%' . $search . '%')
            ->orWhere('xes.socho', 'like', '%' . $search . '%')->get();
        return view('/xe/danh-sach', compact(['xes', 'nhanviens', 'taisans']));
        
}
}