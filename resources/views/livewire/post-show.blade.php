<div>
    <article class="max-w-4xl mx-auto px-4 py-8">
        <header class="mb-8">
            <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>

            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <img src="{{ $post->user->avatar_url ?: asset('images/default-avatar.png') }}" alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full">
                        <div class="ml-3">
                            <p class="font-medium">{{ $post->user->name }}</p>
                            <p class="text-sm text-gray-500">{{  \Carbon\Carbon::parse($post->published_at)->format('F j, Y') }} • {{ $post->readingStats?->estimated_reading_time }} min read</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <button wire:click="toggleLike" class="flex items-center space-x-1 text-gray-500 hover:text-red-500">
                        <svg class="w-5 h-5" fill="{{ $hasLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span>{{ $likeCount }}</span>
                    </button>

                    <button wire:click="toggleSave" class="flex items-center space-x-1 text-gray-500 hover:text-blue-500">
                        <svg class="w-5 h-5" fill="{{ $isSaved ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            {{-- saved {{ $isSaved }} --}}
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full rounded-lg mb-6">
            @endif
        </header>

        <div class="prose max-w-none mb-12">
            {!! $post->content !!}
        </div>

        <!-- Content Blocks -->
        @foreach($post->contentBlocks()->orderByPivot('display_order')->get() as $block)
            <div class="my-8 p-6 bg-gray-50 rounded-lg">
                {!! $block->content !!}
            </div>
        @endforeach

        <!-- Featured Products -->
        {{-- @if($post->featuredProducts->isNotEmpty())
            <div class="my-8">
                <h3 class="text-xl font-bold mb-4">Featured Products</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($post->featuredProducts as $product)
                        <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-32 object-contain mb-2">
                            <h4 class="font-bold">{{ $product->name }}</h4>
                            <p class="text-gray-600 text-sm mb-2">{{ $product->description }}</p>
                            <p class="font-bold text-blue-600">${{ number_format($product->price, 2) }}</p>
                            <a href="{{ $product->product_url }}" target="_blank" class="inline-block mt-2 px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">View Product</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif --}}

        <!-- Rating Section -->
        <div class="my-8 border-t pt-8">
            <h3 class="text-xl font-bold mb-4">Rate this article</h3>
            <div class="flex items-center space-x-2 mb-2">
                @for($i = 1; $i <= 5; $i++)
                    <button wire:click="rating = {{ $i }}" class="text-2xl focus:outline-none hover:text-amber-400" id="{{ $i }}">
                        @if($i <= $rating)
                            ⭐
                        @else
                            ☆
                        @endif
                    </button>
                @endfor
                <span class="ml-2 text-gray-600">{{ number_format($averageRating, 1) }} ({{ $post->ratings()->count() }} ratings)</span>
            </div>
            <button wire:click="ratePost" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Submit Rating</button>
        </div>

        <!-- Related Posts -->
        @if($relatedPosts->isNotEmpty())
            <div class="my-8 border-t pt-8">
                <h3 class="text-xl font-bold mb-4">Related Articles</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($relatedPosts as $related)
                        <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                            <a href="{{ route('posts.show', $related->slug) }}">
                                @if($related->image)
                                    <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}" class="w-full h-32 object-cover">
                                @endif
                                <div class="p-4">
                                    <h4 class="font-bold">{{ $related->title }}</h4>
                                    <p class="text-gray-600 text-sm">{{ $related->excerpt }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Comments Section -->
        <div class="my-8 border-t pt-8">
            <h3 class="text-xl font-bold mb-4">Comments ({{ $comments->count() }})</h3>

            @auth
                <div class="mb-6">
                    <textarea wire:model="commentContent" placeholder="Add a comment..." class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    <button wire:click="addComment" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Post Comment</button>
                </div>
            @else
                <p class="mb-4 text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-600 hover:underline">login</a> to post a comment.</p>
            @endauth

            <div class="space-y-6">
                @foreach($comments as $comment)
                    <div class="border-b pb-4">
                        <div class="flex items-start space-x-3">
                            <img src="{{ $comment->user->avatar_url ?: asset('images/default-avatar.png') }}" alt="{{ $comment->user->name }}" class="w-10 h-10 rounded-full">
                            <div>
                                <div class="flex items-center space-x-2">
                                    <p class="font-small">{{ $comment->user->name }}</p>
                                    <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="mt-1 text-gray-400l">{{ $comment->content }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </article>
</div>
