<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'deskripsi', 'jenis', 'alamat', 'qty', 'status', 'price', 'final_price', 'price_discount', 'image', 'mitra_id', 'category_id'];

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
}
