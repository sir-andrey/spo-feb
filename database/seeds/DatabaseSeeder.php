<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(LevelTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TahunTableSeeder::class);
        $this->call(JurusanTableSeeder::class);
        $this->call(KelasTableSeeder::class);
        $this->call(GuruTableSeeder::class);
        $this->call(MapelTableSeeder::class);
        $this->call(JadwalTableSeeder::class);
        $this->call(SiswaTableSeeder::class);
    }
}
