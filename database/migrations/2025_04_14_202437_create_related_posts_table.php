<?php

use App\RelatedPostRelationTypeEnum;
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
        Schema::create('related_posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('post_id');
            $table->foreign('post_id')
                ->references('id')->on('posts')->cascadeOnDelete();
            $table->uuid('related_post_id');
            $table->foreign('related_post_id')
                ->references('id')->on('posts')->cascadeOnDelete();
            $table->enum('relation_type', array_column(RelatedPostRelationTypeEnum::cases(), 'value'))
                ->default(RelatedPostRelationTypeEnum::Manual->value);
            $table->integer('weight')->default(1);
            $table->unique(['post_id','related_post_id']);
            $table->timestamp('create_at')->useCurrent();
            $table->innoDb();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('related_posts');
    }
};
