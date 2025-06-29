<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Siswa extends Model
{
    use HasFactory;

    /**
     * Nama tabel database.
     * @var string
     */
    protected $table = 'siswa';

    /**
     * Atribut yang dapat diisi secara massal.
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'nomor_telepon',
        'tanggal_bergabung',
        'status',
    ];

    /**
     * Tipe data asli dari atribut.
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_bergabung' => 'date',
    ];

    /**
     * Relasi: Seorang Siswa dapat mengikuti banyak Pertemuan.
     * (melalui tabel pivot 'absensi')
     */
    public function pertemuanYangDiikuti(): BelongsToMany
    {
        return $this->belongsToMany(Pertemuan::class, 'absensi');
    }
}