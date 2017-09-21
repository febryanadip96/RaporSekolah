<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestasi extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'prestasis';
    protected $primaryKey = 'id';
	protected $fillable=['nama_lomba','tingkat','semester_siswa_id','peringkat_id'];
	public $timestamps=true;
	protected $guarded=['id'];

	public function peringkat()
    {
    	return $this->belongsTo('App\Peringkat','peringkat_id');
    }

    public function semesterSiswa()
    {
    	return $this->belongsTo('App\SemesterSiswa','semester_siswa_id');
    }
}
