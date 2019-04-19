<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;
    

class Siswa extends Model
{
    protected $table = "siswas";
	protected $primaryKey = "id_siswa"; 
    protected $fillable = [
        'kode_siswa',
    	'nisn',
    	'nama_siswa',
    	'id_kelas',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

   

}
