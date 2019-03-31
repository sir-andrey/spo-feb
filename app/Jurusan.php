<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = "jurusans";
	protected $primaryKey = "id_jurusan"; 
    protected $fillable = [
    	'kode_jurusan',
    	'nama_jurusan',
    ];

    public function kelas()
    {
    	return $this->belongsTo(Kelas::class, 'id_jurusan', 'id_jurusan');
    }
}
