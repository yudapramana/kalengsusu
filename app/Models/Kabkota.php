<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabkota extends Model
{
    use HasFactory;

    protected $table = "kabkota";

    protected $primaryKey = 'id_kabkota';

    protected $guarded = [];
    
}
