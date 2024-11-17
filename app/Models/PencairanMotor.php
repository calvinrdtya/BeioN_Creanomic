<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencairanMotor extends Model
{
    use HasFactory;

    protected $fillable = [
        'uniq_motor',
        'user_id',
        'invoice_number',
        'motor_id',
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
        'tgl_booking',
        'tgl_selesai',
        'durasi_booking',
        'snap_token',
        'note',
        'address',
    ];

    public function motor()
    {
        return $this->belongsTo(Motor::class, 'motor_id');
    }
}
