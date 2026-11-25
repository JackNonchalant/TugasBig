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
        if (Schema::hasColumn('users', 'status_akun')) {
            return; // Kolom sudah ada, skip
        }

        Schema::table('users', function (Blueprint $table) {
            $table->enum('status_akun', ['aktif', 'suspended'])
                  ->default('aktif')
                  ->after('role');
            $table->index('status_akun');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['status_akun']);
            $table->dropColumn('status_akun');
        });
    }
};
