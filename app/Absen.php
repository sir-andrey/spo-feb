<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $table = "absens";
    protected $primaryKey = "id";
    protected $fillable = [
    	'id_siswa',
    	'id_mapel',
    	'id_tahun',
    	'bulan',
    	'sakit',
    	'izin',
    	'alpa',
    ];
}
