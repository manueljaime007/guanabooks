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

            $table->foreignUuid('admin_id')
                ->constrained('admins')
                ->restrictOnDelete();

            $table->foreignUuid('post_category_id')
                ->constrained('post_categories')
                ->restrictOnDelete();

            $table->string('title');
            $table->string('slug')->unique();

            $table->text('resume');

            $table->foreignUuid('thumbnail_media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            $table->unsignedInteger('reading_time')->nullable();

            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('shares')->default(0);

            $table->string('status')->default('draft');

            $table->boolean('is_highlight')->default(false);

            $table->timestamp('published_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['admin_id', 'status']);
            $table->index(['post_category_id', 'status']);
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
