<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ekstrakulikuler extends Model
{
	protected $table = 'ekstrakulikulers';
	protected $primaryKey = 'id';
	protected $fillable=['nama', 'jenis'];
	public $timestamps=false;
	protected $guarded=['id'];

	public function nilaiEkstrakulikuler()
	{
		return $this->hasMany('App\NilaiEkstrakulikuler','ekstrakulikuler_id');
	}
}
