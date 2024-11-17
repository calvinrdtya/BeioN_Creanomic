<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMotor extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'uniq_motor',
        'user_id',
        'mitra_id',
        'motor_id', // Tambahkan 'motor_id' ke dalam $fillable
        'invoice_number',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

    public function motor()
    {
        return $this->belongsTo(Motor::class, 'motor_id', 'id');
    }
}