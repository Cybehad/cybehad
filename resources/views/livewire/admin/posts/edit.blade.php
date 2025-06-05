<?php

use Livewire\Volt\Component;
use App\Models\Post;

new class extends Component {
    public $post;
    public $title;
    public $content;
    public $image;
    public $newImage;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->image = $post->image;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'newImage' => 'nullable|image|max:2048',
        ];
    }

    public function update()
    {
        $this->validate();

        if ($this->newImage) {
            $imagePath = $this->newImage->store('posts', 'public');
            $this->post->image = $imagePath;
        }

        $this->post->title = $this->title;
        $this->post->content = $this->content;
        $this->post->save();

        session()->flash('success', 'Post updated successfully.');
    }
}; ?>


<div class="transition-colors duration-300 bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md max-w-2xl mx-auto">

    <h2 class="text-2xl font-bold mb-6 dark:text-gray-100">Edit Post</h2>
    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="title" class="block font-semibold mb-1 dark:text-gray-200">Title</label>
            <input wire:model.defer="title" type="text"
                class="w-full px-3 py-2 rounded border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                id="title" placeholder="Enter post title">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="content" class="block font-semibold mb-1 dark:text-gray-200">Content</label>
            <textarea wire:model.defer="content"
                class="w-full px-3 py-2 rounded border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('content') border-red-500 @enderror"
                id="content" rows="6" placeholder="Write your post..."></textarea>
            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="newImage" class="block font-semibold mb-1 dark:text-gray-200">Image</label>
            <input wire:model="newImage" type="file"
                class="w-full px-3 py-2 rounded border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('newImage') @enderror"
                id="newImage" accept="image/*">
            @error('newImage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if (isset($newImage) && $newImage)
                <div class="mt-3">
                    <img src="{{ $newImage->temporaryUrl() }}" alt="Preview" class="rounded shadow max-h-48">
                </div>
            @elseif (isset($image) && $image)
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $image) }}" alt="Current Image" class="rounded shadow max-h-48">
                </div>
            @endif
        </div>
        <div class="flex justify-end">
            <button type="submit"
                class="px-6 py-2 rounded bg-blue-600 text-white font-semibold hover:bg-blue-700 transition dark:bg-blue-700 dark:hover:bg-blue-800">
                <span wire:loading wire:target="update" class="spinner-border spinner-border-sm me-2"></span>
                Update
            </button>
        </div>
    </form>
</div>
