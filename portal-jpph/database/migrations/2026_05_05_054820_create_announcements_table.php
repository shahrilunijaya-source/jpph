<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title_bm');
            $table->string('title_en');
            $table->string('excerpt_bm', 500);
            $table->string('excerpt_en', 500);
            $table->string('image_path')->nullable();
            $table->timestamp('published_at');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            $table->index('published_at');
            $table->index('expires_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
