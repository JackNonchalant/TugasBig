<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabel log histori perubahan status distribusi — read-only audit trail.
     */
    public function up(): void
    {
        Schema::create('distribution_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('distribution_id')->constrained('distributions')->cascadeOnDelete();
            $table->string('status_before')->nullable(); // null saat pertama kali dibuat
            $table->string('status_after');
            $table->text('catatan')->nullable();
            $table->string('nomor_resi')->nullable();
            $table->foreignId('changed_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->index('distribution_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribution_status_histories');
    }
};
