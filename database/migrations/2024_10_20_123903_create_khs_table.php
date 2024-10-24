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
        Schema::create('khs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk');
            $table->string('nama_mk');
            $table->integer('sks_mk');
            $table->char('nilai');
            $table->integer('semester');
            $table->integer('jumlah_sks');
            $table->float('ipk');
            $table->float('ips');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('khs');
    }
};
