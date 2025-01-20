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
        Schema::table('electric_time', function (Blueprint $table) {
            $table->timestamp('start_time', 6)->nullable()->change();
            $table->timestamp('stop_time', 6)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('electric_time', function (Blueprint $table) {
            $table->timestamp('start_time')->nullable()->change();
            $table->timestamp('stop_time')->nullable()->change();
        });
    }
};
