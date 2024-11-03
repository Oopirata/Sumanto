<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Schema::create('mahasiswa', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('NIM');
        //     $table->string('nama');
        //     $table->string('jurusan');
        //     $table->integer('semester');
        //     $table->string('alamat');
        //     $table->string('email')->unique();
        //     $table->float('ipk');
        //     $table->timestamps();
        // });

        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nim')->unique();
            $table->foreignId('dosen_wali_id')->constrained('dosen', 'nip')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
};
