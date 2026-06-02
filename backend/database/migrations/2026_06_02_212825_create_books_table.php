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
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')
            ->constrained('users')
            ->onDelete('cascade');
            $table->foreignUuid('book_category_id')
            ->constrained('book_categories')
            ->onDelete('restrict');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('resume');
            $table->string('thumbnail_url')->nullable();
            $table->string('pdf_url');
            $table->unsignedInteger('reading_time')->nullable();
            $table->bigInteger('downloads')->default(0);
            $table->bigInteger('shares')->default(0);
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('is_highlight')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['user_id', 'status']);
            $table->index(['book_category_id', 'status']);
            $table->index('slug');
            $table->index('published_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
