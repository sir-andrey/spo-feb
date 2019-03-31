<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = "levels";
	protected $primaryKey = "id_level"; 
    protected $fillable = [
    	'kode_level',
    	'nama_level',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class, 'id_level', 'id_level');
    }
}
