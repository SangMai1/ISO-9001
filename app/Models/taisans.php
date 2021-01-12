<?php

namespace App\Models;

use App\Util\UpdateUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class taisans extends Model
{
    use SoftDeletes, UpdateUser;
    public $timestamps = true;
    protected $table = "taisans";
    protected $fillable = ["id", "mataisan", "tentaisan", "loaitaisanid", "giatien", "khauhao", "nguoitao", "nguoisua", "trangthai", "sohuu"];
}
