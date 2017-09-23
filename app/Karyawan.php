<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'karyawans';
    protected $primaryKey = 'id';
		protected $fillable=['user_id','super','jenis_kelamin','tanggal_lahir','tempat_lahir_id','alamat','no_telp','ijazah_id','agama'];
		public $timestamps=true;
		protected $guarded=['id'];

		public function user()
    {
    	return $this->belongsTo('App\User','user_id')->withTrashed();
    }

    public function walikelas()
    {
    	return $this->hasMany('App\KelasBuka','wali_kelas_id');
    }

    public function mengajar()
    {
        return $this->hasMany('App\MapelBuka','pengajar_id');
    }

    public function asal()
    {
        return $this->belongsTo('App\Kota','tempat_lahir_id');
    }

    public function ijazah()
    {
        return $this->belongsTo('App\Ijazah','ijazah_id');
    }
}
