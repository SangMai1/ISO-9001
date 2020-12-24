<?php

namespace App\Util;

use App\Models\Danhmucs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommonUtil
{
    static function replace($searchPre)
    {
        require_once "data.php";
        $searchPreArr = explode(" ", $searchPre);
        $wordSearch = "";
        $arr = [];
        for ($i = 0; $i < count($searchPreArr); $i++) {
            $wordSearchTemp = trim($wordSearch . " " . $searchPreArr[$i]);
            if (isset($dic[$wordSearchTemp])) {
                $wordSearch = $wordSearchTemp;
            } else {
                $wordSearch = trim(str_replace(" ", "&", $wordSearch));
                $arr[] = "(" . $wordSearch . ")";
                $arr[] = "|";
                $wordSearch = $searchPreArr[$i];
            }
        }

        $wordSearch = trim(str_replace(" ", "&", $wordSearch));
        $arr[] = "(" . $wordSearch . ")";
        return implode($arr);
    }

    static function getValueCauhinh($ma)
    {
        return DB::table('cauhinhs')->where("ma", "=", $ma)->where("daxoa", 0)->value("giatri");
    }

    static function finDanhMucByloai($loai)
    {
        return DB::table("danhmucs")->where("daxoa", 0)->where("loai", $loai)
            ->pluck("ten", "id");
    }

    static function render(Request $request)
    {
        $ten = strtolower($request->ten);
        $searchPreArr = explode(" ", $ten);
        $username = $searchPreArr[count($searchPreArr)];
        for ($i = 0; $i < count($searchPreArr) - 1; $i++) {
            $username = $username . $searchPreArr[$i][0];
        }
        $password = CommonUtil::getValueCauhinh("PASSWORDDEFAULT"); //cấu hình pass default = 123456

        return json_encode(['username' => $username, 'password' => $password]);
    }
    
    static function readViewConfig($model, $request)
    {   
        return $model::limit($request->limit ?? 10)->offset($request->offset);
    }
}
