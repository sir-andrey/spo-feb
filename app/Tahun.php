<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    protected $table = "tahuns";
	protected $primaryKey = "id_tahun"; 
   protected $fillable = [
    	'kode_tahun',	
    	'tahun',
    ];

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id_tahun', 'id_tahun');
    }
}
