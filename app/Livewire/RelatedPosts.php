<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class RelatedPosts extends Component
{
    public $post;
    public $relatedPosts;

    public function mount($post)
    {
        $this->post = $post;
        $this->loadRelatedPosts();
    }

    public function loadRelatedPosts()
    {
        // Get manual related posts first
        $this->relatedPosts = $this->post->relatedPosts()
            ->published()
            ->limit(3)
            ->get();

        // If not enough, get automatic related posts by tags
        if ($this->relatedPosts->count() < 3) {
            $needed = 3 - $this->relatedPosts->count();
            $autoRelated = Post::whereHas('tags', function($query) {
                    $tagIds = $this->post->tags->pluck('id');
                    $query->whereIn('tags.id', $tagIds);
                })
                ->published()
                ->where('posts.id', '!=', $this->post->id)
                ->limit($needed)
                ->get();

            $this->relatedPosts = $this->relatedPosts->merge($autoRelated);
        }
    }

    public function render()
    {
        return view('livewire.related-posts');
    }
}
