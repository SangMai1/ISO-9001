<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $timestamp = ['daxoa'];

    protected $fillable = [
        'name',
        'password',
        'nhanvienid',
        'nguoitao',
        'nguoisua'
       
    
    ];
}
