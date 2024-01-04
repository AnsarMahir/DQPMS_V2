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
        Schema::create('question', function (Blueprint $table) {
            $table->id("Q_id");
            $table->string('description');
            $table->enum('type',['MCQ','ShortAnswer']);
            $table->enum('nature',['IQ','GK','MATH','OTHER']);
            $table->foreign('referenceid')->references('R_id')->on('reference');
            $table->foreign('correct_answer')->references('A_id')->on('answer');
            $table->foreign('pastpaper_reference')->references('P_id')->on('pastpaper');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question');
    }
};
