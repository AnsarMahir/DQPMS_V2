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
        Schema::create('mcq_questions', function (Blueprint $table) {
            $table->id('mcq_questions_id');
            $table->text('description');
            $table->enum('nature',['IQ','GK','MATH','OTHER']);
            $table->unsignedBigInteger('referenceid')->nullable();
            $table->unsignedBigInteger('correct_answer');
            $table->unsignedBigInteger('pastpaper_reference');
            $table->foreign('referenceid')->references('R_id')->on('reference');
            $table->foreign('pastpaper_reference')->references('P_id')->on('pastpaper');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcq_questions');
    }
};
