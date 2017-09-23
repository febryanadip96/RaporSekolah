<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MapelBuka extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'mapel_bukas';
    protected $primaryKey = 'id';
		protected $fillable=['kkm','mata_pelajaran_id','kelas_buka_id','pengajar_id'];
		public $timestamps=true;
		protected $guarded=['id'];

		public function pengajar()
    {
        return $this->belongsTo('App\Karyawan','pengajar_id')->withTrashed();
    }

    public function kelasBuka()
    {
        return $this->belongsTo('App\KelasBuka','kelas_buka_id');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo('App\MataPelajaran','mata_pelajaran_id');
    }

    public function nilaiRapor()
    {
        return $this->hasMany('App\NilaiRapor','mapel_buka_id');
    }
}
