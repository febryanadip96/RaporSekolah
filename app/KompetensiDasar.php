<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KompetensiDasar extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'kompetensi_dasars';
    protected $primaryKey = 'id';
	protected $fillable=['nomor','deskripsi','gasal_genap','mata_pelajaran_id'];
	public $timestamps=true;
	protected $guarded=['id'];

	public function ketrampilan()
    {
        return $this->hasMany('App\Ketrampilan','kompetensi_dasar_id');
    }

    public function ulanganHarian()
    {
        return $this->hasMany('App\UlanganHarian','kompetensi_dasar_id');
    }

    public function tugas()
    {
        return $this->hasMany('App\Tugas','kompetensi_dasar_id');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo('App\MataPelajaran','mata_pelajaran_id');
    }
}
