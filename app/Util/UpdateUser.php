<?php

namespace App\Util;

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

    public function createdBy()
    {
        return Cache::remember('user_id_' . $this->nguoisua, 3600, function () {
            return $this->hasOne('App\Models\User', 'id', 'nguoitao')->first();
        });
    }

    public function updatedBy()
    {
        return Cache::remember('user_id_' . $this->nguoitao, 3600, function () {
            return $this->hasOne('App\Models\User', 'id', 'nguoisua')->first();
        });
    }
}
