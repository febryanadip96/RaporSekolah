<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ekstrakulikuler extends Model
{
	use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
	protected $dates = ['deleted_at'];
	protected $table = 'ekstrakulikulers';
	protected $primaryKey = 'id';
	protected $fillable=['nama'];
	public $timestamps=true;
	protected $guarded=['id'];

	public function nilaiEkstrakulikuler()
	{
		return $this->hasMany('App\NilaiEkstrakulikuler','ekstrakulikuler_id');
	}
}
