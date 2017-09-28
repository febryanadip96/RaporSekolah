<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nik');
            $table->boolean('super');
            $table->boolean('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->integer('tempat_lahir_id')->unsigned();
            $table->foreign('tempat_lahir_id')->references('id')->on('kotas');
            $table->text('alamat');
            $table->string('no_telp');
            $table->integer('ijazah_id')->unsigned();
            $table->foreign('ijazah_id')->references('id')->on('ijazahs');
            $table->integer('agama');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
}
