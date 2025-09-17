<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;


class Gallery extends Model
{
    use HasFactory;

    protected $table = "galleries";

    protected $primaryKey = 'id_gallery';
 
    protected $guarded = [];

    protected $appends = ['thumbnail_image'];


    public function getThumbnailImageAttribute(){
        
        $img_url = $this->attributes['image_url'];
        if($img_url && stripos($img_url, 'http') === 0) {
            $separator = '/upload/';
            $exp = explode($separator, $img_url);
            return $exp[0] . '/upload/q_5/' . $exp[1];
        } else {
            return $this->image_url;
        }
        
    }

    public function getImageUrlAttribute($value) 
    {
        if (empty($value)) {
            return null;
        }

        if (stripos($value, 'http') === 0) {
            return $value;
        }

        try {
            $json = Crypt::decryptString($value);
            $payload = json_decode($json, true);

            if (!$payload || !isset($payload['public_id'])) {
                return null;
            }

            $cloudName = config('services.cloudinary.cloud_name', 'dezj1x6xp');
            $versionSegment = !empty($payload['version']) ? $payload['version'].'/' : '';
            $ext = !empty($payload['ext']) ? '.'.$payload['ext'] : '';

            return "https://res.cloudinary.com/{$cloudName}/image/upload/{$versionSegment}{$payload['public_id']}{$ext}";
        } catch (\Exception $e) {
            return null;
        }
    }
}
