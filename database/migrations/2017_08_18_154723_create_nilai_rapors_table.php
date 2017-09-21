<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiRaporsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_rapors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nilai_pengetahuan')->nullable();
            $table->integer('nilai_ketrampilan')->nullable(); 
            $table->integer('predikat_pengetahuan_id')->unsigned()->nullable();
            $table->foreign('predikat_pengetahuan_id')->references('id')->on('predikats');
            $table->integer('predikat_ketrampilan_id')->unsigned()->nullable();
            $table->foreign('predikat_ketrampilan_id')->references('id')->on('predikats');
            $table->integer('nilai_pts')->nullable();
            $table->integer('nilai_pas')->nullable();
            $table->integer('mapel_buka_id')->unsigned()->nullable();
            $table->foreign('mapel_buka_id')->references('id')->on('mapel_bukas');
            $table->integer('semester_siswa_id')->unsigned()->nullable();
            $table->foreign('semester_siswa_id')->references('id')->on('semester_siswas');
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
        Schema::dropIfExists('nilai_rapors');
    }
}
