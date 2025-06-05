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
        Schema::create('post_reading_stats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('post_id')->unique();
            $table->foreign('post_id')
            ->references('id')->on('posts')->cascadeOnDelete();
            $table->integer('word_count');
            $table->integer('estimated_reading_time');
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->innoDb();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_reading_stats');
    }
};
