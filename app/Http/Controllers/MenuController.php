<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestMenu;
use App\Models\chucnangs;
use App\Models\Menu;
use App\Util\CommonUtil;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

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
            'menus' => Menu::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.includes.them-moi-form', [
            'chucnangs' => chucnangs::select(['ten', 'id', 'url'])->get()
        ]);
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
    public function edit(Request $req)
    {
        if (!$req->id) abort(400, 'Missing parameters ["id"]');
        $menu = Menu::find($req->id);
        if (!$menu) abort(404, 'No data available');

        return view('menu.includes.chinh-sua-form', [
            'menu' => $menu,
            'chucnangs' => chucnangs::select(['ten', 'id', 'url'])->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(RequestMenu $req)
    {
        $menu = $req->id ? Menu::find($req->id) : '';
        $message = 'updateFailed';
        if ($menu) $message = $menu->update($req->all()) ? 'updateSuccess' : 'updateFailed';
        Session::flash('message', $message);
        return view('message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        $menu = Menu::find($req->id);
        if (!$menu) {
            Session::flash('message', 'deleteFailed');
        } else {
            $this->recursiveDelete($menu);
            Session::flash('message', 'deleteSuccess');
        }
        return view('message');
    }
    protected function recursiveDelete(Menu $menu)
    {
        error_log('\n\nMenu-cha' . $menu->id);
        $list = Menu::where('idcha', $menu->id)->get();
        foreach ($list as $item) {
            $this->recursiveDelete($item);
        }
        $menu->delete();
    }
}
