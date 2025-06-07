<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;
    public $search = '';
    public $category = '';
    public $tag = '';
    public $perPage = 12;
    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'tag' => ['except' => ''],
    ];
    public function mount(Category $category, Tag $tag)
    {
        $this->category = $category->id;
        $this->tag = $tag->id;
    }
    public function render()
    {
        // dd($this->category);
        $posts = Post::with(['user', 'category', 'tags'])
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, function ($query) {
                $query->whereHas('category', function ($q) {
                    $q->where('id', $this->category);
                });
            })
            ->when($this->tag, function ($query) {
                $query->whereHas('tags', function ($q) {
                    $q->where('id', $this->tag);
                });
            })
            ->published()
            ->latest('published_at')
            ->paginate($this->perPage);
        return view('livewire.post-list', ['posts' => $posts, 'categories' => Category::all()])
            ->layout('components.layouts.custom', [
                'title' => 'Posts | ' . env('APP_NAME'),
            ]);
    }
}
