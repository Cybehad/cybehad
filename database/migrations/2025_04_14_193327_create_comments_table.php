<?php

use App\CommentStatusEnum;
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
        Schema::create('comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(User::class)
                ->cascadeOnDelete();
            $table->uuid('post_id');
            $table->foreign('post_id')
                ->references('id')->on('posts')
                ->cascadeOnDelete();
            $table->uuid('parent_id')->nullable();
            $table->foreign('parent_id')
                ->references('id')->on('comments');
            $table->string('author_name', 100)->nullable();
            $table->string('author_email', 100)->nullable();
            $table->text('content');
            $table->enum('status', array_column(CommentStatusEnum::cases(), 'value'))
                ->default(CommentStatusEnum::Pending->value);
            $table->softDeletes();
            $table->timestamps();
            $table->innoDb();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
