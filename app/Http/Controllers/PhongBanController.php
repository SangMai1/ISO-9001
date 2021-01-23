<?php

namespace App\Http\Controllers;

use App\Http\Requests\phongban\RequestPhongBan;
use App\Models\Nhanviens;
use App\Models\PhongBan;
use App\Util\CommonUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PhongBanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $phongBans = CommonUtil::readViewConfig(PhongBan::class, $request)->get();
        return view(
            $request->has('no-layout') ? 'phong-ban.includes.table-danh-sach' : 'phong-ban.danh-sach',
            compact(['phongBans'])
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nhanViens = Nhanviens::all();
        return view('/phong-ban/them-moi', compact(['nhanViens']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestPhongBan $request)
    {

        $chucNang = new PhongBan($request->except('id'));
        
        Session::flash('message', $chucNang->save() ? 'addSuccess' : 'addFailed');
        
        return view('message');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\chucnangs  $chucnangs
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $phongBan = PhongBan::find($request->id);
        if (!$phongBan) return abort(404);
        $nhanViens = Nhanviens::all();
        return view('/phong-ban/cap-nhat', compact(['phongBan', 'nhanViens']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(RequestPhongBan $request)
    {
        
        $phongBan = $request->_data['id'];

        Session::flash('message', $phongBan->update([$request->all()]) ? 'updateSuccess' : 'updateFailed');

        return view('message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */

    public function delete(Request $request)
    {

        $id = $request->input('id');
        $result = PhongBan::find($id)->delete();
        Session::flash("message", $result ? "deleteSuccess" : "deleteFailed");
        return view('message');
    }

}
