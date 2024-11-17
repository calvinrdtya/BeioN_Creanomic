<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $fillable = [
        'mitra_id',
        'title',
        'jenis',
        'deskripsi',
        'alamat',
        'qty',
        'category_id',
        'price',
        'final_price',
        'price_discount',
        'image',
        'bbm',
        'layanan',
        'kota',
        'status',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderMobils()
    {
        return $this->hasMany(OrderMobil::class, 'mobil_id');
    }
}
