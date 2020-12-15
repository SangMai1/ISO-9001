<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhoms extends Model
{
    public $timestamps = false;
    protected $table = "nhoms";
    protected $fillable = ["id", "ma", "ten", "nguoitao", "ngaytao", "nguoisua", "ngaysua", "daxoa"];

    public function chucnangs(){
        return $this->belongsToMany(chucnangs::class, 'chucnangid');
    }
}
