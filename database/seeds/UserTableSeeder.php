<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name' => 'Administrator',
        	'email' => 'admin@gmail.com',
        	'username' => 'admin',
        	'id_level' => '1',
        	'password' => '$2y$10$2agbYlfLenAtqluoFEcRku9e6F.1MLOwh8ATHvmI8GVOpf/HgEC/i',
        	'remember_token' => '1',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);

        DB::table('users')->insert([
        	'name' => 'Guru',
        	'email' => 'guru@gmail.com',
        	'username' => 'guru',
        	'id_level' => '2',
        	'password' => '$2y$10$2agbYlfLenAtqluoFEcRku9e6F.1MLOwh8ATHvmI8GVOpf/HgEC/i',
        	'remember_token' => '1',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);

        DB::table('users')->insert([
        	'name' => 'Siswa',
        	'email' => 'siswa@gmail.com',
        	'username' => 'siswa',
        	'id_level' => '3',
        	'password' => '$2y$10$2agbYlfLenAtqluoFEcRku9e6F.1MLOwh8ATHvmI8GVOpf/HgEC/i',
        	'remember_token' => '1',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);

        DB::table('users')->insert([
        	'name' => 'Walikelas',
        	'email' => 'walikelas@gmail.com',
        	'username' => 'walikelas',
        	'id_level' => '4',
        	'password' => '$2y$10$2agbYlfLenAtqluoFEcRku9e6F.1MLOwh8ATHvmI8GVOpf/HgEC/i',
        	'remember_token' => '1',
        	'created_at'	=> Carbon::now(),
        	'updated_at'	=> Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Gani Setiawan',
            'email' => 'gani@gmail.com',
            'username' => 'guru',
            'id_level' => '2',
            'password' => '$2y$10$2agbYlfLenAtqluoFEcRku9e6F.1MLOwh8ATHvmI8GVOpf/HgEC/i',
            'remember_token' => '1',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
        
    }
}
