<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoSoNhanVien extends Model
{
    use HasFactory;
    protected $table = 'hosonhanviens';
    protected $fillable = ['id','nhanvienid','hesoluong','diachi','cmnd','trinhdochuyenmon','thoigianlamviec','baohiemyte','baohiemxahoi','baohiemthatnghiep','baohiemthatnghiep '];
    public $timestamps;
}
