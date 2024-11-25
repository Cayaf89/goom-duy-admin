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

        Schema::create('weapons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        Schema::create('weapons_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('weapon_id')->constrained();
            $table->foreignId('statistic_id')->constrained();
        });

        Schema::create('weapons_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('weapon_id')->constrained();
            $table->foreignId('attribute_id')->constrained();
        });

        Schema::create('weapons_effects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('weapon_id')->constrained();
            $table->foreignId('effect_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weapons');
        Schema::dropIfExists('weapons_statistics');
        Schema::dropIfExists('weapons_attributes');
        Schema::dropIfExists('weapons_effects');
    }
};
