<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Crypt;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'plain_password',
    ];

    protected $with = ['kabkota'];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getNamePhoneAttribute()
    {
        return $this->attributes['name'] . '_' .  $this->attributes['no_hp'];
    }

    public function kabkota()
    {
        return $this->belongsTo(Kabkota::class, 'id_kabkota');
    }

    protected $appends = ['name_phone'];

    public function getProfilePhotoAttribute($value) 
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
