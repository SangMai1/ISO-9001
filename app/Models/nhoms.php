<?php

namespace App\Models;

use App\Util\UpdateUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class nhoms extends Model
{
    use SoftDeletes, UpdateUser;
    public $timestamps = true;
    protected $table = "nhoms";
    protected $fillable = ["id", "ma", "ten", "nguoitao", "nguoisua"];

}
