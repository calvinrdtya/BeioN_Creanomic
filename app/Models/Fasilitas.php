<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'homestay_id', 
        'title', 
        'deskripsi',
        'mitra_id'
    ];

    public function homestay()
    {
        return $this->belongsTo(Homestay::class, 'homestay_id');
    }
    
    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }
}
