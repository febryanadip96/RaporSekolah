<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeluarPindahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluar_pindahs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('siswa_id')->unsigned();
            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->integer('status');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('keluar_pindahs');
    }
}
