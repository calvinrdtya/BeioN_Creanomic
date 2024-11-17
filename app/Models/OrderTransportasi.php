<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTransportasi extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'invoice_number',
        'transportasi_id',
        'sopir_id',
        'subtotal',
        'coupon_code',
        'discount',
        'grand_total',
        'payment_status',
        'status',
        'email',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sopir()
    {
        return $this->belongsTo(Sopir::class);
    }


    public function transportasi()
    {
        return $this->belongsTo(Transportasi::class);
    }
}
