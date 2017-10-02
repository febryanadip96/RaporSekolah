<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semesters';
    protected $primaryKey = 'id';
	protected $fillable=['tahun_ajar_id','gasal_genap','status','awal_tutup_tengah_semester','akhir_tutup_tengah_semester','awal_tutup_akhir_semester','akhir_tutup_akhir_semester'];
	public $timestamps=true;
	protected $guarded=['id'];

    public function tahunAjar()
    {
        return $this->belongsTo('App\TahunAjar','tahun_ajar_id');
    }

    public function semesterSiswa()
    {
        return $this->hasMany('App\SemesterSiswa','semester_id');
    }
}
