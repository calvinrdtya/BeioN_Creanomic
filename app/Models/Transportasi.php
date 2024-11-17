<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'deskripsi', 'jenis', 'alamat', 'qty', 'status', 'price', 'final_price', 'price_discount', 'image', 'mitra_id', 'category_id', 'bbm', 'layanan'];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

