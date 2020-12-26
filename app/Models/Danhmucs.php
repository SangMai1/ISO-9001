<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Danhmucs extends Model
{
    use HasFactory,SoftDeletes;
    
    public $timestamps = true;
    protected $table = "danhmucs";
    protected $timestamp = ['daxoa'];
    protected $fillable = ["id", "ten", "loai","ma", "nguoitao", "nguoisua"];
}
