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
    // database/migrations/xxxx_xx_xx_create_siswas_table.php

        Schema::create('siswas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id')->unique(); // user yang login sebagai siswa
        $table->unsignedBigInteger('kelas_id');
        $table->string('no_hp')->nullable();
        $table->text('alamat')->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
