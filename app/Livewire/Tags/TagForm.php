<?php

namespace App\Livewire\Tags;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Tag;

class TagForm extends Component
{
    public Tag $tag;

    protected $rules = [
        'tag.name' => 'required|string|max:191',
        'tag.slug' => 'required|string|max:50|unique:tags,slug',
        'tag.description' => 'nullable|string',
    ];

    public function mount(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function updatedTagName($value)
    {
        $this->tag->slug = Str::slug($value);
    }

    public function save()
    {
        $this->validate();

        $this->tag->save();

        session()->flash('message', 'Tag saved successfully.');
        return redirect()->route('tags.index');
    }

    public function render()
    {
        return view('livewire.tag-form');
    }
}
