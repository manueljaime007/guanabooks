<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_analytics', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('post_id')
                ->constrained('posts')
                ->onDelete('cascade');

            $table->foreignUuid('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            $table->ipAddress('ip_address');
            $table->string('user_agent')->nullable();
            $table->timestamp('viewed_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('post_id');
            $table->index('user_id');
            $table->index('viewed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_analytics');
    }
};
