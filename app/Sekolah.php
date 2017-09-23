<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sekolah extends Model
{
    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];
    protected $table = 'sekolahs';
    protected $primaryKey = 'id';
		protected $fillable=['nama','negeri_swasta','alamat'];
		public $timestamps=true;
		protected $guarded=['id'];

		public function siswa()
    {
    	return $this->hasMany('App\Siswa','sekolah_asal_id');
    }
}
