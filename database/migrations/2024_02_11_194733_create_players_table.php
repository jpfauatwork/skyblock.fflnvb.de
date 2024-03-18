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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('mojang_id')->unique()->nullable();
            $table->string('name');
            $table->json('aliases')->nullable();
            $table->boolean('is_bedrock')->nullable();
            $table->foreignId('alt_from')->nullable()->constrained('players');
            $table->string('state');
            $table->dateTime('joined_at')->nullable();
            $table->datetimes();
            $table->softDeletesDatetime();

            $table->index('mojang_id');
            $table->index('is_bedrock');
            $table->index('state');
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
