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
        Schema::create('tip_selections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tip_id')->constrained()->onDelete('cascade');
            $table->string('event_name', 255);
            $table->datetime('event_date');
            $table->string('league', 255)->nullable();
            $table->string('prediction', 255);
            $table->decimal('odds', 6, 2);
            $table->enum('result', ['pending', 'won', 'lost', 'void'])->default('pending');
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index('tip_id');
            $table->index('event_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tip_selections');
    }
};

