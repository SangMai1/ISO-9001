<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestLichXuatXe;
use App\Models\Lichxuatxes;
use App\Models\Nhanviens;
use App\Models\taisans;
use App\Models\xes;
use App\Util\CommonUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LichxuatxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lichxuatxes = CommonUtil::readViewConfig(Lichxuatxes::class, $request)->get();
        $xes = xes::join('taisans', 'xes.taisanid', '=', 'taisans.id')
                    ->pluck('taisans.tentaisan', 'xes.id')->all();
        $nhanviens = Nhanviens::pluck('ten', 'id');
        if($request->has('no-layout')) {
            return view('lich-xuat-xe.table-include', compact(['lichxuatxes', 'xes', 'nhanviens']));
        }
        return view('lich-xuat-xe.danh-sach', compact(['lichxuatxes', 'xes', 'nhanviens']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idXe = xes::join('taisans', 'xes.taisanid', '=', 'taisans.id')
                    ->pluck('taisans.tentaisan', 'xes.id')->all();
        $idNhanVien = Nhanviens::pluck('ten', 'id');
        return view('/lich-xuat-xe/them-moi', compact(['idXe', 'idNhanVien']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestLichXuatXe $request)
    {
        
        $lichxuatxes = new Lichxuatxes();
        $lichxuatxes->xeid = $request->xeid;
        $lichxuatxes->cuochopid = $request->cuochopid;
        $lichxuatxes->thoigiandidukien = $request->thoigiandidukien;
        $lichxuatxes->thoigianvedukien = $request->thoigianvedukien;
        $lichxuatxes->nhanvienid = $request->nhanvienid;
        $lichxuatxes->diadiemdi = $request->diadiemdi;
        $lichxuatxes->ghichu = $request->ghichu;
        $lichxuatxes->thoigiandithucte = '0000-00-00 00:00:00';
        $lichxuatxes->thoigianvethucte = '0000-00-00 00:00:00';
        $lichxuatxes->sokmtruockhidi ='0';
        $lichxuatxes->sokmsaukhidi ='0';
        Session::flash('message', $lichxuatxes->save() ? 'addSuccess' : 'addFailed');
        return view('message');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lichxuatxes  $lichxuatxes
     * @return \Illuminate\Http\Response
     */
    public function show(Lichxuatxes $lichxuatxes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lichxuatxes  $lichxuatxes
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $lichxuatxe = Lichxuatxes::find($request->id);
        $idXe = xes::join('taisans', 'xes.taisanid', '=', 'taisans.id')
                    ->pluck('taisans.tentaisan', 'xes.id')->all();
        $idNhanVien = Nhanviens::pluck('ten', 'id');
        if(!$lichxuatxe) abort(404);
        return view('/lich-xuat-xe/cap-nhat', compact(['lichxuatxe', 'idXe', 'idNhanVien']));

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lichxuatxes  $lichxuatxes
     * @return \Illuminate\Http\Response
     */
    public function update(RequestLichXuatXe $request)
    {
                $lichxuatxe = Lichxuatxes::find($request->id);
        if(!$lichxuatxe){
            Session::falsh('message', 'notFoundItem');
        } else {
            $lichxuatxe->xeid = $request->xeid;
            $lichxuatxe->cuochopid = $request->cuochopid;
            $lichxuatxe->thoigiandidukien = $request->thoigiandidukien;
            $lichxuatxe->thoigianvedukien = $request->thoigianvedukien;
            $lichxuatxe->nhanvienid = $request->nhanvienid;
            $lichxuatxe->diadiemdi = $request->diadiemdi;
            $lichxuatxe->ghichu = $request->ghichu;
            $lichxuatxe->thoigiandithucte = $request->thoigiandithucte;
            $lichxuatxe->thoigianvethucte = $request->thoigianvethucte;
            $lichxuatxe->sokmtruockhidi = $request->sokmtruockhidi;
            $lichxuatxe->sokmsaukhidi = $request->sokmsaukhidi;
            Session::flash('message', $lichxuatxe->update() ? 'updateSuccess' : 'updateFailed');
        }

        return view('message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lichxuatxes  $lichxuatxes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
                $id = $request->input('id');
        $result = Lichxuatxes::fbind($id)->delete();
        Session::flash('message', $result ? 'deleteSuccess' : 'deleteFailed');
        return view('message');
    }
}
