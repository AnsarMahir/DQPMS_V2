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
        Schema::create('pastpaper', function (Blueprint $table) {
            $table->id('P_id');
            $table->string('name',100);
            $table->year("year");
            $table->enum('language',['English','Sinhala','Tamil']);
            $table->enum('question_type',['MCQ','Short Answer']);
            $table->integer('no_of_questions');
            $table->enum('CreatorState',['Draft','Submitted','Approved']);
            $table->enum('ModeratorState',['Draft','Review','Published']);
            $table->unsignedBigInteger('CreatorID');
            $table->unsignedBigInteger('ModeratorID');
            $table->foreign("CreatorID")->references('id')->on('users');
            $table->foreign("ModeratorID")->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pastpaper');
    }
};
