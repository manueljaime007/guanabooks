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
        Schema::create('book_tag', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('book_id')
                ->constrained('books')
                ->onDelete('cascade');
            $table->foreignUuid('tag_id')
                ->constrained('tags')
                ->onDelete('cascade');
            $table->unique(['book_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_tag');
    }
};
