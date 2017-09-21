<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UlanganHarian extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'ulangan_harians';
    protected $primaryKey = 'id'; 
	protected $fillable=['nilai','remidi','nilai_akhir','nilai_rapor_id','kompetensi_dasar_id'];
	public $timestamps=true;
	protected $guarded=['id'];

	public function kompetensiDasar()
    {
        return $this->belongsTo('App\KompetensiDasar','kompetensi_dasar_id');
    }

    public function nilaiRapor()
    {
        return $this->belongsTo('App\NilaiRapor','nilai_rapor_id');
    }
}
