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
        Schema::create('investment_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 7-day, 30-day, etc.
            $table->string('slug')->unique();
            $table->decimal('min_amount', 18, 8);
            $table->decimal('yield_percentage', 5, 2);
            $table->decimal('penalty_percentage', 5, 2);
            $table->decimal('apy', 5, 2);
            $table->integer('duration_days');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_plans');
    }
};
