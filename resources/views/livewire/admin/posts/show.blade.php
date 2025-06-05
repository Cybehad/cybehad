<?php

use Livewire\Volt\Component;
use App\Models\Post;

new class extends Component {
    public $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }
}; ?>

<div class="transition-colors duration-300 bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-4 dark:text-gray-100">{{ $post->title }}</h1>
    <div class="mb-4 text-gray-600 dark:text-gray-400 flex items-center space-x-4">
        <span>By {{ $post->user->name ?? 'Unknown' }}</span>
        <span>•</span>
        <span>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M d, Y') : 'Draft' }}</span>
        @if($post->category)
            <span>•</span>
            <span
                class="bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 px-2 py-1 rounded text-xs">{{ $post->category->name }}</span>
        @endif
    </div>
    @if($post->image)
        <div class="mb-6">
            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                class="rounded shadow max-h-96 w-full object-cover">
        </div>
    @endif
    <div class="prose dark:prose-invert max-w-none dark:text-gray-100">
        {!! nl2br(e($post->content)) !!}
    </div>
    @if($post->tags && $post->tags->count())
        <div class="mt-6">
            <span class="font-semibold dark:text-gray-200">Tags:</span>
            @foreach($post->tags as $tag)
                <span
                    class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-2 py-1 rounded text-xs mr-2">{{ $tag->name }}</span>
            @endforeach
        </div>
    @endif
    <div class="mt-6">
        <a href="{{ route('admin.posts.index') }}" wire::navigate
            class="text-blue-600 hover:underline">Back to Posts</a>
    </div>
    <div class="flex items-center justify-between mt-6">
    <div class="mt-6 flex space-x-4">
        <button wire:click="$emit('publishPost', {{ $post->id }})"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Publish</button>
        <button wire:click="$emit('unpublishPost', {{ $post->id }})"
            class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Unpublish</button>
    </div>
    <div class="mt-6 flex space-x-4">
        <button wire:click="$emit('deletePost', {{ $post->id }})"
            class="bg-red-600 text-white px-2 rounded hover:bg-red-700">Delete</button>
        <a href="{{ route('admin.posts.edit', $post->id) }}" wire:navigate
            class="bg-blue-600 text-white px-2 py-2 rounded hover:bg-blue-700">Edit</a>
        <a href="{{ route('admin.posts.show', $post->id) }}" wire:navigate
            class="bg-gray-600 text-white px-2 py-2 rounded hover:bg-gray-700">Show</a>
    </div>
    </div>
</div>
