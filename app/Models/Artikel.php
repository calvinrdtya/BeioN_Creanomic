<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Artikel extends Model
{
    use HasFactory;
    protected $appends = ['time_ago'];

    protected $fillable = [
        'title',
        'thumbnails',
        'deskripsi',
        'kota',
        'tag',
        'status',
    ];

    public function getTimeAgoAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }
    
    public function categoryAdmin()
    {
        return $this->belongsTo(CategoriesAdmin::class, 'category_admin_id');
    }

    // Menonaktifkan incrementing
    public $incrementing = false;

    // Mengatur tipe kunci primary key ke string
    protected $keyType = 'string';

    // Tambahkan boot method untuk mengisi ID acak
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::lower(Str::random(10)); // Menggunakan string acak kecil sebagai ID
            }
        });
    }
}
