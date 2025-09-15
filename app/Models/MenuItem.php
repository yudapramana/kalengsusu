<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $table = "menu_items";

    protected $fillable = ['title', 'name', 'slug', 'type', 'target', 'menu_id', 'created_at', 'updated_at'];
}
