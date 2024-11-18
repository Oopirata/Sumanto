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
            //fk
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('nim')->unique();
            $table->string('semester');
            $table->string('prodi');
            $table->float('IPK', 2)->nullable();
            $table->float('IPS', 2)->nullable();
            $table->unsignedBigInteger('dosen_wali_id');

            $table->foreign('dosen_wali_id')->references('id')->on('dosen')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
};
