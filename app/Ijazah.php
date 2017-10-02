<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ijazah extends Model
{
    protected $table = 'ijazahs';
    protected $primaryKey = 'id';
	protected $fillable=['nama'];
	public $timestamps=false;
	protected $guarded=['id'];

	public function karyawan()
    {
    	return $this->hasMany('App\Karyawan','ijazah_id');
    }
}
