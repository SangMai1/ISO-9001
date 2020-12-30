<?php

namespace App\Models;

use App\Util\UpdateUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lichxuatxes extends Model
{
    use SoftDeletes, UpdateUser;
    public $timestamps = true;
    protected $table = "lichxuatxes";
    protected $fillable = ["id", "xeid", "nhanvienid", "cuochopid", "thoigiandidukien", "thoigianvedukien", "thoigiandithucte", "thoigianvethucte", "sokmtruockhidi", "sokmsaukhidi", "diadiemdi", "ghichu", "nguoitao", "nguoisua"];
}
