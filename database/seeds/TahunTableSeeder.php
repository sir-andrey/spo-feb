<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TahunTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('tahuns')->insert([
        	'id_tahun' => '1',
        	'kode_tahun' => 'TA001',
        	'tahun' => '2017-2018',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);

         DB::table('tahuns')->insert([
        	'id_tahun' => '2',
        	'kode_tahun' => 'TA002',
        	'tahun' => '2018-2019',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);
        
         DB::table('tahuns')->insert([
        	'id_tahun' => '3',
        	'kode_tahun' => 'TA003',
        	'tahun' => '2019-2020',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]); 
        
    }
}
