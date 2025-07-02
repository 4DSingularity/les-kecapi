<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pertemuan extends Model
{
    use HasFactory;

    /**
     * Nama tabel database.
     * @var string
     */
    protected $table = 'pertemuan';

    /**
     * Atribut yang dapat diisi secara massal.
     * @var array<int, string>
     */
    protected $fillable = [
        'kelas_id',
        'tanggal_pertemuan',
        'topik_hari_ini',
    ];

    /**
     * Tipe data asli dari atribut.
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_pertemuan' => 'date',
    ];

    /**
     * Relasi: Sebuah Pertemuan 'milik' satu Kelas.
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    /**
     * Relasi: Sebuah Pertemuan dihadiri oleh banyak Siswa.
     * (melalui tabel pivot 'absensi')
     */
    public function siswaYangHadir(): BelongsToMany
    {
        return $this->belongsToMany(
        Siswa::class,       // Model yang dihubungkan
        'absensi',          // Nama tabel pivot
        'pertemuan_id',     // Foreign key di pivot untuk model ini
        'siswa_id'         // Foreign key di pivot untuk model yang dihubungkan
        );
    }
    
}