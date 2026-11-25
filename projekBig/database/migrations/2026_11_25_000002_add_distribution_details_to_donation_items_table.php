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
        Schema::table('donation_items', function (Blueprint $table) {
            $table->string('recipient_name')->nullable()->after('status');
            $table->string('recipient_contact')->nullable()->after('recipient_name');
            $table->text('recipient_address')->nullable()->after('recipient_contact');
            $table->timestamp('received_at')->nullable()->after('recipient_address');
            $table->string('receipt_photo')->nullable()->after('received_at');
            $table->string('receipt_document')->nullable()->after('receipt_photo');
            $table->text('distribution_notes')->nullable()->after('receipt_document');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donation_items', function (Blueprint $table) {
            $table->dropColumn([
                'recipient_name',
                'recipient_contact',
                'recipient_address',
                'received_at',
                'receipt_photo',
                'receipt_document',
                'distribution_notes',
            ]);
        });
    }
};
