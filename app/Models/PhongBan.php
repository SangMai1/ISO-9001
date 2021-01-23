<?php

namespace App\Models;

use App\Util\UpdateUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhongBan extends Model
{
    use HasFactory, SoftDeletes, UpdateUser;
    protected $table = "phongbans";
    protected $fillable = ['id', 'ten', 'truongphong_nvid'];
    public $timestamps;
}
