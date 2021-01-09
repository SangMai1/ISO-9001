<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChucDanh extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "chucdanhs";
    protected $fillable = ['id', 'ten', 'level'];
    public $timestamps;
}
