<?php

namespace App\Http\Controllers;

use App\Models\chucnangs;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Environment\Console;

class ChucnangsController extends Controller
{
    /**
     * Display a listing of the resource.
     * route:viewChucNang
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $chucNangs = DB::table('chucnangs')->where('daxoa', 0)->get();
        if ($request->get('no-layout') === '1') {
            return view('chuc-nang.table-include', compact(['chucNangs']));
        }
        return view('/chuc-nang/danh-sach', compact(['chucNangs']));
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
    public function store(Request $request)
    {

        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $validator = Validator::make($request->all(), [
            'ten' => 'required|string|min:1',
            'url' => 'required|string|min:1'
        ]);

        if ($validator->fails()) {
            return redirect()->Back()->withInput()->withErrors($validator);
        }

        $chucNang = new chucnangs();
        $chucNang->ten = $request->ten;
        $chucNang->url = $request->url;
        $chucNang->nguoitao = "sang";
        $chucNang->nguoisua = "sang";
        $chucNang->daxoa = "0";
        if ($chucNang->save()) {
            Session::flash('message', 'Thêm mới thành công');
            Session::flash('alert-class', 'alert-sucess');
            return redirect()->route('chucnang.list');
        } else {
            Session::flash('message', 'Thêm mới thất bại!');
            Session::flash('alert-class', 'alert-danger');
        }
        return Back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\chucnangs  $chucnangs
     * @return \Illuminate\Http\Response
     */
    public function show(chucnangs $chucnangs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\chucnangs  $chucnangs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chucnang = chucnangs::find($id);
        dd($chucnang);
        return view('/chuc-nang/cap-nhat', compact(['chucnang']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\chucnangs  $chucnangs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, chucnangs $chucnangss)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $validator = Validator::make($request->all(), [
            'ten' => 'required|string',
            'url' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->Back()->withInput()->withErrors($validator);
        }
        $chucnang = chucnangs::find($request->id);
        $chucnang->ten = $request->ten;
        $chucnang->url = $request->url;
        $chucnang->nguoisua = "admin";
        if ($chucnang->update()) {
            Session::flash('message', 'Cập nhật thành công');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('chucnang.list');
        } else {
            Session::flash('message', 'Cập nhật thất bại');
            Session::flash('alert-class', 'alert-danger');
        }
        return Back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\chucnangs  $chucnangs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    }

    public function deleteAll(Request $request)
    {

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $list_id = $request->input('ids');

        if ($list_id)
            foreach ($list_id as $list) {
                chucnangs::where('id', $list)->update([
                    "daxoa" => "1",
                    "nguoisua" => "ai do",
                ]);
            }
        return redirect(route('viewChucNang', ['no-layout' => 1]));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $chucNangs = chucnangs::where('ten', 'like', '%' . $search . '%')->get();
        return view('/chuc-nang/danh-sach', compact(['chucNangs']));
    }
}
