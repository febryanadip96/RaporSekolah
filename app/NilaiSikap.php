<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiSikap extends Model
{
    protected $table = 'nilai_sikaps';
    protected $primaryKey = 'id';
	protected $fillable=['nilai_spiritual','predikat_spiritual_id','nilai_sosial','predikat_sosial_id','deskripsi_spiritual','deskripsi_sosial','semester_siswa_id'];
	public $timestamps=false;
	protected $guarded=['id'];

	public function predikatSosial()
    {
        return $this->belongsTo('App\Predikat','predikat_sosial_id');
    }

    public function predikatSpiritual()
    {
        return $this->belongsTo('App\Predikat','predikat_spiritual_id');
    }

    public function semesterSiswa()
    {
        return $this->belongsTo('App\SemesterSiswa','semester_siswa_id');
    }
}
