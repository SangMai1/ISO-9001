<?php

namespace App\Http\Controllers;

use App\Models\Cauhinhs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CauhinhsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cauhinh = Cauhinhs::query();
        if (request(('term'))) {
            $cauhinh->orWhere('name',  'LIKE', '%' . request('term') . '%');
        }
        $cauhinh = $cauhinh->orderBy('id', 'DESC')->paginate(5);


        return view('cau-hinh.danh-sach', compact('cauhinh'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Hiển thị trang thêm cấu hình
	    return view('cau-hinh.them-moi');
    }

    public function search(Request $request){
        $search = $request->get('search');
        $cauhinh = Cauhinhs::where('ten', 'like', '%'.$search.'%')->paginate(3);
        return view('cau-hinh/danh-sach',['cauhinh'=> $cauhinh]);
       
    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
    
    $request->validate([
        'ma' => 'required|unique:cauhinhs',
        'ten' => 'required',
        'giatri' => 'required',
        'nguoitao' => 'required'
    ],[
        'ma.required' => 'Mã không được bỏ trống',
        'ma.unique' =>'Mã cấu hình này đã tồn tại',
        'ten.required' => 'Tên không được bỏ trống',
        'giatri.required' => 'Giá trị không được bỏ trống',
        'nguoitao.required' => 'Người tạo không được bỏ trống'
    ]);

    Cauhinhs::create([
        'ma' => $request ->input('ma'),
        'ten' => $request ->input('ten'),
        'giatri' => $request ->input('giatri'),
        'nguoitao' => $request ->input('nguoitao'),
        'nguoisua' => 'Chưa thực hiện cập nhật'
    ]);

        return redirect()->route('cauhinh.list')
            ->with('success', 'Thêm mới cấu hình thành công !!');
    }
	

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cauhinhs  $cauhinhs
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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

     $request->validate([
        'ma' => 'required',
        'ten' => 'required',
        'giatri' => 'required',
        'nguoisua' => 'required'
    ],[
        'ma.required' => 'Mã không được bỏ trống',
        'ten.required' => 'Tên không được bỏ trống',
        'giatri.required' => 'Giá trị không được bỏ trống',
        'nguoitao.required' => 'Người tạo không được bỏ trống'
    ]);
 
    $cauhinhs = Cauhinhs::where('id', $request->input('cid'))->update([
        	'ma' => $request ->input('ma'),
            'ten' => $request ->input('ten'),
            'giatri' => $request ->input('giatri'),
            'nguoisua' => $request ->input('nguoisua'),
            'ngaysua' => Carbon::now('Asia/Ho_Chi_Minh')
    ]);
    return redirect()->route('cauhinh.list')
        ->with('success', 'Cập nhật cấu hình thành công !!');
	

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cauhinhs  $cauhinhs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id )
    {
     date_default_timezone_set("Asia/Ho_Chi_Minh");    
	
    $deleteData = Cauhinhs::find($id)->delete();
    

    return redirect()->route('cauhinh.list')
        ->with('success', 'Xóa thành công!!');
    }

    // public function multipleDelete(Request $request)
	// {
	// 	$id = $request->id;
	// 	foreach ($id as $cauhinh) 
	// 	{
	// 		Cauhinhs::where('id', $cauhinh)->delete();
	// 	}
	// 	return redirect()->route('cauhinh.list')
    //     ->with('success', 'Xóa thành công!!');
    // }
    
    public function getDeleteCauhinhs() 
    {
        $cauhinhs = Cauhinhs::onlyTrashed()->paginate(10);

        return view('cau-hinh.da-xoa', compact('cauhinhs'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function restoreDeletedCauhinhs($id) 
    {
        
        $cauhinh = Cauhinhs::where('id', $id)->withTrashed()->first();

        $cauhinh->restore();

        return redirect()->route('cauhinh.list')
            ->with('success', 'Khôi phục cấu hình thành công !!');
    }

    public function deletePermanently($id)
    {
        $cauhinh = Cauhinhs::where('id', $id)->withTrashed()->first();

        $cauhinh->forceDelete();

        return redirect()->route('cauhinh.list')
            ->with('success', 'Cấu hình đã được xóa hoàn toàn !!');
    }
}
