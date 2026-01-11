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
        Schema::table('tips', function (Blueprint $table) {
            // Channel type: 'vip' for paid subscribers, 'free' for free channel
            $table->string('channel_type', 20)->default('vip')->after('telegram_sent');
            $table->text('analysis')->nullable()->after('channel_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tips', function (Blueprint $table) {
            $table->dropColumn(['channel_type', 'analysis']);
        });
    }
};
