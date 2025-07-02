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
        // UBAH DARI 'pertemuans' MENJADI 'pertemuan'
        Schema::create('pertemuan', function (Blueprint $table) {
            $table->id();
            // Pastikan tabel 'kelas' juga tunggal jika Anda konsisten
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->date('tanggal_pertemuan');
            $table->string('topik_hari_ini')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // UBAH JUGA DI SINI
        Schema::dropIfExists('pertemuan');
    }
};