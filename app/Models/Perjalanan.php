<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perjalanan extends Model
{
    protected $fillable = ['title', 'durasi', 'deskripsi', 'titik', 'tgl_penjemputan', 'qty', 'status', 'price', 'shipping_return', 'final_price', 'price_discount', 'thumbnail', 'image', 'itinerary', 'include', 'exclude', 'fasilitas', 'mitra_id', 'category_id'];
    use HasFactory;

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    // public function perlengkapans()
    // {
    //     return $this->hasMany(Perlengkapan::class);
    // }
}
