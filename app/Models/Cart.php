<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mitra_id',
        'product_id',
        'qty',
    ];

    // Definisikan relasi jika diperlukan
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Definisikan relasi ke produk jika diperlukan
    public function perjalanan()
    {
        return $this->belongsTo(Perjalanan::class, 'product_id', 'id');
    }

    // Definisikan relasi ke mitra jika diperlukan
    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }
}
