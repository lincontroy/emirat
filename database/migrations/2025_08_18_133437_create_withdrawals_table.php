<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 16, 8); // For precise decimal storage
            $table->string('status')->default('pending'); // pending, processing, completed, failed
            $table->string('method'); // bank, crypto, mpesa etc
            $table->string('reference')->unique(); // WD-ABC123
            $table->json('details'); // Store method-specific details
            $table->timestamps();
            
            // Indexes for better performance
            $table->index('user_id');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('withdrawals');
    }
};