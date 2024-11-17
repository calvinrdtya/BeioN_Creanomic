<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HistoryEcotourism extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getImagePathAttribute()
    {
        if ($this->image) {
            return asset('img/' . $this->image);
        }
    }

    public function getQuantityTextAttribute()
    {
        return floatval(number_format($this->qty, 2, '.', '')) . ' KG';
    }

    public function getPointTextAttribute()
    {
        return number_format($this->point, 0, '', '.');
    }

    public function getStatusBadgeAttribute()
    {
        if ($this->status == 1) {
            return '<span class="badge bg-label-success badge-success">Selesai</span>';
        } else if ($this->status == 0) {
            return '<span class="badge bg-label-secondary badge-secondary">Screening</span>';
        } else if ($this->status == 2) {
            return '<span class="badge bg-label-danger badge-danger">Ditolak</span>';
        }
    }

    public function getQrCodeAttribute()
    {
        if ($this->status == 0) {
            return QrCode::size(200)->generate(route('mitra.perlengkapan.dropoff.detail', ['invoice_id' => $this->invoice_id]));
        }

        return null;
    }

    public function scopePointsByUser($query)
    {
        $points = 0;
        $points = $query->where('user_id', auth()->user()->id)
            ->where('status', '1')
            ->sum('point');

        return number_format($points, 0, '', '.');
    }

    public function scopeQuantityByUser($query)
    {
        $qty = 0;
        $qty = $query->where('user_id', auth()->user()->id)
            ->where('status', '1')
            ->sum('qty');

        return floatval(number_format($qty, 2, '.', '')) . ' KG';
    }

    protected static function booted()
    {
        static::creating(function ($historyEcotourism) {
            do {
                $invoiceId = 'ECO-' . strtoupper(Str::random(10));
            } while (self::where('invoice_id', $invoiceId)->exists());
            $historyEcotourism->invoice_id = $invoiceId;
        });
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($history) {
            if ($history->isDirty('status')) {
                $originalStatus = $history->getOriginal('status');
                $newStatus = $history->status;

                $user = User::find($history->user_id);

                if ($newStatus == 1 && $originalStatus != 1) {
                    $user->points += $history->point;
                } elseif ($newStatus != 1 && $originalStatus == 1) {
                    $user->points -= $history->point;
                }

                $user->save();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }
}
