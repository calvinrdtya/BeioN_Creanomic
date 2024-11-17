<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPerlengkapan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
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
        'order_type',
        'title',
        'first_name',
        'last_name',
        'email',
        'alamat_lengkap',
        'no_handphone',
        'tgl_pinjam',
        'tgl_pengembalian',
        'durasi_pinjam',
        'note',
        'address',
        'province_id',
        'city_id',
        'district_id',
        'village_id',
        'snap_token',
    ];

    public function getSubtotalAttribute($value)
    {
        return floatval($value);
    }

    public function getSubtotalTextAttribute()
    {
        return 'Rp ' . number_format($this->subtotal, 2, ',', '.');
    }

    public function getGrandTotalAttribute($value)
    {
        return floatval($value);
    }

    public function getGrandTotalTextAttribute()
    {
        return 'Rp ' . number_format($this->grand_total, 2, ',', '.');
    }

    public function getRemainingTimeAttribute()
    {
        if ($this->payment_status == 1) {
            $createdAt = Carbon::parse($this->created_at);
            $deadline = $createdAt->addMinutes(30);

            $now = Carbon::now();
            $remainingSeconds = $now->diffInSeconds($deadline, false);

            if ($remainingSeconds > 0) {
                return $remainingSeconds;
            }
        }

        return 0;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function perlengkapan()
    {
        return $this->belongsTo(Perlengkapan::class);
    }
}
