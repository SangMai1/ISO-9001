<?php

namespace App\Models;

use App\Util\UpdateUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class xes extends Model
{
    use SoftDeletes, UpdateUser;
    public $timestamps = true;
    protected $table = "xes";
    protected $fillable = ["id", "taisanid", "bienso", "socho", "nhanvienid", "nguoitao", "nguoisua"];
}
