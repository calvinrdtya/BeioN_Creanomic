<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencairanPerlengkapan extends Model
{
    use HasFactory;

    protected $fillable = [
        'uniq_perlengkapan',
        'user_id',
        'mitra_id',
        'invoice_number',
        'perlengkapan_id',
        'subtotal',
        'coupon_code',
        'discount',
        'grand_total',
        'payment_status',
        'pencairan_status',
        'status_booking',
        'order_type',
        'image_bukti',
        'deskripsi',
        'title',
        'first_name',
        'last_name',
        'no_handphone',
        'email',
        'alamat_lengkap',
        'tgl_pinjam',
        'tgl_pengembalian',
        'durasi_pinjam',
        'snap_token',
        'note',
        'address',
    ];

    public function perlengkapan()
    {
        return $this->belongsTo(Motor::class, 'perlengkapan_id');
    }
}
