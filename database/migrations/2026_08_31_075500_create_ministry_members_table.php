<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ministry_members', function (Blueprint $table) {
            $table->id();

            $table->foreignId('jemaat_id')
                ->constrained('jemaats')
                ->cascadeOnDelete();

            $table->foreignId('ministry_id')
                ->constrained('ministries')
                ->cascadeOnDelete();

            $table->string('position')->nullable();
            $table->text('bio')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ministry_members');
    }
};