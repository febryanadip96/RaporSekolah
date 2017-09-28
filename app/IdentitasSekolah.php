<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IdentitasSekolah extends Model
{
    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];
    protected $table = 'identitas_sekolahs';
    protected $primaryKey = 'id';
	protected $fillable=['nama','nis','email','alamat','kelurahan','kecamatan','provinsi','kota_id','website'];
	public $timestamps=true;
	protected $guarded=['id'];

	public function kota()
    {
        return $this->belongsTo('App\Kota','kota_id');
    }

}
