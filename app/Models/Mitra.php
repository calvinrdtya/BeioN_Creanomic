<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Mitra extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name', 'owner', 'pic', 'email', 'phone', 'kota' ,'alamat', 'jabatan', 'identitas', 'legal',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'identitas' => 'array',
        'legal' => 'array',
    ];

    public function getLogoPathAttribute()
    {
        if ($this->logo) {
            return asset('img/' . $this->logo);
        }

        return null;
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'mitra_id');
    }

    public function motors()
    {
        return $this->hasMany(Motor::class);
    }

    public function perlengkapans()
    {
        return $this->hasMany(Perlengkapan::class);
    }

    public function historyEcotourism()
    {
        return $this->hasMany(HistoryPerlengkapan::class);
    }
}
