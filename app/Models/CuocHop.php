<?php

namespace App\Models;

use App\Util\UpdateUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuocHop extends Model
{
    use HasFactory, UpdateUser;
    protected $table = 'cuochops';
    protected $fillable = ['id', 'nguoisua', 'nguoitao', 'ten', 'noidung', 'diadiem', 'trangthai', 'thoigianbatdau', 'thoigianketthuc'];
    public $timestamps;
}
