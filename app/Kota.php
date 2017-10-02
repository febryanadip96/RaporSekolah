<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'kotas';
    protected $primaryKey = 'id';
	protected $fillable=['nama'];
	public $timestamps=false;
	protected $guarded=['id'];

	public function karyawan()
    {
        return $this->hasMany('App\Karyawan','tempat_lahir_id');
    }

    public function siswa()
    {
        return $this->hasMany('App\Siswa','tempat_lahir_id');
    }

    public function identitas()
    {
        return $this->hasOne('App\IdentitasSekolah','kota_id');
    }
}
