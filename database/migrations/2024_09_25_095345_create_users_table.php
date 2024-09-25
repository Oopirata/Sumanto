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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nama');
            $table->string('email')->unique(); // Unique email
            $table->string('password'); // Password stored as MD5 (use Hash later)
            $table->integer('mahasiswa')->default(0); // 1 or 0 for mahasiswa status
            $table->integer('dosen')->default(0); // 1 or 0 for dosen status
            $table->integer('kaprodi')->default(0); // 1 or 0 for kaprodi status
            $table->integer('dekan')->default(0); // 1 or 0 for dekan status
            $table->integer('akademik')->default(0); // 1 or 0 for akademik status
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
