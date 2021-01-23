<?php

namespace App\Util;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

trait UpdateUser
{
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->nguoitao = Auth::user()->id;
            $model->nguoisua = Auth::user()->id;
        });

        self::updating(function ($model) {
            $model->nguoisua = Auth::user()->id;
        });
    }

    public function nguoitao()
    {
        return CommonUtil::cache('user_id_' . $this->nguoitao, function () {
            return $this->nguoitao ? $this->hasOne('App\Models\User', 'id', 'nguoitao')->first() : new User();
        });
    }

    public function nguoisua()
    {
        return CommonUtil::cache('user_id_' . $this->nguoisua, function () {
            return $this->nguoisua ? $this->hasOne('App\Models\User', 'id', 'nguoisua')->first() : new User();
        });
    }
}
