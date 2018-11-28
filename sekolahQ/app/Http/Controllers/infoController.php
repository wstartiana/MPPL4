<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class infoController extends Controller
{
    public function index()
    {
        return view('info');
    }
}
