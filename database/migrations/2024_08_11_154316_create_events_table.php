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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_group_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->dateTime('occured_at');

            $table->datetimes();
            $table->softDeletesDatetime();

            $table->index('event_group_id');
            $table->index('occured_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
