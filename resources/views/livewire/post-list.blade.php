<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Blog Posts</h1>
        <div class="flex space-x-4">
            <input wire:model.debounce.500ms="search" type="text" placeholder="Search" class="px-4 py-2 border rounded">
            <select class="px-4 py-2 border rounded">
                <option value="">All</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if($posts->isEmpty())
        <p class="text-gray-500">No posts found.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <div class="rounded-lg shadow-md overflow-hidden bg-gray-100 dark:bg-gray-800">
                    @if($post->image)
                        <img src="{{  $post->image }}" alt="{{ Str::limit($post->title, limit: 80, end: '...') }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <span>{{ \Carbon\Carbon::parse($post->published_at)->format( 'd, M, Y') }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $post->readingStats?->estimated_reading_time }} min read</span>
                        </div>
                        <h2 class="text-xl font-bold mb-2">
                            <a href="{{ route('posts.show', $post->id) }}" class="hover:text-blue-600">{{ Str::limit($post->title,20) }}</a>
                        </h2>
                        <p class="text-gray-600 mb-4">{{ Str::limit(value:$post->excerpt, limit: 60, end: '...') }}</p>
                        <div class="flex items-center justify-between">
                            <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:underline">Read More</a>
                            <div class="flex items-center space-x-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <span class="ml-1">{{ number_format($post->ratings()->avg('rating'), 1) }}</span>
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-1">{{ $post->likes()->count() }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @endif

</div>
