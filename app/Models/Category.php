<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $guarded = ['id'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function scopeWithParent($query)
    {
        return $query->with('parent');
    }
    public function scopeWithChildren($query)
    {
        return $query->with('children');
    }
    public function scopeWithPosts($query)
    {
        return $query->with('posts');
    }
    public function scopeWithAll($query)
    {
        return $query->with(['parent', 'children', 'posts']);
    }

}
