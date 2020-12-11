<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chucnangs extends Model
{
    public $timestamps = false;
    protected $table = "chucnangs";
    protected $fillable = ["id", "ten", "url", "nguoitao", "ngaytao", "nguoisua", "ngaysua", "daxoa"];
}
