<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelompok extends Model
{
    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];
    protected $table = 'kelompoks';
    protected $primaryKey = 'id';
	protected $fillable=['nama'];
	public $timestamps=true;
	protected $guarded=['id'];

	public function mataPelajaran()
    {
        return $this->hasMany('App\MataPelajaran','kelompok_id');
    }
}
