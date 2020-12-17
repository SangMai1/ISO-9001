<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chucnangs extends Model
{
    public $timestamps = true;
    protected $table = "chucnangs";
    protected $fillable = ["id", "ten", "url", "nguoitao", "nguoisua", "daxoa"];

}
