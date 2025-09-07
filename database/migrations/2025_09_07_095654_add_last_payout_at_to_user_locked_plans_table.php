<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('user_locked_plans', function (Blueprint $table) {
            $table->timestamp('last_payout_at')->nullable()->after('updated_at');
        });
    }

    public function down(): void
    {
        Schema::table('user_locked_plans', function (Blueprint $table) {
            $table->dropColumn('last_payout_at');
        });
    }
};
