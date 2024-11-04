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
        Schema::create('dosen_matakuliah', function (Blueprint $table) {
            $table->id();
            $table->string('dosen_nip'); // Hanya gunakan `string` untuk dosen_nip
            $table->string('kode_mk'); // Hanya gunakan `string` untuk kode_mk
            $table->timestamps();

            // Tentukan foreign key secara manual
            $table->foreign('dosen_nip')->references('nip')->on('dosen')->onDelete('cascade');
            $table->foreign('kode_mk')->references('kode_mk')->on('matakuliah')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen_matakuliah');
    }
};