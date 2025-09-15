<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Vinkla\Hashids\Facades\Hashids;
use URL;

class TrxDataFile extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    protected $table = 'trx_data_file';
    public $timestamps = true;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id_data_file';

    protected $appends = ['id_data_file_encrypt', 'url_full'];

    public function instansi()
    {
        return $this->belongsTo('App\Models\RefDataInstansi', 'id_data_instansi');
    }

    public function kategori()
    {
        return $this->belongsTo('App\Models\RefDataKategori', 'id_data_kategori');
    }

    public function klasifikasi()
    {
        return $this->belongsTo('App\Models\RefDataKlasifikasi', 'id_data_klasifikasi');
    }

    public function subklasifikasi()
    {
        return $this->belongsTo('\App\Models\RefDataSubKlasifikasi', 'id_data_sub_klasifikasi');
    }

    public function getIdDataFileEncryptAttribute()
    {
        // return \Crypt::encrypt($this->id_data_file);
        return Hashids::encode($this->id_data_file);
    }

    public function getUrlFullAttribute()
    {
        if($this->url_file) {
            $split = explode(URL::to('/'), $this->url_file);
            $urinya = URL::to('/') . '/' .( isset($split[1]) ? $split[1] : '/#');
            return $urinya;
        } else {
            return $urinya = URL::to('/') . '/#';
        }
        
    }
}
