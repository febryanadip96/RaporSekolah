<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiSikapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_sikaps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nilai_spiritual');
            $table->integer('predikat_spiritual_id')->unsigned()->nullable();
            $table->foreign('predikat_spiritual_id')->references('id')->on('predikats');
            $table->integer('nilai_sosial');
            $table->integer('predikat_sosial_id')->unsigned()->nullable();
            $table->foreign('predikat_sosial_id')->references('id')->on('predikats');
            $table->text('deskripsi_spiritual')->nullable();
            $table->text('deskripsi_sosial')->nullable();
            $table->integer('semester_siswa_id')->unsigned();
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
        Schema::dropIfExists('nilai_sikaps');
    }
}
