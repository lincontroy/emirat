<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/[timestamp]_add_kyc_fields_to_users_table.php
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->timestamp('kyc_submitted_at')->nullable()->after('remember_token');
       
     
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['kyc_submitted_at']);
    });
}
};
