<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peringkat extends Model
{
    protected $table = 'peringkats';
    protected $primaryKey = 'id';
	protected $fillable=['juara'];
	public $timestamps=false;
	protected $guarded=['id'];

	public function prestasi()
    {
    	return $this->hasMany('App\Prestasi','peringkat_id');
    }
}
