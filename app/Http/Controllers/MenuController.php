<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestMenu;
use App\Models\Menu;
use App\Util\CommonUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        return view('menu/danh-sach' . ($req->has('no-layout') ? '-table-include' : ''), [
            'menus' => CommonUtil::readViewConfig(Menu::class, $req)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.them-moi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RequestMenu  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestMenu $request)
    {
        Session::flash('message', (new Menu())->create($request->all()) ? 'addSuccess' : 'addFailed');
        return view('message');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        Session::flash('message', Menu::destroy($req->id) ? 'deleteSuccess' : 'deleteFailed');
        return view('message');
    }
}
