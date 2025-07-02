<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $fillable = [
        'tagihan_id',
        'jumlah_bayar',
        'tanggal_bayar',
        'catatan',
    ];
    protected $casts = [
        'tanggal_bayar' => 'date', 
        'jumlah_bayar' => 'integer',
    ];
    public function tagihan(): BelongsTo
    {
        return $this->belongsTo(Tagihan::class);
    }
}