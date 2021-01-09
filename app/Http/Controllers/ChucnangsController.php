<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestChucNang;
use App\Models\chucnangs;
use App\Util\CommonUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ChucnangsController extends Controller
{
    /**
     * Display a listing of the resource.
     * route:viewChucNang
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $chucNangs = CommonUtil::readViewConfig(chucnangs::class, $request)->get();
        return view(
            $request->has('no-layout') ? 'chuc-nang.table-include' : 'chuc-nang.danh-sach',
            compact(['chucNangs'])
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/chuc-nang/them-moi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestChucNang $request)
    {

        $chucNang = new chucnangs($request->except('id'));

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
        $chucnang = chucnangs::find($request->id);
        if (!$chucnang) return abort(404);
        return view('/chuc-nang/cap-nhat', compact(['chucnang']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\chucnangs  $chucnangs
     * @return \Illuminate\Http\Response
     */
    public function update(RequestChucNang $request)
    {
        
        $chucnang = chucnangs::find($request->id);

        if (!$chucnang) {
            Session::flash('message', 'notFoundItem');
        } else {
            $chucnang->ten = $request->ten;
            $chucnang->url = $request->url;
            Session::flash('message', $chucnang->update() ? 'updateSuccess' : 'updateFailed');
        }

        return view('message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\chucnangs  $chucnangs
     * @return \Illuminate\Http\Response
     */

    public function delete(Request $request)
    {

                $id = $request->input('id');
        $result = chucnangs::find($id)->delete();
        Session::flash("message", $result ? "deleteSuccess" : "deleteFailed");
        return view('message');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $chucNangs = chucnangs::where('ten', 'like', '%' . $search . '%')->get();
        return view('/chuc-nang/danh-sach', compact(['chucNangs']));
    }
}
