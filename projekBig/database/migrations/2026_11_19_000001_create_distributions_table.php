<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabel penyaluran barang donasi — mencatat setiap transaksi distribusi
     * dari barang yang tersedia kepada penerima manfaat.
     */
    public function up(): void
    {
        Schema::create('distributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_item_id')->constrained('donation_items')->cascadeOnDelete();
            $table->foreignId('beneficiary_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('Menunggu Penyaluran');
            // Status values: 'Menunggu Penyaluran', 'Dalam Proses Penyaluran', 'Disalurkan'
            $table->text('catatan')->nullable();
            $table->string('nomor_resi')->nullable();
            $table->foreignId('processed_by')->constrained('users')->cascadeOnDelete();
            $table->timestamp('distributed_at')->nullable(); // Waktu serah terima
            $table->timestamps();

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distributions');
    }
};
