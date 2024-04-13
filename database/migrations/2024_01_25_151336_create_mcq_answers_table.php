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
        Schema::create('mcq_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('mcq_ans_id');
            $table->text('description');
            $table->unsignedBigInteger('reference')->nullable();
            $table->primary(['mcq_ans_id','question_id']);
            $table->foreign('question_id')->references('mcq_questions_id')->on('mcq_questions');
            $table->foreign('reference')->references('R_id')->on('reference');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcq_answers');
    }
};
