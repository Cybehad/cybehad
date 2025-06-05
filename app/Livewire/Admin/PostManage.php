<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\FeaturedProduct;
use App\Models\ContentBlock;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class PostManage extends Component
{
    use WithFileUploads;

    public $post;
    public $title;
    public $slug;
    public $excerpt;
    public $content;
    public $image;
    public $status = 'draft';
    public $published_at;
    public $category_id;
    public $meta_title;
    public $meta_description;
    public $selectedTags = [];
    public $selectedProducts = [];
    public $selectedBlocks = [];
    public $isEditing = false;
    public $showRevisionModal = false;
    public $revisionContent = '';
    public $revisionNotes = '';

    protected $rules = [
        'title' => 'required|min:3',
        'slug' => 'required|unique:posts,slug',
        'content' => 'required|min:10',
        'category_id' => 'required|exists:categories,id',
        'status' => 'required|in:draft,published,archived',
        'published_at' => 'nullable|date',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->isEditing = true;
        $this->fill($this->post->toArray());
        $this->selectedTags = $this->post->tags->pluck('id')->toArray();
        $this->selectedProducts = $this->post->featuredProducts->pluck('id')->toArray();
        $this->selectedBlocks = $this->post->contentBlocks->pluck('id')->toArray();
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function savePost()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'status' => $this->status,
            'published_at' => $this->status === 'published' ? ($this->published_at ?? now()) : null,
            'category_id' => $this->category_id,
            'author_id' => Auth::id(),
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('posts', 'public');
        }

        if ($this->isEditing) {
            // Create revision before updating
            $this->post->revisions()->create([
                'user_id' => Auth::id(),
                'title' => $this->post->title,
                'content' => $this->post->content,
                'excerpt' => $this->post->excerpt,
                'revision_notes' => 'Autosave before edit'
            ]);

            $this->post->update($data);
        } else {
            $this->post = Post::create($data);
            $this->isEditing = true;
        }

        // Sync relationships
        $this->post->tags()->sync($this->selectedTags);
        $this->post->featuredProducts()->sync($this->selectedProducts);
        $this->post->contentBlocks()->sync(
            collect($this->selectedBlocks)->mapWithKeys(function ($blockId, $index) {
                return [$blockId => ['display_order' => $index]];
            })
        );

        session()->flash('message', 'Post saved successfully!');
    }

    public function saveRevision()
    {
        $this->validate([
            'revisionNotes' => 'required|min:3',
            'revisionContent' => 'required|min:10'
        ]);

        $this->post->revisions()->create([
            'user_id' => Auth::id(),
            'title' => $this->post->title,
            'content' => $this->revisionContent,
            'excerpt' => $this->post->excerpt,
            'revision_notes' => $this->revisionNotes
        ]);

        $this->showRevisionModal = false;
        $this->revisionNotes = '';
        $this->revisionContent = '';

        session()->flash('message', 'Revision saved successfully!');
    }

    public function render()
    {
        return view('livewire.admin.post-manage', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'products' => FeaturedProduct::active()->get(),
            'contentBlocks' => ContentBlock::all(),
            'revisions' => $this->isEditing ? $this->post->revisions()->latest()->get() : collect(),
        ]);
    }
}
