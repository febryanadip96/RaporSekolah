<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NilaiRapor extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'nilai_rapors';
    protected $primaryKey = 'id';
	protected $fillable=['nilai_pengetahuan','nilai_ketrampilan','predikat_pengetahuan_id','predikat_ketrampilan_id','nilai_pts','nilai_pas','mapel_buka_id','semester_siswa_id'];
	public $timestamps=false;
	protected $guarded=['id'];

	public function ketrampilan()
    {
        return $this->hasMany('App\Ketrampilan','nilai_rapor_id');
    }

    public function tugas()
    {
        return $this->hasMany('App\Tugas','nilai_rapor_id');
    }

    public function ulanganHarian()
    {
        return $this->hasMany('App\UlanganHarian','nilai_rapor_id');
    }

    public function mapelBuka()
    {
        return $this->belongsTo('App\MapelBuka','mapel_buka_id');
    }

    public function predikatPengetahuan()
    {
        return $this->belongsTo('App\Predikat','predikat_pengetahuan_id');
    }

    public function predikatKetrampilan()
    {
        return $this->belongsTo('App\Predikat','predikat_ketrampilan_id');
    }

    public function semesterSiswa()
    {
        return $this->belongsTo('App\SemesterSiswa','semester_siswa_id');
    }
}
