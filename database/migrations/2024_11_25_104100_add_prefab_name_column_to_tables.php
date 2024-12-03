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
        Schema::table('classes', function (Blueprint $table) {
            $table->string('prefab_name')->nullable();
        });
        Schema::table('weapons', function (Blueprint $table) {
            $table->string('prefab_name')->nullable();
        });
        Schema::table('effects', function (Blueprint $table) {
            $table->string('prefab_name')->nullable();
        });
        Schema::table('attributes', function (Blueprint $table) {
            $table->string('prefab_name')->nullable();
        });
        Schema::table('statistics', function (Blueprint $table) {
            $table->string('prefab_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropColumn('prefab_name');
        });
        Schema::table('weapons', function (Blueprint $table) {
            $table->dropColumn('prefab_name');
        });
        Schema::table('effects', function (Blueprint $table) {
            $table->dropColumn('prefab_name');
        });
        Schema::table('attributes', function (Blueprint $table) {
            $table->dropColumn('prefab_name');
        });
        Schema::table('statistics', function (Blueprint $table) {
            $table->dropColumn('prefab_name');
        });
    }
};
