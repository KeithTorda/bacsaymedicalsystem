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
        if (!Schema::hasColumn('notifications', 'target_role')) {
            Schema::table('notifications', function (Blueprint $table) {
                $table->string('target_role')->default('all')->after('user_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('notifications', 'target_role')) {
            Schema::table('notifications', function (Blueprint $table) {
                $table->dropColumn('target_role');
            });
        }
    }
};
