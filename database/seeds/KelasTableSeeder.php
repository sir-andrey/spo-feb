<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class KelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kelas')->insert([
        	'id_kelas' => '1',
        	'kode_kelas' => 'K0001',
        	'tingkat' => 'XI',
        	'id_jurusan' => '1',
        	'kelas' => 'A',
        	'id_tahun' => '1',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);

        DB::table('kelas')->insert([
        	'id_kelas' => '2',
        	'kode_kelas' => 'K0002',
        	'tingkat' => 'XI',
        	'id_jurusan' => '2',
        	'kelas' => 'B',
        	'id_tahun' => '2',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);


        DB::table('kelas')->insert([
        	'id_kelas' => '3',
        	'kode_kelas' => 'K0003',
        	'tingkat' => 'XI',
        	'id_jurusan' => '3',
        	'kelas' => 'C',
        	'id_tahun' => '3',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);

        DB::table('kelas')->insert([
            'id_kelas' => '4',
            'kode_kelas' => 'K0004',
            'tingkat' => 'XI',
            'id_jurusan' => '1',
            'kelas' => 'B',
            'id_tahun' => '2',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);


        
    }
}
