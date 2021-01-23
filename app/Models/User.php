<?php

namespace App\Models;

use FFI;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'nhanvienid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Kiểm tra người dùng hiện tại là người dùng quản trị -> checkPermission => true
     * @return bool
     */
    public function isAdmin()
    {
        return $this->username == 'admin';
    }

    public function getAllPermissions()
    {
        return DB::table('chucnangs as cn')
            ->setBindings([2, 2])
            ->leftJoin('usersvachucnangs as uc', 'uc.chucnangid', '=', 'cn.id')
            ->leftJoin('nhomsvachucnangs as nc', 'nc.chucnangid', '=', 'cn.id')
            ->leftJoin('usersvanhoms as un', 'un.nhomid', '=', 'nc.nhomid')
            ->groupBy('cn.id')
            ->pluck(DB::raw('case when un.userid = ? or uc.userid = ? then true else false end as cc'), 'cn.url')
            ->toArray();
    }

    public function nhanvien()
    {
        return Cache::remember('nhanvien_id_' . $this->id, 3600, function () {
            return $this->hasOne('App\Models\Nhanviens', 'id', 'nhanvienid')->first();
        });
    }

    public function find($a, $b){
        $this->find($a, $b);
    }
}
