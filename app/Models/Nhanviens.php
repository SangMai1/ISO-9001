<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhanviens extends Model
{
    public $timestamps = true;
    protected $table = "nhanviens";
    protected $fillable = ["id", "ten","ma","email","ngaysinh","gioitinh","hesoluong","chucdanhid","phongbanid", "nguoitao", "nguoisua", "daxoa"];
}
