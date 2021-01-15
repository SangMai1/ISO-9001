<?php

namespace App\Http\Controllers;

use App\Models\Nhanviens;
use App\Models\nhoms;
use App\Models\usersvanhoms;
use Illuminate\Http\Request;

class UsersvanhomsController extends Controller
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
        $idNhom = nhoms::pluck('ten', 'id');
        return view('/nhan-vien/them-moi-nhom', compact(["nhanVien", "idNhom"]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nhomid = $request->input('nhoms');
        foreach($nhomid as $ns){
            $usersvanhoms = new usersvanhoms();
            $usersvanhoms->userid = $request->userid;
            $usersvanhoms->nhomid = $ns;
            $usersvanhoms->save();
        }
        return view("message");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\usersvanhoms  $usersvanhoms
     * @return \Illuminate\Http\Response
     */
    public function show(usersvanhoms $usersvanhoms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\usersvanhoms  $usersvanhoms
     * @return \Illuminate\Http\Response
     */
    public function edit(usersvanhoms $usersvanhoms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\usersvanhoms  $usersvanhoms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, usersvanhoms $usersvanhoms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\usersvanhoms  $usersvanhoms
     * @return \Illuminate\Http\Response
     */
    public function destroy(usersvanhoms $usersvanhoms)
    {
        //
    }
}
