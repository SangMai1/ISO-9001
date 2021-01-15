<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usersvachucnangs extends Model
{
    public $timestamps = false;
    protected $table = "usersvachucnangs";
    protected $fillable = ["userid", "chucnangid"];
}
