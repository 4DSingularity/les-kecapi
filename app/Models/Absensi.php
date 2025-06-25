<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Absensi extends Pivot
{
    use HasFactory;

    /**
     * Nama tabel database.
     * @var string
     */
    protected $table = 'absensi';
}