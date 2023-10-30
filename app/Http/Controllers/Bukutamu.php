<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class Bukutamu extends Controller
{
    public function bukutamu()
    {
       return view('buku_tamu.index');
    }

    public function store(Request $request)
    {
       
    }
    
}
