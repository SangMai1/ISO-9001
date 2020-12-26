<?php

namespace App\Models;

use App\Util\UpdateUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes, UpdateUser;
    public $timestamps = true;
    protected $table = "menus";
    protected $fillable = ["id", "idcha", "url", "ten", "nguoitao", "nguoisua", "icon"];
}
