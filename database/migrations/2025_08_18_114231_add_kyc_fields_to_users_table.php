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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('id_front_path')->nullable()->after('email_verified_at');
            $table->string('id_back_path')->nullable()->after('id_front_path');
            $table->string('selfie_path')->nullable()->after('id_back_path');
            $table->enum('kyc_status', ['pending', 'approved', 'rejected'])->default('pending')->after('selfie_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn(['id_front_path', 'id_back_path', 'selfie_path', 'kyc_status']);
        });
    }
};
