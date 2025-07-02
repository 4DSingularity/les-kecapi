<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nama_lengkap',
        'nomor_telepon',
        'tanggal_bergabung',
        'status',
    ];

    protected $casts = [
        'tanggal_bergabung' => 'date',
    ];

    /**
     * Relasi: Seorang Siswa dapat mengikuti banyak Pertemuan.
     */
    public function pertemuanYangDiikuti(): BelongsToMany
    {
        return $this->belongsToMany(
            Pertemuan::class,
            'absensi',
            'siswa_id',
            'pertemuan_id'
        );
    }

    /**
     * Relasi: Satu siswa bisa memiliki banyak tagihan.
     */
    public function tagihan(): HasMany
    {
        return $this->hasMany(Tagihan::class);
    }
}
