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
        Schema::create('tips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->string('title', 255);
            $table->string('sport', 100);
            $table->decimal('total_odds', 8, 2)->default(1.00);
            $table->tinyInteger('stake')->unsigned()->default(5); // 1-10 recommended stake
            $table->enum('status', ['pending', 'won', 'lost', 'void', 'partial'])->default('pending');
            $table->enum('result', ['pending', 'won', 'lost', 'void'])->default('pending');
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->boolean('telegram_sent')->default(false);
            $table->timestamps();

            $table->index('is_published');
            $table->index('status');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tips');
    }
};

