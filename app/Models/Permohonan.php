<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permohonan extends Model
{
    protected $table = 'daftar_permohonan';
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
    protected $primaryKey = 'id_permohonan';

}