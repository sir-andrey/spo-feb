<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->increments('id_jadwal');
            $table->string('kode_jadwal', 11)->unique();
        
            $table->integer('id_guru')->unsigned();
            $table->foreign('id_guru')->references('id_guru')->on('gurus')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('id_mapel')->unsigned();
            $table->foreign('id_mapel')->references('id_mapel')->on('mapels')->onUpSdate('cascade')->onDelete('cascade');
            

            $table->integer('id_kelas')->unsigned();
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onUpdate('cascade')->onDelete('cascade');


            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwals');
    }
}
