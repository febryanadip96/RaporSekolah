<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKetidakhadiransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ketidakhadirans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('semester_siswa_id')->unsigned();
            $table->foreign('semester_siswa_id')->references('id')->on('semester_siswas');
            $table->date('tanggal');
            $table->integer('status');
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
        Schema::dropIfExists('ketidakhadirans');
    }
}
