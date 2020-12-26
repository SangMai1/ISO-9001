<?php

namespace App\Util;

use Illuminate\Support\Facades\Auth;

trait UpdateUser
{
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->nguoitao = Auth::user()->username;
            $model->nguoisua = Auth::user()->username;
        });

        self::updating(function ($model) {
            $model->nguoisua = Auth::user()->username;
        });
    }
}
