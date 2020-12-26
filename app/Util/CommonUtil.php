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
        return DB::table('cauhinhs')->where("ma", "=", $ma)->value("giatri");
    }

    static function finDanhMucByloai($loai)
    {
        return DB::table("danhmucs")->where("loai", $loai)
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

    static function seederJson($table)
    {
        try {
            DB::table($table)->truncate();
            $content = file_get_contents("./database/seeders/seed-json/{$table}.json", true);
            DB::table($table)->insert(json_decode($content, true));
        } catch (\Throwable $th) {
            error_log('Lỗi xảy ra khi đọc file ' . $table);
        }
    }

    static function convert_name($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);

        return $str;
    }
}
