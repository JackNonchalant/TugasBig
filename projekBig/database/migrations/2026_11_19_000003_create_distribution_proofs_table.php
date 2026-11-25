<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabel bukti foto serah terima barang donasi.
     */
    public function up(): void
    {
        Schema::create('distribution_proofs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('distribution_id')->constrained('distributions')->cascadeOnDelete();
            $table->string('foto_path'); // path relatif di storage
            $table->string('original_name')->nullable(); // nama file asli
            $table->foreignId('uploaded_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->index('distribution_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribution_proofs');
    }
};
