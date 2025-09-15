<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefDataSubKlasifikasi extends Model
{
    protected $table = 'ref_data_sub_klasifikasi';
    public $timestamps = true;
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id_data_sub_klasifikasi';

}