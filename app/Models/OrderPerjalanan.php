<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class OrderPerjalanan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'uniq_perjalanan',
        'user_id',
        'mitra_id',
        'invoice_number',
        'perjalanan_id',
        'subtotal',
        'coupon_code',
        'discount',
        'grand_total',
        'payment_status',
        'order_type',
        'title',
        'first_name',
        'last_name',
        'no_handphone',
        'email',
        'alamat_lengkap',
        'address',
        'meeting_points',
        'province_id',
        'city_id',
        'district_id',
        'village_id',
        'snap_token',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function perjalanan()
    {
        return $this->belongsTo(Perjalanan::class, 'perjalanan_id', 'id');
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         if (empty($model->id)) {
    //             $model->id = 'perjalanan-' . Str::lower(Str::random(10)); // Generate random string
    //         }
    //     });
    // }
}
