<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class JadwalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jadwals')->insert([
        	'kode_jadwal' => 'J0001',
        	'id_guru' => '1',
        	'id_mapel' => '1',
        	'id_kelas' => '1',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);
        DB::table('jadwals')->insert([
            'kode_jadwal' => 'J0002',
            'id_guru' => '4',
            'id_mapel' => '3',
            'id_kelas' => '4',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
    }
}
