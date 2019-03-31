<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kelas;
use App\Siswa;
use App\Mapel;

class Nilai extends Model
{
    protected $table = "nilais";
	protected $primaryKey = "id"; 
    protected $fillable = [
        'kode_nilai',
        'id_siswa',
        'id_mapel',
        'id_guru',
        'semester',
        'n1',
        'n2',
        'n3',
        'pts',
        'pas',
        'na',
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
