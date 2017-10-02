<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKompetensiDasarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kompetensi_dasars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nomor');
            $table->text('deskripsi');
            $table->integer('gasal_genap');
            $table->integer('mata_pelajaran_id')->unsigned();
            $table->foreign('mata_pelajaran_id')->references('id')->on('mata_pelajarans');
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
        Schema::dropIfExists('kompetensi_dasars');
    }
}
