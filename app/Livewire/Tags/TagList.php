<?php

namespace App\Livewire\Tags;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tag;

class TagList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function deleteTag($tagId)
    {
        $tag = Tag::findOrFail($tagId);

        // Check if tag has posts
        if ($tag->posts()->count() > 0) {
            session()->flash('error', 'Cannot delete tag with associated posts.');
            return;
        }

        $tag->delete();
        session()->flash('message', 'Tag deleted successfully.');
    }

    public function render()
    {
        return view('livewire.tags.tag-list', [
            'tags' => Tag::query()
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%'.$this->search.'%')
                          ->orWhere('description', 'like', '%'.$this->search.'%');
                })
                ->paginate($this->perPage),
        ]);
    }
}
