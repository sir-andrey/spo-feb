<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{	protected $table = "gurus";
	protected $primaryKey = "id_guru"; 
    protected $fillable = [
    	'kode_guru',
    	'nip',
    	'nama',
    ];

    public function jadwal()
    {
    	return $this->hasOne(Jadwal::class, 'id_guru', 'id_guru');
    }

    public function walikelas()
    {
    	return $this->hasOne(Walikelas::class, 'id_guru', 'id_guru');
    }
}

