<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMataPelajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_pelajarans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('keterangan')->nullable();
            $table->integer('jenis');
            $table->integer('urutan');
            $table->integer('kelas_id')->unsigned();
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->integer('kelompok_id')->unsigned();
            $table->foreign('kelompok_id')->references('id')->on('kelompoks');
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
        Schema::dropIfExists('mata_pelajarans');
    }
}
