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
        Schema::create('paper_title_pivot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paper_title_id');
            $table->unsignedBigInteger('title_types_id');
            $table->foreign('paper_title_id')->references('id')->on('paper_titles')->onDelete('cascade');
            $table->foreign('title_types_id')->references('id')->on('paper_title_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paper_title_pivot');
    }
};
