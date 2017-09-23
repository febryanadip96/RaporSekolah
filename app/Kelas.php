<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];
    protected $table = 'kelas';
    protected $primaryKey = 'id';
		protected $fillable=['tingkat'];
		public $timestamps=true;
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
