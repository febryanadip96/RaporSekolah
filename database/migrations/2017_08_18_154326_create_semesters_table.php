<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tahun_ajar_id')->unsigned();
            $table->foreign('tahun_ajar_id')->references('id')->on('tahun_ajars');
            $table->boolean('gasal_genap');
            $table->boolean('status');
            $table->dateTime('awal_tutup_tengah_semester')->nullable();
            $table->dateTime('akhir_tutup_tengah_semester')->nullable();
            $table->dateTime('awal_tutup_akhir_semester')->nullable();
            $table->dateTime('akhir_tutup_akhir_semester')->nullable();
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
        Schema::dropIfExists('semesters');
    }
}
