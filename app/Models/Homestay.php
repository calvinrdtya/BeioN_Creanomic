<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homestay extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'uniq_id', 
        'title', 
        'slug', 
        'higlight', 
        'deskripsi', 
        'alamat', 
        'qty', 
        'shipping_return', 
        'price', 
        'final_price', 
        'price_discount', 
        'thumbnail', 
        'image', 
        'image2', 
        'image3', 
        'image4', 
        'mitra_id', 
        'rating'
    ];
    
    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class, 'homestay_id');
    }
}