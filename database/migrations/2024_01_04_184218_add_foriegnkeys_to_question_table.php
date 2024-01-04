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
        Schema::table('question', function (Blueprint $table) {
            $table->foreign('referenceid')->references('R_id')->on('reference');
            $table->foreign('correct_answer')->references('A_id')->on('answer');
            $table->foreign('pastpaper_reference')->references('P_id')->on('pastpaper');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('question', function (Blueprint $table) {
            $table->dropForeign(['referenceid']);
            $table->dropForeign(['correct_answer']);
            $table->dropForeign(['pastpaper_reference']);
            $table->dropColumn('referenceid');
            $table->dropColumn('correct_answer');
            $table->dropColumn('pastpaper_reference');
            
        });
    }
};
