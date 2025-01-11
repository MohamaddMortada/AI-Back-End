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
        Schema::create('dashboard', function (Blueprint $table) {
            $table->id();
            $table->integer('predictions')->default(0);
            $table->integer('chatbot')->default(0);
            $table->integer('calculating')->default(0);
            $table->integer('photo_finish')->default(0);
            $table->integer('detecting')->default(0);
            $table->integer('added_results')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard');
    }
};
