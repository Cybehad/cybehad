<?php

use App\Models\Post;
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
        Schema::create('post_blocks', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignIdFor(Post::class)->cascadeOnDelete();
            $table->uuid('content_block_id');
            $table->foreign('content_block_id')
                ->references('id')->on('content_blocks')->cascadeOnDelete();
            $table->integer('display_order')->default(0);
            $table->timestamps();
            $table->innoDb();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_blocks');
    }
};
