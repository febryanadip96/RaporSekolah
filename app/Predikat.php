<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Predikat extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'predikats';
    protected $primaryKey = 'id';
	protected $fillable=['nilai_awal','nilai_akhir','predikat_ki1_ki2','predikat_ki3_ki4','lulus_ki1_ki2'];
	public $timestamps=true;
	protected $guarded=['id'];

	public function nilaiEkstrakulikuler()
    {
    	return $this->hasMany('App\NilaiEkstrakulikuler','predikat_id');
    }

    public function pengetahuan()
    {
    	return $this->hasMany('App\NilaiRapor','predikat_pengetahuan_id');
    }

    public function ketrampilan()
    {
    	return $this->hasMany('App\NilaiRapor','predikat_ketrampilan_id');
    }

    public function sosial()
    {
        return $this->hasMany('App\NilaiSikap','predikat_sosial_id');
    }

    public function spiritual()
    {
        return $this->hasMany('App\NilaiSikap','predikat_spiritual_id');
    }
}
