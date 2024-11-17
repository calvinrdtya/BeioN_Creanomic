<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHomestay extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'uniq_homestay',
        'user_id',
        'invoice_number',
        'homestay_id',
        'subtotal',
        'coupon_code',
        'discount',
        'grand_total',
        'payment_status',
        'status_booking',
        'order_type',
        'title',
        'first_name',
        'last_name',
        'no_handphone',
        'email',
        'alamat_lengkap',
        'tgl_booking',
        'tgl_selesai',
        'durasi_booking',
        'snap_token',
        'note',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function homestay()
    {
        return $this->belongsTo(Homestay::class, 'homestay_id');
    }
}
