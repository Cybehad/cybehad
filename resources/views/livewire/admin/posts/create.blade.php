<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Storage;

new class extends Component {
    public $title = '';
    public $content = '';
    public $image;

    public function save()
    {
        // Validate input
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048', // max 2MB
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('posts', 'public');
        }

        // Save post (assuming Post model exists)
        \App\Models\Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $imagePath,
        ]);

        // Optionally reset fields or emit event
        $this->reset(['title', 'content', 'image']);
        session()->flash('success', 'Post created successfully.');
    }
}; ?>



<div class="transition-colors duration-300 bg-white dark:bg-gray-900 p-4 rounded shadow-sm">
    @if (session()->has('success'))
        <div class="alert alert-success dark:bg-green-900 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="transition-colors duration-300" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label fw-bold dark:text-gray-200">Title</label>
            <input wire:model.defer="title" type="text"
                class="form-control @error('title') is-invalid @enderror dark:bg-gray-800 dark:text-gray-100" id="title"
                placeholder="Enter post title">
            @error('title') <span class="invalid-feedback d-block dark:text-red-300">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label fw-bold dark:text-gray-200">Content</label>
            <textarea wire:model.defer="content"
                class="form-control @error('content') is-invalid @enderror dark:bg-gray-800 dark:text-gray-100"
                id="content" rows="5" placeholder="Write your post..."></textarea>
            @error('content') <span class="invalid-feedback d-block dark:text-red-300">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label fw-bold dark:text-gray-200">Image</label>
            <input wire:model="image" type="file"
                class="form-control @error('image') is-invalid @enderror dark:bg-gray-800 dark:text-gray-100" id="image"
                accept="image/*">
            @error('image') <span class="invalid-feedback d-block dark:text-red-300">{{ $message }}</span> @enderror

            @if ($image)
                <div class="mt-2">
                    <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="img-thumbnail" style="max-height: 200px;">
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary dark:bg-blue-700 dark:border-blue-700 dark:hover:bg-blue-800">
                <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-2"></span>
                Create Post
            </button>
        </div>
    </form>
</div>
