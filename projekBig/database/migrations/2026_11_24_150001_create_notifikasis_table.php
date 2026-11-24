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
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id('notifikasi_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('judul_notifikasi', 150);
            $table->text('pesan');
            $table->string('status_baca', 20)->default('belum'); // 'belum' | 'sudah'
            $table->timestamp('created_at')->useCurrent();

            $table->index('user_id');
            $table->index('status_baca');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};
