<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolahs';
    protected $primaryKey = 'id';
	protected $fillable=['nama','negeri_swasta','alamat'];
	public $timestamps=false;
	protected $guarded=['id'];

	public function siswa()
    {
    	return $this->hasMany('App\Siswa','sekolah_asal_id');
    }
}
