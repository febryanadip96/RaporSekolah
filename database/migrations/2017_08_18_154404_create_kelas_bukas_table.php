<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelasBukasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas_bukas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->integer('wali_kelas_id')->unsigned();
            $table->foreign('wali_kelas_id')->references('id')->on('karyawans');
            $table->integer('tahun_ajar_id')->unsigned();
            $table->foreign('tahun_ajar_id')->references('id')->on('tahun_ajars');
            $table->integer('kelas_id')->unsigned();
            $table->foreign('kelas_id')->references('id')->on('kelas');
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
        Schema::dropIfExists('kelas_bukas');
    }
}
