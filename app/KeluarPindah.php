<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeluarPindah extends Model
{
    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];
    protected $table = 'keluar_pindahs';
    protected $primaryKey = 'id';
		protected $fillable=['siswa_id','tanggal','status','alasan'];
		public $timestamps=true;
		protected $guarded=['id'];

		public function siswa()
    {
        return $this->belongsTo('App\Siswa','siswa_id')->onlyTrashed();
    }
}
