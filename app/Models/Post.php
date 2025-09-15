<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $with = ['category', 'user', 'tags'];

    protected $appends = ['tanggal', 'view_count', 'cover_small', 'rectangle_cover_image', 'square_cover_image', 'square_cover_image_high'];

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

    public function getCoverSmallAttribute()
    {

        if(isset($this->attributes['cover'])) {


            if ($this->attributes['cover']) {
                $separator = '/upload/';
                $exp = explode($separator, $this->attributes['cover']);

                return $exp[0] . '/upload/c_fill,ar_16:9,q_5,f_avif/' . $exp[1];
            } else {
                return "http://res.cloudinary.com/dezj1x6xp/image/upload/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
            }

        } else {
            return '';
        }
    }

    public function getRectangleCoverImageAttribute()
    {
        $separator = '/upload/';
        if(isset($this->attributes['cover'])) {
            if ($this->attributes['cover']) {
                $exp = explode($separator, $this->attributes['cover']);


                return $exp[0] . '/upload/c_fill,ar_16:9,q_50/' . $exp[1];
            } else {
                return "http://res.cloudinary.com/dezj1x6xp/image/upload/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
            }
        } else {
            return '';
        }

    }

    public function getSquareCoverImageAttribute()
    {
        $separator = '/upload/';

        if(isset($this->attributes['cover'])) {
            if ($this->attributes['cover']) {

                $exp = explode($separator, $this->attributes['cover']);

                return $exp[0] . '/upload/c_fill,h_200,w_200,f_avif,q_50/' . $exp[1];
            } else {
                return "http://res.cloudinary.com/dezj1x6xp/image/upload/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
            }
            // return $exp[0] . '/upload/c_fill,ar_4:3,q_50/' . $exp[1];
        } else {
            return '';
        }


    }

    public function getSquareCoverImageHighAttribute()
    {
        $separator = '/upload/';


        if(isset($this->attributes['cover'])) {
            if ($this->attributes['cover']) {

                $exp = explode($separator, $this->attributes['cover']);

                return $exp[0] . '/upload/c_fill,h_200,w_200/' . $exp[1];
            } else {
                return "http://res.cloudinary.com/dezj1x6xp/image/upload/v1698216019/PandanViewMandeh/video-placeholder_kfnvxm.jpg";
            }
            // return $exp[0] . '/upload/c_fill,ar_4:3,q_50/' . $exp[1];
        } else {
            return '';
        }


    }


    public function getTanggalAttribute()
    {
        if(isset($this->attributes['created_at'])) {
            setlocale(LC_TIME, 'id_ID');
            \Carbon\Carbon::setLocale('id');
            $data = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->isoFormat('dddd, D MMMM Y');
            return $data;
        } else {
            return '';
        }

    }
}
