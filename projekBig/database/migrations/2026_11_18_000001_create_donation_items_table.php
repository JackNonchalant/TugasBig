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
        Schema::create('donation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nama_barang');
            $table->string('kategori');
            $table->text('deskripsi');
            $table->string('kondisi');
            $table->unsignedInteger('jumlah')->default(1);
            $table->string('foto')->nullable();
            $table->string('status')->default('Menunggu Verifikasi Transit'); // Menunggu Verifikasi Transit, tersedia, diproses, disalurkan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_items');
    }
};
