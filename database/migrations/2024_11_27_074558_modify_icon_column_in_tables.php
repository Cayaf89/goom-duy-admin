<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('statistics', function (Blueprint $table) {
            $table->foreignId('icon_id')->nullable();
            $table->dropColumn('icon');
        });
        Schema::table('attributes', function (Blueprint $table) {
            $table->foreignId('icon_id')->nullable();
            $table->dropColumn('icon');
        });
        Schema::table('effects', function (Blueprint $table) {
            $table->foreignId('icon_id')->nullable();
            $table->dropColumn('icon');
        });
        Schema::table('weapons', function (Blueprint $table) {
            $table->foreignId('icon_id')->nullable();
            $table->dropColumn('icon');
        });
        Schema::table('classes', function (Blueprint $table) {
            $table->foreignId('icon_id')->nullable();
            $table->dropColumn('icon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('statistics', function (Blueprint $table) {
            $table->string('icon')->nullable()->change();
            $table->dropColumn('icon_id');
        });
        Schema::table('attributes', function (Blueprint $table) {
            $table->string('icon')->nullable()->change();
            $table->dropColumn('icon_id');
        });
        Schema::table('effects', function (Blueprint $table) {
            $table->string('icon')->nullable()->change();
            $table->dropColumn('icon_id');
        });
        Schema::table('weapons', function (Blueprint $table) {
            $table->string('icon')->nullable()->change();
            $table->dropColumn('icon_id');
        });
        Schema::table('classes', function (Blueprint $table) {
            $table->string('icon')->nullable()->change();
            $table->dropColumn('icon_id');
        });
    }
};
