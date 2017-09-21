<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelasBuka extends Model
{
    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];
    protected $table = 'kelas_bukas';
    protected $primaryKey = 'id';
	protected $fillable=['nama','wali_kelas_id','tahun_ajar_id','kelas_id'];
	public $timestamps=true;
	protected $guarded=['id'];

	public function daftarKelas()
    {
    	return $this->hasMany('App\DaftarKelas','kelas_buka_id');
    }

    public function waliKelas()
    {
    	return $this->belongsTo('App\Karyawan','wali_kelas_id')->withTrashed();
    }

    public function tahunAjar()
    {
        return $this->belongsTo('App\TahunAjar', 'tahun_ajar_id');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas','kelas_id');
    }

    public function mapelBuka()
    {
        return $this->hasMany('App\MapelBuka','kelas_buka_id');
    }

    public function semesterSiswa()
    {
        return $this->hasMany('App\SemesterSiswa','kelas_buka_id');
    }
}
