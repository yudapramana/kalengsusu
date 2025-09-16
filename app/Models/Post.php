<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $with = ['category', 'user', 'tags'];

    protected $appends = ['tanggal', 'view_count', 'cover_small', 'rectangle_cover_image', 'square_cover_image', 'square_cover_image_high', 'cover_url'];

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function incrementReadCount()
    {
        $this->reads++;
        return $this->save();
    }

    public function view()
    {
        return $this->hasMany(PostView::class);
    }

    public function kabkota()
    {
        return $this->belongsTo(Kabkota::class, 'id_kabkota');
    }

    public function getViewCountAttribute()
    {
        return $this->view()->count();
    }

    public function showPost()
    {
        if (auth()->id() == null) {
            return $this->view()
                ->where('ip', '=', request()->ip())->exists();
        }

        return $this->view()
            ->where(function ($postViewsQuery) {
                $postViewsQuery
                    ->where('session_id', '=', request()->getSession()->getId())
                    ->orWhere('user_id', '=', (auth()->check()));
            })->exists();
    }

    // public function getCoverSmallAttribute()
    // {

    //     if(isset($this->attributes['cover']) && (stripos($this->cover, 'http') === 0)) {

            

    //             if ($this->attributes['cover']) {
    //                 $separator = '/upload/';
    //                 $exp = explode($separator, $this->attributes['cover']);

    //                 return $exp[0] . '/upload/c_fill,ar_16:9,q_5,f_avif/' . $exp[1];
    //             } else {
    //                 return "http://res.cloudinary.com/dezj1x6xp/image/upload/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
    //             }

    //     } else {
    //         return "http://res.cloudinary.com/dezj1x6xp/image/upload/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
    //     }
    // }

    public function getCoverSmallAttribute()
    {
        $placeholder = "http://res.cloudinary.com/dezj1x6xp/image/upload/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
        $separator = '/upload/';

        $cover = $this->attributes['cover'] ?? null;

        // 1. Jika null atau kosong
        if (empty($cover)) {
            return $placeholder;
        }

        // 2. Jika cover diawali http (link cloudinary)
        if (stripos($cover, 'http') === 0) {
            $exp = explode($separator, $cover);

            if (count($exp) === 2) {
                return $exp[0] . '/upload/c_fill,ar_16:9,q_5,f_avif/' . $exp[1];
            }

            // kalau gagal explode, fallback placeholder
            return $placeholder;
        }

        // 3. Jika bukan http, gunakan accessor cover_url
        return $this->cover_url ?? $placeholder;
    }


    
    // public function getRectangleCoverImageAttribute()
    // {
    //     $separator = '/upload/';
    //     if(isset($this->attributes['cover']) && (stripos($this->cover, 'http') === 0)) {
    //         if ($this->attributes['cover']) {
    //             $exp = explode($separator, $this->attributes['cover']);


    //             return $exp[0] . '/upload/c_fill,ar_16:9,q_50/' . $exp[1];
    //         } else {
    //             return "http://res.cloudinary.com/dezj1x6xp/image/upload/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
    //         }
    //     } else {
    //         return "http://res.cloudinary.com/dezj1x6xp/image/upload/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
    //     }

    // }

    public function getRectangleCoverImageAttribute()
    {
        $placeholder = "http://res.cloudinary.com/dezj1x6xp/image/upload/c_fill,ar_16:9,q_50/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
        $separator = '/upload/';

        $cover = $this->attributes['cover'] ?? null;

        // 1. Jika null atau kosong
        if (empty($cover)) {
            return $placeholder;
        }

        // 2. Jika cover diawali http (link cloudinary)
        if (stripos($cover, 'http') === 0) {
            $exp = explode($separator, $cover);

            if (count($exp) === 2) {
                return $exp[0] . '/upload/c_fill,ar_16:9,q_50/' . $exp[1];
            }

            // kalau gagal explode, fallback placeholder
            return $placeholder;
        }

        // 3. Jika bukan http, gunakan accessor cover_url
        return $this->cover_url ?? $placeholder;
    }

    // public function getSquareCoverImageAttribute()
    // {
    //     $separator = '/upload/';

    //     if(isset($this->attributes['cover']) && (stripos($this->cover, 'http') === 0)) {
    //         if ($this->attributes['cover']) {

    //             $exp = explode($separator, $this->attributes['cover']);

    //             return $exp[0] . '/upload/c_fill,h_200,w_200,f_avif,q_50/' . $exp[1];
    //         } else {
    //             return "http://res.cloudinary.com/dezj1x6xp/image/upload/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
    //         }
    //         // return $exp[0] . '/upload/c_fill,ar_4:3,q_50/' . $exp[1];
    //     } else {
    //         return "http://res.cloudinary.com/dezj1x6xp/image/upload/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
    //     }


    // }

    public function getSquareCoverImageAttribute()
    {
        $placeholder = "http://res.cloudinary.com/dezj1x6xp/image/upload/c_fill,h_200,w_200,f_avif,q_50/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
        $separator = '/upload/';

        $cover = $this->attributes['cover'] ?? null;

        // 1. Jika null atau kosong
        if (empty($cover)) {
            return $placeholder;
        }

        // 2. Jika cover diawali http (link cloudinary)
        if (stripos($cover, 'http') === 0) {
            $exp = explode($separator, $cover);

            if (count($exp) === 2) {
                return $exp[0] . '/upload/c_fill,h_200,w_200,f_avif,q_50/' . $exp[1];
            }

            // kalau gagal explode, fallback placeholder
            return $placeholder;
        }

        // 3. Jika bukan http, gunakan accessor cover_url
        return $this->cover_url ?? $placeholder;
    }

    // public function getSquareCoverImageHighAttribute()
    // {
    //     $separator = '/upload/';


    //     if(isset($this->attributes['cover']) && (stripos($this->cover, 'http') === 0)) {
    //         if ($this->attributes['cover']) {

    //             $exp = explode($separator, $this->attributes['cover']);

    //             return $exp[0] . '/upload/c_fill,h_200,w_200/' . $exp[1];
    //         } else {
    //             return "http://res.cloudinary.com/dezj1x6xp/image/upload/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
    //         }
    //         // return $exp[0] . '/upload/c_fill,ar_4:3,q_50/' . $exp[1];
    //     } else {
    //         return "http://res.cloudinary.com/dezj1x6xp/image/upload/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
    //     }


    // }

    public function getSquareCoverImageHighAttribute()
    {
        $placeholder = "http://res.cloudinary.com/dezj1x6xp/image/upload/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
        $separator = '/upload/';

        $cover = $this->attributes['cover'] ?? null;

        // 1. Jika null atau kosong
        if (empty($cover)) {
            return $placeholder;
        }

        // 2. Jika cover diawali http (link cloudinary)
        if (stripos($cover, 'http') === 0) {
            $exp = explode($separator, $cover);

            if (count($exp) === 2) {
                return $exp[0] . '/upload/c_fill,h_200,w_200/' . $exp[1];
            }

            // kalau gagal explode, fallback placeholder
            return $placeholder;
        }

        // 3. Jika bukan http, gunakan accessor cover_url
        return $this->cover_url ?? $placeholder;
    }


    public function getTanggalAttribute()
    {
        if(isset($this->attributes['created_at'])) {
            setlocale(LC_TIME, 'id_ID');
            \Carbon\Carbon::setLocale('id');
            $data = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->isoFormat('dddd, D MMMM Y');
            return $data;
        } else {
            return "http://res.cloudinary.com/dezj1x6xp/image/upload/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
        }

    }


     // Accessor: $post->cover_url
    public function getCoverUrlAttribute()
    {
        if (empty($this->cover)) {
            return null;
        }

        // Jika token sudah berupa URL lengkap, langsung kembalikan
        if (stripos($this->cover, 'http') === 0) {
            return $this->cover;
        }

        try {
            $json = Crypt::decryptString($this->cover);
            $payload = json_decode($json, true);

            if (!$payload || !isset($payload['public_id'])) {
                return null;
            }

            $cloudName = config('services.cloudinary.cloud_name', 'dezj1x6xp');

            // Jika version tersedia, masukkan, else tanpa version
            $versionSegment = !empty($payload['version']) ? $payload['version'].'/' : '';
            $ext = !empty($payload['ext']) ? '.'.$payload['ext'] : '';

            return "https://res.cloudinary.com/{$cloudName}/image/upload/{$versionSegment}{$payload['public_id']}{$ext}";
        } catch (\Exception $e) {
            // bila decrypt gagal, kembalikan null
            return null;
        }
    }
}
