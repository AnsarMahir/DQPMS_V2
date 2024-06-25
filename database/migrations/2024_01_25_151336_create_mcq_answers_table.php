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
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('mcq_ans_id');
            $table->text('description')->nullable();;
            $table->unsignedBigInteger('reference')->nullable();
            $table->foreign('question_id')->references('mcq_questions_id')->on('mcq_questions')->onDelete('cascade');
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
