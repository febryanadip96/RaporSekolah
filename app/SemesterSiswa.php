<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SemesterSiswa extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'semester_siswas';
    protected $primaryKey = 'id';
	protected $fillable=['semester_id','kelas_buka_id','siswa_id','catatan_walikelas'];
	public $timestamps=true;
	protected $guarded=['id'];

	public function kelasBuka()
    {
        return $this->belongsTo('App\KelasBuka','kelas_buka_id');
    }

    public function ketidakhadiran()
    {
        return $this->hasMany('App\Ketidakhadiran','semester_siswa_id');
    }

    public function nilaiEkstrakulikuler()
    {
        return $this->hasMany('App\NilaiEkstrakulikuler','semester_siswa_id');
    }

    public function nilaiSikap()
    {
        return $this->hasOne('App\NilaiSikap','semester_siswa_id');
    }

    public function prestasi()
    {
        return $this->hasMany('App\Prestasi','semester_siswa_id');
    }

    public function semester()
    {
        return $this->belongsTo('App\Semester','semester_id');
    }

    public function siswa()
    {
        return $this->belongsTo('App\Siswa','siswa_id')->withTrashed();
    }

    public function nilaiRapor()
    {
        return $this->hasMany('App\NilaiRapor','semester_siswa_id');
    }
}
