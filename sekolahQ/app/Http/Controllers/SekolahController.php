<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peta;
use App\Sekolah;

class SekolahController extends Controller
{
    public function lihatSekolah($id){
        $result = sekolah::where('id_sekolah',$id)->get();
        return view('lihatSekolah', compact('result'));
      }
    
    public function cariSekolah(){
        $jenjang = request('optradio');
        // echo $jenjang;
        $result = sekolah::where('jenjang', $jenjang)->get();
        return response()->json([
            'sekolah' => $result
        ]);
    }

    public function infoSekolah($id){
        $result = sekolah::where('id_sekolah',$id)->get();
        return view('info', compact('result'));
    }
}
