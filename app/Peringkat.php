<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peringkat extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'peringkats';
    protected $primaryKey = 'id'; 
	protected $fillable=['juara'];
	public $timestamps=true;
	protected $guarded=['id'];

	public function prestasi()
    {
    	return $this->hasMany('App\Prestasi','peringkat_id');
    }
}
