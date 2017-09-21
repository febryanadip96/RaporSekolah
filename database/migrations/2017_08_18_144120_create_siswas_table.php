<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nis');
            $table->string('nisn');
            $table->boolean('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->integer('tempat_lahir_id')->unsigned();
            $table->foreign('tempat_lahir_id')->references('id')->on('kotas');
            $table->text('alamat');
            $table->integer('agama');
            $table->date('tanggal_masuk');
            $table->integer('tahun_ajar_id')->unsigned();
            $table->foreign('tahun_ajar_id')->references('id')->on('tahun_ajars');
            $table->string('telpon_rumah')->nullable();
            $table->integer('sekolah_asal_id')->unsigned();
            $table->foreign('sekolah_asal_id')->references('id')->on('sekolahs');
            $table->integer('kelas_awal_id')->unsigned();
            $table->foreign('kelas_awal_id')->references('id')->on('kelas');
            $table->integer('anak_ke');
            $table->string('ayah');
            $table->string('ibu');
            $table->string('wali')->nullable();
            $table->integer('pekerjaan_ayah_id')->unsigned()->nullable();
            $table->foreign('pekerjaan_ayah_id')->references('id')->on('pekerjaans');
            $table->integer('pekerjaan_ibu_id')->unsigned()->nullable();
            $table->foreign('pekerjaan_ibu_id')->references('id')->on('pekerjaans');
            $table->integer('pekerjaan_wali_id')->unsigned()->nullable();
            $table->foreign('pekerjaan_wali_id')->references('id')->on('pekerjaans');
            $table->text('alamat_ortu')->nullable();
            $table->text('alamat_wali')->nullable();
            $table->string('telpon_rumah_ortu')->nullable();
            $table->string('telpon_rumah_wali')->nullable();
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
        Schema::dropIfExists('siswas');
    }
}
