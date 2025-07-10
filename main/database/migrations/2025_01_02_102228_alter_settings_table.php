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
            $table->decimal('per_transaction_min_amount', 28, 8)
                ->default(0)
                ->after('open_account');
            $table->decimal('per_transaction_max_amount', 28, 8)
                ->default(0)
                ->after('per_transaction_min_amount');
            $table->decimal('daily_transaction_max_amount', 28, 8)
                ->default(0)
                ->after('per_transaction_max_amount');
            $table->decimal('monthly_transaction_max_amount', 28, 8)
                ->default(0)
                ->after('daily_transaction_max_amount');
            $table->decimal('fixed_charge', 28, 8)
                ->default(0)
                ->after('monthly_transaction_max_amount');
            $table->decimal('percentage_charge', 5, 2)
                ->default(0)
                ->after('fixed_charge');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'per_transaction_min_amount',
                'per_transaction_max_amount',
                'daily_transaction_max_amount',
                'monthly_transaction_max_amount',
                'fixed_charge',
                'percentage_charge',
            ]);
        });
    }
};
