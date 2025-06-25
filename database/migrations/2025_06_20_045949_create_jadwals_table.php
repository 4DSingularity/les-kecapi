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
       // database/migrations/xxxx_xx_xx_create_jadwals_table.php

        Schema::create('jadwals', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('kelas_id');
        $table->string('hari'); // Senin, Selasa, dll
        $table->string('jam'); // Contoh: 14:00 - 15:30
        $table->timestamps();

        $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
