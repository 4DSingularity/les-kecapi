<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    // Bisa pakai guarded jika ingin bebas mengisi semua kolom
    protected $guarded = [];

    // Relasi satu kelas memiliki banyak siswa
    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    // Relasi satu kelas memiliki banyak jadwal
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    // Relasi satu kelas memiliki banyak materi
    public function materis()
    {
        return $this->hasMany(Materi::class);
    }
}
