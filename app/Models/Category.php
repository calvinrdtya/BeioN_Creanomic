<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'status','showHome'];
    use HasFactory;

    public function sub_category(){
        return $this->hasMany(SubCategory::class);
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id');
    }

    public function perlengkapans()
    {
        return $this->hasMany(Perlengkapan::class);
    }
}