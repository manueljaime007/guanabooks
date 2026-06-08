<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('post_id')
                ->on('posts')
                ->onDelete('cascade');

            $table->foreignUuid('tag_id')
                ->on('tags')
                ->onDelete('cascade');

            $table->unique(['post_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_tag');
    }
};
