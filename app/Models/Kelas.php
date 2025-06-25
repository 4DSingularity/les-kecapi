<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    /**
     * Nama tabel database.
     * Wajib jika nama tabel tidak jamak.
     * @var string
     */
    protected $table = 'kelas';

    /**
     * Atribut yang dapat diisi secara massal.
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_kelas',
        'biaya_per_pertemuan',
        'deskripsi',
    ];

    /**
     * Tipe data asli dari atribut.
     * @var array<string, string>
     */
    protected $casts = [
        'biaya_per_pertemuan' => 'integer',
    ];

    /**
     * Relasi: Satu Kelas memiliki banyak Pertemuan.
     */
    public function pertemuan(): HasMany
    {
        return $this->hasMany(Pertemuan::class);
    }
}