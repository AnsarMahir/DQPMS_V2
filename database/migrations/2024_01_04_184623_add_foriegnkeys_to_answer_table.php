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
        Schema::table('answer', function (Blueprint $table) {
            $table->foreign('question_id')->references('Q_id')->on('question');
            $table->foreign('reference')->references('R_id')->on('reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('answer', function (Blueprint $table) {
            $table->dropForeign(['question_id']);
            $table->dropForeign(['reference']);
            $table->dropColumn('question_id');
            $table->dropColumn('reference');
        });
    }
};
