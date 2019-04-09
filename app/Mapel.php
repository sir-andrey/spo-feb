<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
	protected $table = "mapels";
	protected $primaryKey = "id_mapel"; 
    protected $fillable = [
        'kode_mapel',
    	'nama_mapel',
        'kategori',
        'id_jurusan',
    ];

    public function jadwal()
    {
    	return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }

    public function nilai()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }

}
