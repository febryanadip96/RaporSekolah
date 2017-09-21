<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NilaiEkstrakulikuler extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'nilai_ekstrakulikulers';
    protected $primaryKey = 'id'; 
	protected $fillable=['nilai','semester_siswa_id','ekstrakulikuler_id','predikat_id'];
	public $timestamps=true;
	protected $guarded=['id'];

	public function ekstrakulikuler()
    {
    	return $this->belongsTo('App\Ekstrakulikuler','ekstrakulikuler_id');
    }

    public function semesterSiswa()
    {
    	return $this->belongsTo('App\SemesterSiswa','semester_siswa_id');
    }

    public function predikat()
    {
    	return $this->belongsTo('App\Predikat','predikat_id');
    }
}
