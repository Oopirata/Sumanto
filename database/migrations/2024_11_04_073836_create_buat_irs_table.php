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
        Schema::create('buat_irs', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('mhs_id')->constrained('mahasiswa')->onDelete('cascade');
            $table->string('kode_mk');
            $table->string('nama_mk');
            $table->integer('sks');
            $table->string('semester');
            $table->string('kelas');
            $table->string('ruang');
            $table->string('sifat');
            $table->string('nama_dosen');
            $table->string('time_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buat_irs', function (Blueprint $table) {
            $table->dropForeign(['mhs_id']);
            $table->dropColumn('mhs_id');
        });
    }
};
