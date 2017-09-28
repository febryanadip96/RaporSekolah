<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kota extends Model
{
    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];
    protected $table = 'kotas';
    protected $primaryKey = 'id';
	protected $fillable=['nama'];
	public $timestamps=true;
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
