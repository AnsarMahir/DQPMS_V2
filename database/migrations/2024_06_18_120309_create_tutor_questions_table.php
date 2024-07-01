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
        Schema::create('tutor_mcq_questions', function (Blueprint $table) {
                $table->id('mcq_questions_id');
                $table->text('description');
                $table->enum('nature',['IQ','GK','MATH','OTHER']);
                $table->unsignedBigInteger('referenceid');
                $table->unsignedBigInteger('correct_answer');
                $table->foreign('referenceid')->references('R_id')->on('reference');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutor_questions');
    }
};
