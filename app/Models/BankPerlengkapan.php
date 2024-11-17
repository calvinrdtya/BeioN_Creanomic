<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankPerlengkapan extends Model
{
    use HasFactory;
    
    protected $table = 'bank_perlengkapans';

    protected $fillable = [
        'mitra_id',
        'bank',
        'no_rekening',
        'nama_pemilik',
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }
}
