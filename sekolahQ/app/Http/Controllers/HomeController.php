<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peta;
use App\Sekolah;


class HomeController extends Controller
{
    public function index()
    {
        return view('tampilan_awal');
    }
    
}
