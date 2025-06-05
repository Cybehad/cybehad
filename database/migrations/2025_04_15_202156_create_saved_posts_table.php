<?php

use App\Models\User;
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
        Schema::create('saved_posts', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignIdFor(User::class);
            $table->uuid('post_id');
            $table->foreign('post_id')
                ->references('id')->on('posts')->cascadeOnDelete();
            $table->text('notes')->nullable();
            $table->unique(['post_id', 'user_id']);
            $table->timestamps();
            $table->innoDb();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_posts');
    }
};
