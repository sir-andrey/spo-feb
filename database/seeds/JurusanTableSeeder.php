<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class JurusanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jurusans')->insert([
            'kode_jurusan'    => 'J0001',
        	'nama_jurusan'    => 'RPL',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);

        DB::table('jurusans')->insert([
        	'kode_jurusan'    => 'J0002',
            'nama_jurusan'    => 'ANM',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);

        DB::table('jurusans')->insert([
        	'kode_jurusan'    => 'J0003',
            'nama_jurusan'    => 'MM',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);

        DB::table('jurusans')->insert([
        	'kode_jurusan'    => 'J0004',
            'nama_jurusan'    => 'KI',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);
    }
}
