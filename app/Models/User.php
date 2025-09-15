<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


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

    protected $appends = ['age', 'name_phone'];

    public function getAgeAttribute()
    {

        if (substr($this->attributes['username'], 0, 4) != 'adm.') {
            $rawBD = strlen($this->attributes['username']) == 18 ? substr($this->attributes['username'], 0, 8) : null;
            if ($rawBD) {
                $birthDate = substr($rawBD, 0, 4) . '-' . substr($rawBD, 4, 2) . '-' . substr($rawBD, 6, 2) . ' 00:00:00';
                $interval = date_diff(date_create(), date_create($birthDate));
                return $interval->format("%Y Tahun, %M Bulan, %d Hari");
            }
            return 'undetected';
        } else {
            return 'undetected';
        }
    }
}
