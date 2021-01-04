<?php

namespace App\Models;

use App\Util\UpdateUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use UpdateUser;
    public $timestamps = true;
    protected $table = "menus";
    protected $fillable = ["id", "idcha", "url", "ten", "nguoitao", "vitri", "nguoisua", "icon", "chucnangid"];

    public function isValidParentId($idcha)
    {
        if (!$idcha || $idcha < 1) return true;
        do {
            $menu = Menu::find($idcha);
            if(!$menu) return true;
            $idcha = $menu->idcha;

            if (!$idcha || $idcha < 1) return true;
            if ($idcha == $this->id) return false;
        } while (true);
    }
}
