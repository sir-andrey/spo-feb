<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{	protected $table = "kelas";
	protected $primaryKey = "id_kelas"; 
   protected $fillable = [
        'kode_kelas',
    	'tingkat',
    	'id_jurusan',
    	'kelas',
    	'id_tahun',	
    ];

    public function jurusan()
    {
        return $this->hasOne(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }

    public function siswa()
    {
        return $this->hasOne(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function jadwal()
    {
        return $this->hasOne(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function tahun()
    {
        return $this->belongsTo(Tahun::class, 'id_tahun', 'id_tahun');
    }
    public function walikelas()
    {
        return $this->belongsTo(Walikelas::class, 'id_kelas', 'id_kelas');
    }

}
