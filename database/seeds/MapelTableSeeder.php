<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MapelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('mapels')->insert([
            'id_mapel' => '1',
            'kode_mapel' => 'M0001',
        	'nama_mapel' => 'PPB',
            'kategori' => 'Produktif',
            'id_jurusan' => '1',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);
        
         DB::table('mapels')->insert([
            'id_mapel' => '2',
            'kode_mapel' => 'M0002',
        	'nama_mapel' => 'PBO',
            'kategori' => 'Produktif',
            'id_jurusan' => '1',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);

         DB::table('mapels')->insert([
            'id_mapel' => '3',
            'kode_mapel' => 'M0003',
            'nama_mapel' => 'PPL',
            'kategori' => 'Produktif',
            'id_jurusan' => '1',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
    }
}
