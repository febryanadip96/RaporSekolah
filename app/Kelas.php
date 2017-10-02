<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id';
	protected $fillable=['tingkat'];
	public $timestamps=false;
	protected $guarded=['id'];

	public function kelasBuka()
    {
    	return $this->hasMany('App\KelasBuka','kelas_id');
    }

    public function mataPelajaran()
    {
    	return $this->hasMany('App\MataPelajaran','kelas_id');
    }

    public function siswa()
    {
        return $this->hasMany('App\Siswa','kelas_awal_id');
    }
}
