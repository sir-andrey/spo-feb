<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
    
         Schema::create('gurus', function (Blueprint $table) {
            $table->increments('id_guru');
            $table->integer('id_user')->unsigned()->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_guru',5)->unique();
            $table->char('nip');
            $table->string('nama_guru',50)->unique();
            $table->enum('jk', array('Laki Laki', 'Perempuan'));
            $table->string('tempat_lahir',30);
            $table->date('tanggal_lahir');
            $table->enum('agama', array('Buddha', 'Hindu','Islam','Katolik','Kong Hu Cu','Protestan'))->nullable();
            $table->string('alamat',200);
            $table->string('no_telp',50);
        
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
        Schema::dropIfExists('gurus');
    }
}
