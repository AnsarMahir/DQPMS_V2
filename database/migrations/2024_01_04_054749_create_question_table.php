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
            $table->unsignedBigInteger('referenceid');
            $table->unsignedBigInteger('correct_answer');
            $table->unsignedBigInteger('pastpaper_reference');
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
