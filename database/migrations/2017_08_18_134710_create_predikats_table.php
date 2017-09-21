<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePredikatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predikats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nilai_awal');
            $table->integer('nilai_akhir');
            $table->string('predikat_ki1_ki2');
            $table->string('predikat_ki3_ki4');
            $table->boolean('lulus_ki1_ki2');
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
        Schema::dropIfExists('predikats');
    }
}
