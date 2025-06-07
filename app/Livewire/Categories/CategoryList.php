<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class CategoryList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'name';
    public $sortDirection = 'asc';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField',
        'sortDirection',
        'perPage',
    ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function deleteCategory($categoryId)
    {
        $category = Category::withTrashed()->findOrFail($categoryId);

        if ($category->trashed()) {
            // Restore logic here if needed
            return;
        }

        // Check if category has posts
        if ($category->posts()->count() > 0) {
            session()->flash('error', 'Cannot delete category with associated posts.');
            return;
        }

        $category->delete();
        session()->flash('message', 'Category deleted successfully.');
    }

    public function render()
    {
        return view('livewire.categories.category-list', [
            'categories' => Category::query()
                ->with(['parent', 'posts'])
                ->withCount('posts')
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%'.$this->search.'%')
                          ->orWhere('description', 'like', '%'.$this->search.'%');
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}
