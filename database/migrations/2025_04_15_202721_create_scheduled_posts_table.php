<?php

use App\ScheduledPostStatusEnum;
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
        Schema::create('scheduled_posts', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('post_id');
            $table->foreign('post_id')
                ->references('id')->on('posts')->cascadeOnDelete();
            $table->timestamp('scheduled_at')->useCurrent();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->enum('status', array_column(ScheduledPostStatusEnum::cases(), 'value'))
                ->default(ScheduledPostStatusEnum::Pending->value);
            $table->timestamp('create_at')->useCurrent();
            $table->innoDb();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduled_posts');
    }
};
