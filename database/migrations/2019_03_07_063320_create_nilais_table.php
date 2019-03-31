<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_nilai', 11);
            $table->integer('id_siswa')->unsigned();
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_mapel')->unsigned();
            $table->foreign('id_mapel')->references('id_mapel')->on('mapels')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_guru')->unsigned()->nullable();
            $table->foreign('id_guru')->references('id_guru')->on('gurus')->onUpdate('cascade')->onDelete('cascade');
            $table->string('semester');
            $table->integer('n1')->nullable();
            $table->integer('n2')->nullable();
            $table->integer('n3')->nullable();
            $table->integer('pts')->nullable();
            $table->integer('pas')->nullable();
            $table->integer('na')->nullable();
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
        Schema::dropIfExists('nilais');
    }
}
