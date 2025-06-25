<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('nama_lengkap');
            $table->string('nomor_telepon')->nullable(); // Boleh kosong
            $table->date('tanggal_bergabung');
            $table->enum('status', ['aktif', 'tidak aktif'])->default('aktif');
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
