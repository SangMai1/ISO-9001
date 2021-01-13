<?php

namespace App\Http\Controllers\u;

use App\Http\Controllers\Controller;
use App\Models\Nhanviens;
use App\Models\User;
use Illuminate\Http\Request;

class NhanVienController extends Controller
{
    public function getInfo(Request $req)
    {
        switch ($req->type) {
            case 'more.min.json':
                if (!(is_array($req->ids))) return abort(400);
                $rs = [];
                foreach ($req->ids as $id) {
                    $rs[$id] = Nhanviens::where('id', $id)->select(['id', 'ten'])->first();
                }
                return response()->json($rs);
            default:
                if (!$req->id) return abort(400);
                return response()->json(User::find($req->id));
        }
    }
}
