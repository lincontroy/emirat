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
        Schema::create('user_locked_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('plan_id')->constrained('investment_plans');
            $table->decimal('amount', 18, 8);
            $table->decimal('expected_yield', 18, 8);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('status')->default('active'); // active, completed, early_withdrawn
            $table->string('tx_hash')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_locked_plans');
    }
};
