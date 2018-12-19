<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peta;
use App\Sekolah;
use Illuminate\Support\Facades\DB;

class SekolahController extends Controller
{
    public function lihatSekolah($id){
        $result = sekolah::where('id_sekolah',$id)->get();
        return view('lihatSekolah', compact('result'));
      }
    
      public function cariSekolah(){
        $status = request('status');
        $jenjang = request('optradio');
        
        // echo $jenjang;
        if($status == 2){
            $result = sekolah::where('jenjang', $jenjang)->get();
        }
        else{
            // $result = sekolah::where('jenjang', $jenjang)->get();
            $result = DB::table('sekolahs')
                ->where('jenjang', '=', $jenjang)
                ->where('status', '=', $status)
                ->get();
            
        }

        // echo "heol";
        
        return response()->json([
            'sekolah' => $result
        ]);
    }

    public function infoSekolah($id){
        $result = sekolah::where('id_sekolah',$id)->get();
        return view('info', compact('result'));
    }
}
