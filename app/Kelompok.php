<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    protected $table = 'kelompoks';
    protected $primaryKey = 'id';
	protected $fillable=['nama'];
	public $timestamps=false;
	protected $guarded=['id'];

	public function mataPelajaran()
    {
        return $this->hasMany('App\MataPelajaran','kelompok_id');
    }
}
