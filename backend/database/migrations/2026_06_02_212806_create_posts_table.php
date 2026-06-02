<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignUuid('post_category_id')
                ->constrained('post_categories')
                ->onDelete('restrict');

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('resume');
            $table->longText('content');
            $table->string('thumbnail_url')->nullable();

            $table->unsignedInteger('reading_time')->nullable();
            $table->bigInteger('views')->default(0);
            $table->bigInteger('shares')->default(0);

            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('is_highlight')->default(false);

            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['post_category_id', 'status']);
            $table->index('slug');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
