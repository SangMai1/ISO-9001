<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    public $timestamps = false;
    protected $table = "users";
    protected $fillable = ["id", "name","password","nhanvienid","nguoitao", "ngaytao", "nguoisua", "ngaysua", "daxoa"];
}
