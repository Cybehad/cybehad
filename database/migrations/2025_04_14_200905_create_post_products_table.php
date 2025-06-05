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
        Schema::create('post_products', function (Blueprint $table) {
            $table->foreignIdFor(Post::class)
                ->constrained()->cascadeOnDelete();
            $table->uuid('product_id');
            $table->foreign('product_id')
                ->references('id')->on('featured_products')->cascadeOnDelete();
            $table->primary(['post_id', 'product_id']);
            $table->timestamps();
            $table->innoDb();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_products');
    }
};
