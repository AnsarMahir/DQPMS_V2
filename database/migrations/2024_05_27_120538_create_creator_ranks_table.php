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
        Schema::create('creator_ranks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id');
            $table->integer('rank')->default(1);
            $table->integer('no_of_questions');
            $table->foreign("creator_id")->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creator_ranks');
    }
};
