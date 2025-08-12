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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('wallet_address');
            $table->decimal('amount', 18, 8); // For crypto precision
            $table->string('currency')->default('USDT');
            $table->string('tx_hash')->unique()->nullable();
            $table->string('status')->default('pending'); // pending, completed, failed
            $table->string('source')->nullable(); // Bank, MPESA, Card, etc.
            $table->text('metadata')->nullable(); // Additional payment data
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
