<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = "activities";

    protected $primaryKey = 'id_activity';
 
    protected $guarded = [];

    protected $appends = ['rectangle_cover_image', 'square_cover_image'];

    public function getRectangleCoverImageAttribute(){
        $separator = '/upload/';
        $exp = explode($separator, $this->attributes['cover_image_url']);


        return $exp[0] . '/upload/c_fill,ar_16:9,q_50/' . $exp[1];
    }

    public function getSquareCoverImageAttribute(){
        $separator = '/upload/';
        $exp = explode($separator, $this->attributes['cover_image_url']);

        // return $exp[0] . '/upload/c_fill,h_200,w_200,f_avif,q_50/' . $exp[1];
        return $exp[0] . '/upload/c_fill,ar_4:3,q_50/' . $exp[1];

    }
}
