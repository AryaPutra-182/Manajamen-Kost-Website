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
        Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained(); // Penyewa
        $table->foreignId('kost_id')->constrained();
        $table->date('tanggal_mulai');
        $table->integer('durasi_bulan');
        $table->bigInteger('total_harga');
        $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
