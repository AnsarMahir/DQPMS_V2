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
        Schema::create('tutor_sh_questions', function (Blueprint $table) {
            $table->id('sh_questions_id');
            $table->text('description');
            $table->enum('nature',['IQ','GK','MATH','OTHER','LOGIC']);
            $table->unsignedBigInteger('q_referenceid')->nullable();
            $table->text('correct_answer')->nullable();
            $table->unsignedBigInteger('a_referenceid')->nullable();
            $table->foreign('q_referenceid')->references('R_id')->on('reference');
            $table->foreign('a_referenceid')->references('R_id')->on('reference');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutor_sh_questions');
    }
};
