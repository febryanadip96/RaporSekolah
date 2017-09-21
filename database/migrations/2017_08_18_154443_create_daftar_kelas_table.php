<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_kelas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('siswa_id')->unsigned();
            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->integer('kelas_buka_id')->unsigned();
            $table->foreign('kelas_buka_id')->references('id')->on('kelas_bukas');
            $table->boolean('status_lulus');
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
        Schema::dropIfExists('daftar_kelas');
    }
}
