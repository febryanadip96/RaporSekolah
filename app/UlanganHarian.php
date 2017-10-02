<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UlanganHarian extends Model
{
    protected $table = 'ulangan_harians';
    protected $primaryKey = 'id';
	protected $fillable=['nilai','remidi','nilai_akhir','nilai_rapor_id','kompetensi_dasar_id'];
	public $timestamps=false;
	protected $guarded=['id'];

	public function kompetensiDasar()
    {
        return $this->belongsTo('App\KompetensiDasar','kompetensi_dasar_id')->withTrashed();
    }

    public function nilaiRapor()
    {
        return $this->belongsTo('App\NilaiRapor','nilai_rapor_id');
    }
}
