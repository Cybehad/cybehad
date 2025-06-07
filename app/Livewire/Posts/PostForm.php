<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class PostForm extends Component
{
    use WithFileUploads;

    public Post $post;
    public $categories;
    public $tags;
    public $selectedTags = [];
    public $image;
    public $contentBlocks = [];
    public $newBlockType = 'text';
    public $newBlockContent = '';

    protected $rules = [
        'post.title' => 'required|string|max:191',
        'post.slug' => 'required|string|max:191|unique:posts,slug',
        'post.excerpt' => 'nullable|string',
        'post.content' => 'required|string',
        'post.category_id' => 'required|exists:categories,id',
        'post.status' => 'required|in:draft,published,archived',
        'post.published_at' => 'nullable|date',
        'image' => 'nullable|image|max:2048',
        'selectedTags' => 'array',
        'selectedTags.*' => 'exists:tags,id',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->categories = Category::all();
        $this->tags = Tag::all();

        if ($post->exists) {
            $this->selectedTags = $post->tags->pluck('id')->toArray();
        }
    }

    public function updatedPostTitle($value)
    {
        $this->post->slug = Str::slug($value);
    }

    public function addContentBlock()
    {
        $this->validate([
            'newBlockType' => 'required|string',
            'newBlockContent' => 'required|string',
        ]);

        $this->contentBlocks[] = [
            'type' => $this->newBlockType,
            'content' => $this->newBlockContent,
        ];

        $this->newBlockContent = '';
    }

    public function removeContentBlock($index)
    {
        unset($this->contentBlocks[$index]);
        $this->contentBlocks = array_values($this->contentBlocks);
    }

    public function save()
    {
        $this->validate();

        if ($this->image) {
            $this->post->image = $this->image->store('posts', 'public');
        }

        $this->post->save();

        // Sync tags
        $this->post->tags()->sync($this->selectedTags);

        // Save content blocks
        if (!empty($this->contentBlocks)) {
            foreach ($this->contentBlocks as $block) {
                $contentBlock = $this->post->contentBlocks()->create([
                    'type' => $block['type'],
                    'content' => $block['content'],
                ]);
            }
        }

        session()->flash('message', 'Post saved successfully.');
        return redirect()->route('posts.admin.index');
    }

    public function render()
    {
        return view('livewire.posts.post-form');
    }
}
