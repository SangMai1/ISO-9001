<?php

namespace App\Http\Controllers;

use App\Models\Cauhinhs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;

class CauhinhsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cauhinh = Cauhinhs::all()->toArray();
        return view('cau-hinh/danh-sach')->with('cauhinh',$cauhinh);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Hiển thị trang thêm cấu hình
	    return view('/cau-hinh/them-moi');
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
        'ma' => 'required',
        'ten' => 'required',
        'giatri' => 'required',
        'nguoitao' => 'required'
    ]);

	$allRequest  = $request->all();
    $ma = $allRequest['ma'];
    $ten = $allRequest['ten'];
    $giatri = $allRequest['giatri'];
    $nguoitao = $allRequest['nguoitao'];
   // $nguoisua = $allRequest['nguoisua'];
	
	//Gán giá trị vào array
	$dataInsertToDatabase = array(
		'ma'  => $ma,
        'ten' => $ten,
        'giatri' => $giatri,
        'nguoitao' => $nguoitao,
        'nguoisua' => 'Chưa trải qua cập nhật',
		'ngaytao' => Carbon::now(),
        'ngaysua' => Carbon::now(),
        'daxoa'=>'0'
	);
	
	//Insert vào bảng 
	$insertData = DB::table('cauhinhs')->insert($dataInsertToDatabase);
	
	//Kiểm tra Insert để trả về một thông báo
	if ($insertData) {
		Session::flash('success', 'Thêm mới cấu hình thành công!');
	}else {                        
		Session::flash('error', 'Thêm thất bại!');
	}
	
	//Thực hiện chuyển trang
	return redirect('/cau-hinh/them-moi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cauhinhs  $cauhinhs
     * @return \Illuminate\Http\Response
     */
    public function show(Cauhinhs $cauhinhs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cauhinhs  $cauhinhs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cauhinh = Cauhinhs::find($id)->toArray();
        return view('/cau-hinh/chinh-sua', compact('cauhinh'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cauhinhs  $cauhinhs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cauhinhs $cauhinhs)
    {
    date_default_timezone_set("Asia/Ho_Chi_Minh");
 
	//Thực hiện câu lệnh update với các giá trị $request trả về
	$cauhinhs = DB::table('cauhinhs')->where('id', $request->id)->update([
		'ma' => $request->ma,
        'ten' => $request->ten,
        'giatri' => $request->giatri,
        'nguoisua' => $request->nguoisua,
		'ngaysua' => Carbon::now()
    ]);
	
	//Kiểm tra lệnh update để trả về một thông báo
	if ($cauhinhs) {
		Session::flash('success', 'Cập nhật cấu hình thành công!');
	}else {                        
		Session::flash('error', 'Cập nhật thất bại!');
	}
	
	//Thực hiện chuyển trang
	return  redirect()->Route('cauhinh');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cauhinhs  $cauhinhs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
	//Thực hiện câu lệnh xóa với giá trị id = $id trả về
	$deleteData = Cauhinhs::find($id)->delete();
	
	//Kiểm tra lệnh delete để trả về một thông báo
	if ($deleteData) {
		Session::flash('success', 'Xóa  thành công!');
	}else {                        
		Session::flash('error', 'Xóa thất bại!');
	}
	
	//Thực hiện chuyển trang
	return redirect('cau-hinh/danh-sach');
    }
}
