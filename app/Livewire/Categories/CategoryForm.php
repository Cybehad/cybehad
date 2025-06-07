<?php

namespace App\Livewire\Categories;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Category;

class CategoryForm extends Component
{
    public Category $category;
    public $categories;

    protected $rules = [
        'category.name' => 'required|string|max:50',
        'category.slug' => 'required|string|max:50|unique:categories,slug',
        'category.description' => 'nullable|string',
        'category.parent_id' => 'nullable|exists:categories,id',
    ];

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->categories = Category::where('id', '!=', $category->id)->get();
    }

    public function updatedCategoryName($value)
    {
        $this->category->slug = Str::slug($value);
    }

    public function save()
    {
        $this->validate();

        $this->category->save();

        session()->flash('message', 'Category saved successfully.');
        return redirect()->route('categories.index');
    }

    public function render()
    {
        return view('livewire.categories.category-form');
    }
}
