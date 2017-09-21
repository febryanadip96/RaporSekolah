<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUlanganHariansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ulangan_harians', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nilai')->nullable();
            $table->integer('remidi')->nullable();
            $table->integer('nilai_akhir')->nullable();
            $table->integer('nilai_rapor_id')->unsigned();
            $table->foreign('nilai_rapor_id')->references('id')->on('nilai_rapors');
            $table->integer('kompetensi_dasar_id')->unsigned();
            $table->foreign('kompetensi_dasar_id')->references('id')->on('kompetensi_dasars');
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
        Schema::dropIfExists('ulangan_harians');
    }
}
