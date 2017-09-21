<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemesterSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semester_siswas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('catatan_walikelas')->nullable();
            $table->integer('semester_id')->unsigned();
            $table->foreign('semester_id')->references('id')->on('semesters');
            $table->integer('kelas_buka_id')->unsigned();
            $table->foreign('kelas_buka_id')->references('id')->on('kelas_bukas');
            $table->integer('siswa_id')->unsigned();
            $table->foreign('siswa_id')->references('id')->on('siswas');
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
        Schema::dropIfExists('semester_siswas');
    }
}
