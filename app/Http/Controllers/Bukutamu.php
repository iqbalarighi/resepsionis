<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Bukutamu extends Controller
{
    public function bukutamu()
    {
       return view('buku_tamu.index');
    }
    
}
