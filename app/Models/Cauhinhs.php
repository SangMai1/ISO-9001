<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cauhinhs extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $table = 'cauhinhs';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'ma',
        'ten',
        'giatri',
        'nguoitao',
        'nguoisua',
        'ngaytao',
        'created_at'
    
    ];
}


