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

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }
}
