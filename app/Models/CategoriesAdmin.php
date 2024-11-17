<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesAdmin extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'role',
    ];

    public function artikels()
    {
        return $this->hasMany(Artikel::class, 'category_admin_id');
    }
}
