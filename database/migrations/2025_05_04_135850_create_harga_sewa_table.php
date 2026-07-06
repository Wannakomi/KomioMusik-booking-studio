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
        Schema::create('harga_sewas', function (Blueprint $table) {
            $table->id();
            $table->integer('harga');
            $table->enum('tipe', ['Latihan', 'Rekaman', 'Podcast'])->default('Latihan'); // << tambahan
            $table->unsignedBigInteger('ruangan_id')->nullable(); // << optional
            $table->foreign('ruangan_id')->references('id')->on('ruangan')->onDelete('set null');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {   
        Schema::dropIfExists('harga_sewas');
    }
};
