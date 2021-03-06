<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pekerjaan extends Model
{
    protected $table = 'pekerjaans';
    protected $primaryKey = 'id';
	protected $fillable=['nama'];
	public $timestamps=false;
	protected $guarded=['id'];

	public function ayah()
    {
    	return $this->hasMany('App\Siswa','pekerjaan_ayah_id');
    }

    public function ibu()
    {
    	return $this->hasMany('App\Siswa','pekerjaan_ibu_id');
    }

    public function wali()
    {
    	return $this->hasMany('App\Siswa','pekerjaan_wali_id');
    }
}
