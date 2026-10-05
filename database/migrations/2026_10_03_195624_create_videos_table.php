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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('artist');
            $table->string('album')->nullable();
            $table->integer('year')->default(2024);
            $table->string('genre')->default('Classical Fusion');
            $table->string('language')->default('Regional'); // Regional, English
            $table->string('thumbnail')->nullable();
            $table->string('video_url')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_new')->default(true);
            $table->decimal('rating', 3, 1)->default(4.9);
            $table->integer('rating_count')->default(20);
            $table->integer('views')->default(0);
            $table->integer('downloads')->default(0);
            $table->string('duration')->default('4:20');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
