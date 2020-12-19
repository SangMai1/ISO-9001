<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danhmucs extends Model
{
    public $timestamps = true;
    protected $table = "danhmucs";
    protected $fillable = ["id", "ten", "loai","ma", "nguoitao", "nguoisua", "daxoa"];
}
