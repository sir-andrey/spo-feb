<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalikelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('walikelas', function (Blueprint $table) {
            $table->increments('id_walikelas');

            $table->integer('id_user')->unsigned()->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('id_guru')->unsigned();
            $table->foreign('id_guru')->references('id_guru')->on('gurus')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('walikelas');
    }
}
