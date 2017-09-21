<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DaftarKelas extends Model
{
    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];
    protected $table = 'daftar_kelas';
    protected $primaryKey = 'id';
    protected $fillable=['siswa_id','kelas_buka_id','status_lulus'];
	public $timestamps=true;
	protected $guarded=['id'];

	public function siswa()
    {
       return $this->belongsTo('App\Siswa','siswa_id')->withTrashed();
    }

    public function kelasBuka()
    {
        return $this->belongsTo('App\KelasBuka','kelas_buka_id');
    }
}
