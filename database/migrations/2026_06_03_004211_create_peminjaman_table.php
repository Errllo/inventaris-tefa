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
        Schema::create('peminjaman', function (Blueprint $table) {
        $table->id();
        $table->foreignId('peminjam_id')->constrained('peminjam')->onDelete('cascade');
        $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');
        $table->date('tanggal_pinjam');
        $table->date('tanggal_kembali')->nullable();
        $table->integer('jumlah_pinjam');
        $table->string('status_peminjaman')->default('Dipinjam');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
