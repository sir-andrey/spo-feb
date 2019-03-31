<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_siswa')->unsigned();
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_mapel')->unsigned();
            $table->foreign('id_mapel')->references('id_mapel')->on('mapels')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_tahun')->unsigned();
            $table->foreign('id_tahun')->references('id_tahun')->on('tahuns')->onUpdate('cascade')->onDelete('cascade');
            $table->string('bulan');
            $table->integer('sakit');
            $table->integer('izin');
            $table->integer('alpa');
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
        Schema::dropIfExists('absens');
    }
}
