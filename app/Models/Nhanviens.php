<?php

namespace App\Models;

use App\Util\UpdateUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nhanviens extends Model
{
    use HasFactory,SoftDeletes, UpdateUser;
    
    public $timestamps = true;
    protected $table = "nhanviens";
    protected $fillable = ["id", "ten", "ma", "ngaysinh", "gioitinh", "hesoluong", "chucdanhid", "phongbanid", "nguoitao", "nguoisua"];
}
