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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->foreignId('context_player_id')->nullable();
            $table->string('context_player_name')->nullable();
            $table->string('via_telegram')->nullable();
            $table->datetimes();
            $table->softDeletesDateTime();

            $table->index('event_name');
            $table->index('context_player_id');
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
