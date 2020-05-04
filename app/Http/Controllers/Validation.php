<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Validation extends Controller
{
    public function input()
    {
        return view('input');
    }
 
    public function proses(Request $request)
    {
        $this->validate($request,[
           'nidn' => 'required|numeric|min:11',
           'nama' => 'required|min:5|max:20',
           'usia' => 'required|numeric'
        ]);
 
        return view('proses',['data' => $request]);
    }
    
    
}

