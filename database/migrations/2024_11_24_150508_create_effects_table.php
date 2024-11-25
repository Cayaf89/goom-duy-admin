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
        Schema::create('effects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('short_name')->nullable();
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        Schema::create('effects_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('effect_id')->constrained();
            $table->foreignId('statistic_id')->constrained();
        });

        Schema::create('effects_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('effect_id')->constrained();
            $table->foreignId('attribute_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('effects');
        Schema::dropIfExists('effects_statistics');
        Schema::dropIfExists('effects_attributes');
    }
};
