<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $fillable = [
        'id_sekolah','nama_sekolah','kepala_sekolah','akreditasi','alamat_sekolah','status','jenjang','email','no_telp','kurikulum','total_siswa',
    ];
}
