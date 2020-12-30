<?php

namespace App\Models;

use App\Util\UpdateUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lichsusuachuas extends Model
{
    use SoftDeletes, UpdateUser;
    public $timestamps = true;
    protected $table = "lichsusuachuas";
    protected $fillable = ["id", "taisanid", "nguoidisua", "thoigiansua", "giatien", "ghichu", "nguoitao", "nguoisua"];
}
