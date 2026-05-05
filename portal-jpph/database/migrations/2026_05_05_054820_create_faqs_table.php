<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->text('question_bm');
            $table->text('question_en');
            $table->text('answer_bm');
            $table->text('answer_en');
            $table->string('category', 50)->default('umum');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
            $table->index('category');
            if (\DB::connection()->getDriverName() === 'mysql') {
                $table->fullText(['question_bm', 'question_en', 'answer_bm', 'answer_en']);
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
