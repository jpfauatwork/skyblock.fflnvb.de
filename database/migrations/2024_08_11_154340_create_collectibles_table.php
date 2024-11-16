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
        Schema::create('collectibles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->nullable();
            $table->string('type');
            $table->string('name');
            $table->string('lore')->nullable();
            $table->string('creator')->nullable();
            $table->integer('amount')->nullable();

            $table->dateTime('collected_at')->nullable();

            $table->datetimes();
            $table->softDeletesDatetime();

            $table->index('event_id');
            $table->index('type');
            $table->index('name');
            $table->index('collected_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collectibles');
    }
};
