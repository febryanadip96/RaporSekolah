<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentitasSekolahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identitas_sekolahs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('nis');
            $table->string('email')->unique();
            $table->text('alamat');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('provinsi');
            $table->integer('kota_id')->unsigned();
            $table->foreign('kota_id')->references('id')->on('kotas');
            $table->string('website')->nullable();
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
        Schema::dropIfExists('identitas_sekolahs');
    }
}
