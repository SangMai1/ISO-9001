<?php

namespace App\Models;

use App\Util\CommonUtil;
use App\Util\UpdateUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class PhongBan extends Model
{
    use HasFactory, SoftDeletes, UpdateUser;
    protected $table = "phongbans";
    protected $fillable = ['id', 'ten', 'truongphong_nvid', 'ghichu'];
    public $timestamps = true;

    public function truongphong(){
        return CommonUtil::cache('nhanvien_id_' . $this->truongphong_nvid, function(){
            return $this->truongphong_nvid ? $this->hasOne('App\Models\Nhanviens', 'id', 'truongphong_nvid')->first() : new Nhanviens();
        });
    }
}
