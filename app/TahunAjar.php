<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAjar extends Model
{
    protected $table = 'tahun_ajars';
    protected $primaryKey = 'id';
	protected $fillable=['nama','total_hari_efektif','siswa_id'];
	public $timestamps=true;
	protected $guarded=['id'];

	public function semester()
    {
        return $this->hasMany('App\Semester','tahun_ajar_id');
    }

    public function siswaMasuk()
    {
        return $this->hasMany('App\Siswa','tahun_ajar_id');
    }

    public function kelasBuka()
    {
        return $this->hasMany('App\KelasBuka', 'tahun_ajar_id');
    }
}
