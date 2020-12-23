<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cauhinhs extends Model
{
    use HasFactory;

    protected $table = 'cauhinhs';

    protected $fillable = [
        'id',
        'ma',
        'ten',
        'giatri',
        'nguoitao',
        'nguoisua'
    
    ];
}


