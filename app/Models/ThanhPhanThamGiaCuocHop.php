<?php

namespace App\Models;

use App\Util\UpdateUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThanhPhanThamGiaCuocHop extends Model
{
    use HasFactory, UpdateUser;
    protected $table = 'thamgiacuochops';
    protected $fillable = ['id', 'donvithamgia_id', 'donvithamgia_type', 'ghichu'];
}
