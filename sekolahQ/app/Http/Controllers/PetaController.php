<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peta;
use App\Sekolah;

class PetaController extends Controller
{
    public function index()
    {
        $result = peta::all();
        return view('peta', compact('result'));
        // return view('peta');
    }

    public function tampilpeta(){
        $result = peta::all();
        return view('tampilpeta', compact('result'));
    }
}
