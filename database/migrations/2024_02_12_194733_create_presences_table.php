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
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->nullable();
            $table->string('name');
            $table->dateTime('joined_at');
            $table->dateTime('left_at')->nullable();
            $table->datetimes();
            $table->softDeletesDatetime();

            $table->index('joined_at');
            $table->index('left_at');
            $table->index('player_id');
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
