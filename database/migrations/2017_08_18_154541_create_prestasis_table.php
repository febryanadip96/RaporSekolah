<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestasis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_lomba');
            $table->integer('tingkat');
            $table->integer('semester_siswa_id')->unsigned();
            $table->foreign('semester_siswa_id')->references('id')->on('semester_siswas');
            $table->integer('peringkat_id')->unsigned();
            $table->foreign('peringkat_id')->references('id')->on('peringkats');
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
        Schema::dropIfExists('prestasis');
    }
}
