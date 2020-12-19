<?php

namespace App\Http\Controllers;

use App\Models\users;
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
    public function index()
    {
        $users = users::all()->where('daxoa',null);
        return view('/users/danh-sach',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/users/them-moi');
    }

    public function search(Request $request){
        $search = $request->get('search');
        $users = users::where('name', 'like', '%'.$search.'%')->paginate(3);
        return view('users/danh-sach',['users'=> $users]);
       
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
        $request->validate([
            'name' => 'required|unique:users',
            'password' => 'required',
        ],[
            'name.required' => 'Name không được bỏ trống',
            'name.unique' =>'Name này đã tồn tại',
            'password.required' => 'Password không được bỏ trống',
        ]);
        users::create([
            'name' => $request ->input('name'),
            'password' => $request ->input('password'),
            'nhanvienid' => $request ->input('nhanvienid'),
            'nguoitao' => 'admin',
            'nguoisua' => 'Chưa thực hiện cập nhật'
        ]);
        return redirect()->route('user.list')
            ->with('success', 'Thêm mới user thành công !!');
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
    public function edit($id)
    {
        $users = users::find($id)->toArray();
        return view('/users/chinh-sua', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, users $users)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ],[
            'name.required' =>'Name không được bỏ trống',
            'password.required' => 'Password không được bỏ trống',
        ]);
        $users = users::where('id', $request->input('cid'))->update([
        	'name' => $request ->input('name'),
            'password' => $request ->input('password'),
            'nhanvienid' => $request ->input('nhanvienid'),
            'nguoisua' => 'canh',
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        return redirect()->route('user.list')
        ->with('success', 'Cập nhật user thành công !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = users::find($id);
        $users -> daxoa = Carbon::now('Asia/Ho_Chi_Minh');
        $users->update();
        return redirect()->route('user.list')
        ->with('success', 'Xóa user thành công !!');
    }

    public function getDeleteUsers() 
    {
        $users = users::all()->where('daxoa');
        return view('/users/da-xoa',['users'=>$users]);
          
    }

    public function deletePermanentlyUser($id)
    {
        $users = users::find($id)->delete();
        return redirect()->route('user.list')
            ->with('success', 'User đã được xóa hoàn toàn !!');
    }

    public function restoreDeletedUser($id){
        $users = users::find($id);
        $users -> daxoa = null;
        $users->update();
        return redirect()->route('user.list')
        ->with('success', 'Khôi phục user thành công !!');
    }
}
