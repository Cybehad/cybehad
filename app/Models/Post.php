<?php

namespace App\Models;

use App\Events\PostPublished;
use App\PostStatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::updated(function ($post) {
            if ($post->wasChanged('status') && $post->status === 'published') {
                event(new PostPublished($post));
            }
        });
    }
    protected function cast(): array
    {
        return  [
            'published_at' => 'datetime'
        ];
    }
    public function getReadingTimeAttribute(): float
    {
        $words = str_word_count(strip_tags($this->content));
        return ceil($words / 200); // Average reading speed: 200 words per minute
    }

    public function scopePublished($query)
    {
        return $query->where('status', PostStatusEnum::Published->value);
        // ->where('published_at', 'not', null);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function revisins(): HasMany
    {
        return $this->hasMany(PostRevision::class);
    }
    public function relatedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'related_posts', 'post_id', 'related_post_id');
    }
    public function ratings(): HasMany
    {
        return $this->hasMany(PostRating::class);
    }
    public function likes(): HasMany
    {
        return $this->hasMany(PostLike::class);
    }
    public function readingStats(): HasOne
    {
        return $this->hasOne(PostReadingStats::class);
    }
    public function featuredProducts(): BelongsTo
    {
        return $this->belongsTo(FeaturedProduct::class, 'post_products');
    }
    public function contentBlocks(): BelongsToMany
    {
        return $this->belongsToMany(ContentBlock::class, 'post_blocks')
            ->withPivot('display_order');
    }
    public function views(): HasMany
    {
        return $this->hasMany(PostView::class);
    }
    public function isSaved(): HasOne
    {
        return $this->hasOne(SavedPost::class);
    }
    public function recordView(?string $ipAddress = null, ?int $userIid = null): void
    {
        $this->views()->create([
            'user_id' => $userIid ?? Auth::id(),
            'ip_address' => $ipAddress ?? request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    public function totalViews(): int
    {
        return cache()->remember("post:{$this->id}:total_views", now()->addHours(1), fn() => $this->views()->count());
    }

    public function uniqueViewers(): int
    {
        return cache()->remember("post:{$this->id}:unique_viewers", now()->addHours(1), fn() => $this->views()->distinct('ip_address')->count('ip_address'));
    }

    public function viewedByUser(User $user): bool
    {
        return $this->views()->where('user_id', $user->id)->exists();
    }

}
