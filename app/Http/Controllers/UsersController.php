<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestUsers;
use App\Util\CommonUtil;
use App\Models\users;
use App\Models\nhanviens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = CommonUtil::readViewConfig(users::class, $request)->where('deleted_at')->get();
        $idNhanVien = DB::table('nhanviens')->pluck('ten', 'id');
        if ($request->has('no-layout')) {
            return view('users.table-include', compact(['users', 'idNhanVien']));
        }
        return view('users.danh-sach', compact(['users', 'idNhanVien']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idNhanVien = DB::table('nhanviens')->pluck('ten', 'id');
        return view('/users/them-moi', compact(['idNhanVien']));
    }

    public function search(Request $request){
        $search = $request->get('search');
        $users = users::where('name', 'like', '%'.$search.'%')->paginate(3);
        return view('users/danh-sach',['users'=> $users, 'nhanviens' => $nhanviens]);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestUsers $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $users = new users();
        $users->username = $request->username;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->nhanvienid = $request->nhanvienid;
        $users->nguoitao = "admin";
        $users->nguoisua = "admin";
        Session::flash('message', $users->save() ? 'addSuccess' : 'addFailed');

        return view('message');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $users = users::find($request->id);
        $idNhanVien = DB::table('nhanviens')->where('deleted_at', null)->pluck('ten', 'id');
        if (!$users) return abort(404);
        return view('/users/cap-nhat', compact(['users', 'idNhanVien']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(RequestUsers $request)
    {

        $users = users::find($request->id);
        if (!$users) {
            Session::flash('message', 'notFoundItem');
        } else
             {
                $users->username = $request->username;
                $users->email = $request->email;
                $users->password = $request->password;
                $users->nhanvienid = $request->nhanvienid;
                $users->nguoisua = "EDadmin";
                $users->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
                Session::flash('message', $users->update() ? 'updateSuccess' : 'updateFailed');
            }
        return view('message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    $users = users::find($request->id);
    if (!$users) {
          Session::flash('message', 'notFoundItem');
    } else
        { 
        $users->nguoisua = "DELadmin";
        $users->deleted_at = Carbon::now('Asia/Ho_Chi_Minh');
        Session::flash("message", $users->update() ? "deleteSuccess" : "deleteFailed");
        return view('message');
        }
    }

    // public function getDeleteUsers() 
    // {
    //     $users = users::all()->where('daxoa');
    //     return view('/users/da-xoa',['users'=>$users]);
          
    // }

    // public function deletePermanentlyUser($id)
    // {
    //     $users = users::find($id)->delete();
    //     return redirect()->route('user.list')
    //         ->with('success', 'User đã được xóa hoàn toàn !!');
    // }

    // public function restoreDeletedUser($id){
    //     $users = users::find($id);
    //     $users -> daxoa = null;
    //     $users->update();
    //     return redirect()->route('user.list')
    //     ->with('success', 'Khôi phục user thành công !!');
    // }
}
