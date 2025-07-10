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
        Schema::table('settings', function (Blueprint $table) {
            $table->unsignedSmallInteger('idle_timeout')
                ->after('otp_expiry')
                ->comment('value in seconds');
            $table->decimal('statement_download_fee', 28, 8)
                ->default(0)
                ->after('idle_timeout');
            $table->boolean('auto_logout')
                ->default(true)
                ->after('push_notification');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'idle_timeout',
                'statement_download_fee',
                'auto_logout',
            ]);
        });
    }
};
