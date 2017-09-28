<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MataPelajaran extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'mata_pelajarans';
    protected $primaryKey = 'id';
	protected $fillable=['nama','keterangan','urutan','jenis','kelas_id','kelompok_id'];
	public $timestamps=true;
	protected $guarded=['id'];

	public function kelompok()
    {
        return $this->belongsTo('App\Kelompok','kelompok_id');
    }

    public function mapelBuka()
    {
        return $this->hasMany('App\MapelBuka','mata_pelajaran_id');
    }

    public function kompetensiDasar()
    {
        return $this->hasMany('App\KompetensiDasar','mata_pelajaran_id');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas','kelas_id');
    }
}
