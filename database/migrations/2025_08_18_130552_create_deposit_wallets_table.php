<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('deposit_wallets', function (Blueprint $table) {
            $table->id();
            $table->string('wallet_address')->unique();
            $table->string('network')->default('TRC20');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deposit_wallets');
    }
};