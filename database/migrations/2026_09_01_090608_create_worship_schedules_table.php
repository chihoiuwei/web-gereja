<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worship_schedules', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('day');

            $table->time('start_time');

            $table->time('end_time')->nullable();

            $table->text('description')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worship_schedules');
    }
};