<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Walikelas extends Model
{
    protected $table = "walikelas";
	protected $primaryKey = "id_walikelas"; 
    protected $fillable = [
        'id_walikelas',
        'id_guru',
    	'id_kelas',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

 
}
