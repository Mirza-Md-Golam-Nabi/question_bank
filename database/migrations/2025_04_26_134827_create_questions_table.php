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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('subject_id')->index();
            $table->unsignedMediumInteger('chapter_id')->index();
            $table->unsignedInteger('topic_id')->index()->nullable();
            $table->string('question_text', 500);
            $table->unsignedTinyInteger('correct_option_index');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
