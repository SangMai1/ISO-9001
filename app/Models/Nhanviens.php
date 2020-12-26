<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nhanviens extends Model
{
    use HasFactory,SoftDeletes;
    
    public $timestamps = true;
    protected $table = "nhanviens";
    protected $timestamp = ['daxoa'];
    protected $fillable = ["id", "ten","ma","email","ngaysinh","gioitinh","hesoluong","chucdanhid","phongbanid", "nguoitao", "nguoisua"];
}
