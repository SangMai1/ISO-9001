<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhomsvachucnangs extends Model
{
    public $timestamps = false;
    protected $table = "nhomsvachucnangs";
    protected $fillable = ["nhomid", "chucnangid"];

    // function nhoms(){
    //     return $this -> belongsToMany(nhoms::class);
    // }

    // function chucnangs(){
    //     return $this -> belongsToMany(chucnangs::class);
    // }
}
