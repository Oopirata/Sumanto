<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('khs', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('kode_mk');
            $table->integer('semester');
            $table->string('nilai');
            $table->timestamps();

            // Add foreign key constraints if needed
            $table->foreign('nim')->references('nim')->on('mahasiswa');
            $table->foreign('kode_mk')->references('kode_mk')->on('matakuliah')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('khs');
    }
};
