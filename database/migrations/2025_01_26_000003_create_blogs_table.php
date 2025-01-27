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

        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable(); // Changed from string to text
            $table->json('tags')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('view_count')->default(0);
            $table->integer('comment_count')->default(0);
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->integer('like_count')->default(0);
            $table->integer('share_count')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
