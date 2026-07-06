<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
    Schema::create('fasilitas_ruangan', function (Blueprint $table) {
        $table->id();
        
        // Buat kolom dulu
        $table->unsignedBigInteger('ruangan_id');
        $table->unsignedBigInteger('fasilitas_id');

        // Baru tambahkan foreign key-nya
        $table->foreign('ruangan_id')->references('id')->on('ruangan')->onDelete('cascade');
        $table->foreign('fasilitas_id')->references('id')->on('fasilitas')->onDelete('cascade');

        $table->timestamps();
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas_ruangan');
    }
};
