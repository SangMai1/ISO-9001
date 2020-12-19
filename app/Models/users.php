<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    public $timestamps = true;
    protected $table = "users";
    protected $fillable = ["id", "username","password","nhanvienid","nguoitao", "nguoisua", "daxoa"];
}
