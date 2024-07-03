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
        Schema::create('upcomingexams', function (Blueprint $table) {
            $table->id();
            $table->string('examination_name')->default('Unknown')->nullable(false);
            $table->date('closing_date');
            $table->date('exam_date');
            $table->string('gazzete_notice');
            $table->string('amendment_notice');
            $table->string('apply_link');
            $table->string('quick_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upcomingexams');
    }
};
