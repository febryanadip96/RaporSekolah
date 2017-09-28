<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ijazah extends Model
{
    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];
    protected $table = 'ijazahs';
    protected $primaryKey = 'id';
	protected $fillable=['nama'];
	public $timestamps=true;
	protected $guarded=['id'];

	public function karyawan()
    {
    	return $this->hasMany('App\Karyawan','ijazah_id');
    }
}
