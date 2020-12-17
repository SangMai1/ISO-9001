<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhoms extends Model
{
    public $timestamps = true;
    protected $table = "nhoms";
    protected $fillable = ["id", "ma", "ten", "nguoitao", "nguoisua", "daxoa"];

}
