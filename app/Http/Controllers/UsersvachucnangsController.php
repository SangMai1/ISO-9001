<?php

namespace App\Http\Controllers;

use App\Models\chucnangs;
use App\Models\Nhanviens;
use App\Models\usersvachucnangs;
use Illuminate\Http\Request;

class UsersvachucnangsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $nhanVien = Nhanviens::find($request->id);
        $idChucNang = chucnangs::pluck('ten', 'id');
        return view('/nhan-vien/them-moi-chuc-nang', compact(["nhanVien", "idChucNang"]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chucnangid = $request->input('chucnangs');
        foreach($chucnangid as $chucs){
            $usersvachucnangs = new usersvachucnangs();
            $usersvachucnangs->userid = $request->userid;
            $usersvachucnangs->chucnangid = $chucs;
            $usersvachucnangs->save();
        }
        return view("message");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\usersvachucnangs  $usersvachucnangs
     * @return \Illuminate\Http\Response
     */
    public function show(usersvachucnangs $usersvachucnangs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\usersvachucnangs  $usersvachucnangs
     * @return \Illuminate\Http\Response
     */
    public function edit(usersvachucnangs $usersvachucnangs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\usersvachucnangs  $usersvachucnangs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, usersvachucnangs $usersvachucnangs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\usersvachucnangs  $usersvachucnangs
     * @return \Illuminate\Http\Response
     */
    public function destroy(usersvachucnangs $usersvachucnangs)
    {
        //
    }
}
