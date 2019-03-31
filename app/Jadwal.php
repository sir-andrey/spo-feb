<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = "jadwals";
	protected $primaryKey = "id_jadwal"; 
    protected $fillable = [
        'id_jadwal',
    	'id_guru',
    	'id_mapel',
        'id_kelas',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
    
    public function tahun()
    {
        return $this->belongsTo(Tahun::class, 'id_tahun', 'id_tahun');
    }

}
