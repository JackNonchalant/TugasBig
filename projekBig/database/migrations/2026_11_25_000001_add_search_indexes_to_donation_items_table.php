<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambahkan index pada donation_items untuk optimasi query katalog & pencarian (PBI-008).
     */
    public function up(): void
    {
        Schema::table('donation_items', function (Blueprint $table) {
            $table->index(['status', 'jumlah', 'created_at'], 'donation_items_active_latest_idx');
            $table->index('nama_barang', 'donation_items_nama_barang_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donation_items', function (Blueprint $table) {
            $table->dropIndex('donation_items_active_latest_idx');
            $table->dropIndex('donation_items_nama_barang_idx');
        });
    }
};
