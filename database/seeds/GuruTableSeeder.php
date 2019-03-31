<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GuruTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gurus')->insert([
        	'id_guru' => '1',
            'kode_guru' => 'G0001',
        	'nip' => '123456789',
        	'nama_guru' => 'Gani Setiawan',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);
        DB::table('gurus')->insert([
            'id_guru' => '2',
            'kode_guru' => 'G0002',
            'nip' => '83278487837',
            'nama_guru' => 'Raya Nadira',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
         DB::table('gurus')->insert([
            'id_guru' => '3',
            'kode_guru' => 'G0003',
            'nip' => '29932434343',
            'nama_guru' => 'Mariam Komalawati',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
         DB::table('gurus')->insert([
            'id_guru' => '4',
            'kode_guru' => 'G0004',
            'nip' => '29932435443',
            'nama_guru' => 'R.Irfan Santika',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
    }
}
