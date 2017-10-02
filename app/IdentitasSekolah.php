<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdentitasSekolah extends Model
{
    protected $table = 'identitas_sekolahs';
    protected $primaryKey = 'id';
	protected $fillable=['nama','nis','email','alamat','kelurahan','kecamatan','provinsi','kota_id','website'];
	public $timestamps=false;
	protected $guarded=['id'];

	public function kota()
    {
        return $this->belongsTo('App\Kota','kota_id');
    }

}
