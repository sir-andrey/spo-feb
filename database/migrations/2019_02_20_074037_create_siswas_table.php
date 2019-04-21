<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->increments('id_siswa');

            $table->integer('id_user')->unsigned()->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->string('kode_siswa',5)->unique();
            $table->string('nisn',10);
            $table->string('nama_siswa',50);
            $table->enum('jk', array('Laki Laki', 'Perempuan'));
            $table->string('tempat_lahir',30);
            $table->date('tanggal_lahir');
            $table->enum('agama', array('Buddha', 'Hindu','Islam','Katolik','Kong Hu Cu','Protestan'))->nullable();
            $table->string('alamat',200);
            $table->string('no_telp',50);

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
        Schema::dropIfExists('siswas');
    }
}
