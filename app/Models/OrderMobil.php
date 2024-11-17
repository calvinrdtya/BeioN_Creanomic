<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMobil extends Model
{
    use HasFactory;

    protected $fillable = [
        'uniq_mobil',
        'user_id',
        'mitra_id',
        'invoice_number',
        'mobil_id',
        'subtotal',
        'coupon_code',
        'discount',
        'grand_total',
        'payment_status',
        'order_type',
        'title',
        'first_name',
        'last_name',
        'email',
        'no_handphone',
        'alamat_lengkap',
        'tgl_pinjam',
        'tgl_pengembalian',
        'durasi_pinjam',
        'fasilitas',
        'note',
        'address',
        'snap_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }
}
