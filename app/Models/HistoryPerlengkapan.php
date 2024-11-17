<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPerlengkapan extends Model
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
        'status_pinjam',
        'order_type',
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
        'catatan',
        'alamat',
    ];

    public function perlengkapan()
    {
        return $this->belongsTo(Perlengkapan::class, 'perlengkapan_id', 'id');
    }
}
