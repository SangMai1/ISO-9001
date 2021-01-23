<?php

namespace App\Http\Controllers;

use App\Http\Requests\menu\RequestMenu;
use App\Http\Requests\menu\RequestMenuUpdatePos;
use App\Models\chucnangs;
use App\Models\Menu;
use App\Util\CommonUtil;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\View\View;
use stdClass;

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
        Session::flash('message', (new Menu())->create($request->except('id')) ? 'addSuccess' : 'addFailed');
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
        $menu = $req->_data['id'];
        $message = 'updateFailed';
        if ($menu) $message = $menu->update($req->except('idcha')) ? 'updateSuccess' : 'updateFailed';
        Session::flash('message', $message);
        return view('message');
    }

    public function updatePos(RequestMenuUpdatePos $req)
    {
        $params = $req->only('id', 'vitri', 'idcha');
        $menu = $req->_data['id'];

        Session::flash('message', $menu->update($params) ? 'updateSuccess' : 'updateFailed');
        return redirect()->route('menu.list');
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
        if ($menu->idcha == $menu->id) return;
        $list = Menu::where('idcha', $menu->id)->get();
        foreach ($list as $item) {
            $this->recursiveDelete($item);
        }
        $menu->delete();
    }

    public function getUserMenu()
    {
        $menus = Menu::orderBy('vitri')->get();

        $renderLi = function ($menu, $child = "") {
            return
                $child
                ?   '<li class="nav-item">
                                <a class="nav-link dropdown-toggle auto-icon" href="#menu-id-' . $menu->id . '" data-toggle="collapse">
                                    <div class="icon-menu">' . $menu->icon . '</div>' . $menu->ten . '</a>' . $child . '</li>'
                :   '<li class="nav-item">
                                <a class="nav-link" href="' . $menu->url . '">
                                    <div class="icon-menu">' . $menu->icon . '</div>' . $menu->ten . '</a>' . $child . '</li>';
        };

        $renderUl = function ($child, $menuParent) {
            return isset($menuParent->id)
                ?   '<ul class="collapse" id="menu-id-' . $menuParent->id . '">' . $child . '</ul>'
                :   $child;
        };

        $menus = $menus->filter(function ($menu) use ($menus) {
            $idcha = $menu->idcha;
            if (!$idcha) return true;
            if ($idcha < 0 || $menu->id == $idcha) return true;
            $menuParent = $menus[$menus->search(function ($menu) use ($idcha) {
                return $menu->id == $idcha;
            })];

            if ($menuParent) {
                if (!isset($menuParent->childs)) $menuParent->childs = collect([]);
                $menuParent->childs->push($menu);
                return false;
            }
            return true;
        });

        $renderRecursive = function ($recursive, $menu) use ($renderLi, $renderUl) {
            $childsRender = $menu->childs->reduce(function ($acc, $menu) use ($renderLi, $recursive) {
                $childs = "";
                if (isset($menu->childs)) {

                    $menu->childs = $menu->childs->filter(function ($curMenu) {
                        $url = preg_replace('/\?.*/', '', $curMenu->url);
                        return _p($url);
                    });

                    if ($menu->childs->count() === 0) return $acc;
                    $childs = $recursive($recursive, $menu);
                }
                return $acc . $renderLi($menu, $childs);
            }, "");

            return $renderUl($childsRender, $menu);
        };

        $menuConvert = new stdClass();
        $menuConvert->childs = $menus;
        return $renderRecursive($renderRecursive, $menuConvert);
    }
}
