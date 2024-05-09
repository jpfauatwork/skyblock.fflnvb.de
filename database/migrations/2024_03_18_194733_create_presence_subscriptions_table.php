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
        Schema::create('presence_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('telegram_id');
            $table->foreignId('player_id')->constrained('players');
            $table->foreignId('presence_id')->nullable()->constrained('presences');
            $table->datetimes();
            $table->softDeletesDateTime();

            $table->index('user_id');
            $table->index('player_id');

            $table->unique(['user_id', 'player_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presence_subscriptions');
    }
};