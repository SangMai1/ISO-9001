<?php
    namespace App\Util;

use Illuminate\Support\Facades\DB;

class CommonUtil {
        static function replace($searchPre){
            require_once "data.php";
            $searchPreArr = explode(" ",$searchPre);
            $wordSearch = "";
            $arr = [];
            for($i = 0;$i<count($searchPreArr);$i++){
                $wordSearchTemp = trim($wordSearch ." ". $searchPreArr[$i]);
                if (isset($dic[$wordSearchTemp])){
                    $wordSearch = $wordSearchTemp;
                }else{
                    $wordSearch = trim(str_replace(" ","&",$wordSearch));
                    $arr[] = "(".$wordSearch.")";
                    $arr[] = "|";
                    $wordSearch = $searchPreArr[$i];
                }
            }

            $wordSearch = trim(str_replace(" ","&",$wordSearch));
            $arr[] = "(".$wordSearch.")";
            return implode($arr);
        }

        static function getValueCauhinh($ma){
            return DB::table('cauhinhs')->where("ma","=",$ma)->where("daxoa",0)->value("giatri");
        }
    }