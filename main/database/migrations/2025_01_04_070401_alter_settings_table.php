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
            $table->boolean('deposit')->default(true)->after('percentage_charge');
            $table->boolean('withdraw')->default(true)->after('deposit');
            $table->boolean('dps')->default(true)->after('withdraw');
            $table->boolean('fds')->default(true)->after('dps');
            $table->boolean('loan')->default(true)->after('fds');
            $table->boolean('internal_bank_transfer')->default(true)->after('loan');
            $table->boolean('external_bank_transfer')->default(true)->after('internal_bank_transfer');
            $table->boolean('wire_transfer')->default(true)->after('external_bank_transfer');
            $table->boolean('sms_based_otp')->default(true)->after('wire_transfer');
            $table->boolean('email_based_otp')->default(true)->after('sms_based_otp');
            $table->boolean('push_notification')->default(true)->after('email_based_otp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'deposit',
                'withdraw',
                'dps',
                'fds',
                'loan',
                'internal_bank_transfer',
                'external_bank_transfer',
                'wire_transfer',
                'sms_based_otp',
                'email_based_otp',
                'push_notification',
            ]);
        });
    }
};
