<?php

namespace App\Http\Controllers\u;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CuocHopController extends Controller
{
    public function create(){
        
        return view('u.cuochop.them-moi', []);
    }
}
