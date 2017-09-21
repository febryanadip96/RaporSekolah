<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapelBukasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapel_bukas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kkm');
            $table->integer('mata_pelajaran_id')->unsigned();
            $table->foreign('mata_pelajaran_id')->references('id')->on('mata_pelajarans');
            $table->integer('kelas_buka_id')->unsigned();
            $table->foreign('kelas_buka_id')->references('id')->on('kelas_bukas');
            $table->integer('pengajar_id')->unsigned();
            $table->foreign('pengajar_id')->references('id')->on('karyawans');
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
        Schema::dropIfExists('mapel_bukas');
    }
}
