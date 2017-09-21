<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'siswas';
    protected $primaryKey = 'id';
	protected $fillable=['user_id','nis','nisn','jenis_kelamin','tanggal_lahir','tempat_lahir_id','alamat','agama','tanggal_masuk','tahun_ajar_id','telpon_rumah','sekolah_asal_id','kelas_awal_id','anak_ke','ayah','ibu','wali','pekerjaan_ayah_id','pekerjaan_ibu_id','pekerjaan_wali_id','alamat_ortu','alamat_wali','telpon_rumah_ortu','telpon_rumah_wali'];
    public $timestamps=true;
	protected $guarded=['id'];

	public function daftarKelas()
    {
    	return $this->hasMany('App\DaftarKelas','siswa_id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User','user_id')->withTrashed();
    }

    public function keluarPindah()
    {
        return $this->hasOne('App\KeluarPindah','siswa_id');
    }

    public function asal()
    {
        return $this->belongsTo('App\Kota','tempat_lahir_id');
    }

    public function pekerjaanAyah()
    {
        return $this->belongsTo('App\Pekerjaan','pekerjaan_ayah_id');
    }

    public function pekerjaanIbu()
    {
        return $this->belongsTo('App\Pekerjaan','pekerjaan_ibu_id');
    }

    public function pekerjaanWali()
    {
        return $this->belongsTo('App\Pekerjaan','pekerjaan_wali_id');
    }

    public function sekolahAsal()
    {
        return $this->belongsTo('App\Sekolah','sekolah_asal_id');
    }

    public function semesterSiswa()
    {
        return $this->hasMany('App\SemesterSiswa','siswa_id');
    }

    public function masukTahunAjar()
    {
        return $this->belongsTo('App\TahunAjar','tahun_ajar_id');
    }

    public function masukKelasAwal()
    {
        return $this->belongsTo('App\Kelas','kelas_awal_id');
    }
}
