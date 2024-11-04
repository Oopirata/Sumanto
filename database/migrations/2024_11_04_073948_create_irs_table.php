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
        Schema::create('irs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mhs_id');
            $table->unsignedBigInteger('jadwal_id');
            $table->string('semester');
            $table->integer('total_sks');
            $table->string('status');
            $table->float('ips', 2)->nullable;

            //fk
            $table->foreign('mhs_id')->references('id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('jadwal_id')->references('id')->on('jadwal')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irs');
    }
};