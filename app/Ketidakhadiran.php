<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ketidakhadiran extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'ketidakhadirans';
    protected $primaryKey = 'id';
	protected $fillable=['semester_siswa_id','tanggal','status'];
	public $timestamps=false;
	protected $guarded=['id'];

	public function semesterSiswa()
    {
        return $this->belongsTo('App\SemesterSiswa','semester_siswa_id');
    }
}
