<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhanviens extends Model
{
    public $timestamps = false;
    protected $table = "nhanviens";
    protected $fillable = ["id", "ten","ma","email","ngaysinh","gioitinh","hesoluong","chucdanhid","phongbanid", "nguoitao", "ngaytao", "nguoisua", "ngaysua", "daxoa"];
}
