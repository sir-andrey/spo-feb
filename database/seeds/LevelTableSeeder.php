<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            'kode_level'    => 'L0001',
        	'nama_level'    => 'Admin',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);

        DB::table('levels')->insert([
        	'kode_level'    => 'L0002',
            'nama_level'    => 'Guru',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);

        DB::table('levels')->insert([
        	'kode_level'    => 'L0003',
            'nama_level'    => 'Siswa',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);

        DB::table('levels')->insert([
        	'kode_level'    => 'L0004',
            'nama_level'    => 'Walikelas',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);
    }
}
