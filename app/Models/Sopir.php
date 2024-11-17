<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sopir extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'foto',
        'ktp',
        'sim',
        'alamat',
        'usia',
        'mitra_id',
        'status',
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }
}
