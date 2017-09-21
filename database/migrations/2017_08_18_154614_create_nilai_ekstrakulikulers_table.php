<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiEkstrakulikulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_ekstrakulikulers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nilai');
            $table->integer('semester_siswa_id')->unsigned();
            $table->foreign('semester_siswa_id')->references('id')->on('semester_siswas');
            $table->integer('ekstrakulikuler_id')->unsigned();
            $table->foreign('ekstrakulikuler_id')->references('id')->on('ekstrakulikulers');
            $table->integer('predikat_id')->unsigned();
            $table->foreign('predikat_id')->references('id')->on('predikats');
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
        Schema::dropIfExists('nilai_ekstrakulikulers');
    }
}
