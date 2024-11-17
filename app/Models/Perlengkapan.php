<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perlengkapan extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'title',
        'qty',
        'kota',
        'deskripsi',
        'status',
        'price',
        'final_price',
        'price_discount',
        'image',
        'mitra_id',
        'category_id'
    ];

    public function getImagePathAttribute()
    {
        if ($this->image) {
            return asset('img/' . $this->image);
        }

        return null;
    }

    public function getPriceAttribute($value)
    {
        return floatval($value);
    }

    public function getPriceTextAttribute()
    {
        return 'Rp ' . number_format($this->price, 2, ',', '.');
    }

    public function getFinalPriceAttribute($value)
    {
        return floatval($value);
    }

    public function getFinalPriceTextAttribute()
    {
        return 'Rp ' . number_format($this->final_price, 2, ',', '.');
    }

    public function getPriceDiscountTextAttribute()
    {
        return $this->price_discount . '%';
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->hasMany(OrderPerlengkapan::class);
    }
}
