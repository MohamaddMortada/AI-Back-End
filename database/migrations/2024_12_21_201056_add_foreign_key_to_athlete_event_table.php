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
        Schema::table('athlete_event', function (Blueprint $table) {
            $table->unsignedBigInteger('compitition_id'); 
            $table->foreign('compitition_id')
                  ->references('id') 
                  ->on('compititions')
                  ->onDelete('cascade') 
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('athlete_event', function (Blueprint $table) {
            $table->dropForeign(['competition_id']); 
            $table->dropColumn('competition_id');
        });
    }
};
