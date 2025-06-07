<div class="bg-white dark:bg-gray-900 min-h-screen">
    <article class="max-w-4xl mx-auto px-4 py-8 lg:py-12">
        <!-- Post Header -->
        <header class="mb-10">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('profile.user', $post->user) }}" class="flex items-center group">
                        <img src="{{ $post->user->avatar_url ?: asset('images/default-avatar.png') }}"
                            alt="{{ $post->user->name }}"
                            class="w-10 h-10 rounded-full ring-2 ring-indigo-100 dark:ring-gray-700 group-hover:ring-indigo-300 transition">
                        <div class="ml-3">
                            <p
                                class="font-medium text-gray-900 dark:text-gray-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition">
                                {{ $post->user->name }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ \Carbon\Carbon::parse($post->published_at)->format('F j, Y') }} •
                                {{ $post->readingStats?->estimated_reading_time ?? 5 }} min read
                            </p>
                        </div>
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    <button wire:click="toggleLike"
                        class="flex items-center space-x-1 text-gray-500 hover:text-red-500 dark:hover:text-red-400 transition"
                        aria-label="{{ $hasLiked ? 'Unlike' : 'Like' }} this post">
                        <svg class="w-6 h-6" fill="{{ $hasLiked ? 'currentColor' : 'none' }}" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                        <span class="text-sm">{{ $likeCount }}</span>
                    </button>

                    <button wire:click="toggleSave"
                        class="text-gray-500 hover:text-blue-500 dark:hover:text-blue-400 transition"
                        aria-label="{{ $isSaved ? 'Remove from saved' : 'Save this post' }}">
                        <svg class="w-6 h-6" fill="{{ $isSaved ? 'currentColor' : 'none' }}" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                {{ $post->title }}
            </h1>

            @if($post->image)
                <div class="rounded-xl overflow-hidden shadow-lg mb-8">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                        class="w-full h-auto max-h-96 object-cover">
                </div>
            @endif
        </header>

        <!-- Post Content -->
        <div class="prose dark:prose-invert max-w-none mb-12 text-gray-700 dark:text-gray-300">
            {!! $post->content !!}
        </div>

        <!-- Content Blocks -->
        @foreach($post->contentBlocks()->orderByPivot('display_order')->get() as $block)
            <div class="my-8 p-6 bg-gray-50 dark:bg-gray-800 rounded-xl shadow-sm">
                <div class="prose dark:prose-invert max-w-none">
                    {!! $block->content !!}
                </div>
            </div>
        @endforeach

        <!-- Rating Section -->
        <div class="my-12 border-t border-gray-200 dark:border-gray-700 pt-10">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Rate this article</h3>
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <div class="flex items-center">
                    @for($i = 1; $i <= 5; $i++)
                        <button wire:click="rating = {{ $i }}" class="text-3xl focus:outline-none transition"
                            aria-label="Rate {{ $i }} star">
                            @if($i <= $rating)
                                <span class="text-amber-400">★</span>
                            @else
                                <span class="text-gray-300 dark:text-gray-600 hover:text-amber-300">☆</span>
                            @endif
                        </button>
                    @endfor
                    <span class="ml-3 text-gray-600 dark:text-gray-400">
                        {{ number_format($averageRating, 1) }} ({{ $post->ratings()->count() }} ratings)
                    </span>
                </div>
                <button wire:click="ratePost"
                    class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition whitespace-nowrap">
                    Submit Rating
                </button>
            </div>
        </div>

        <!-- Related Posts -->
        @if($relatedPosts->isNotEmpty())
            <div class="my-12 border-t border-gray-200 dark:border-gray-700 pt-10">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Related Articles</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedPosts as $related)
                        <a href="{{ route('posts.show', $related->slug) }}"
                            class="group border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden hover:shadow-lg transition-shadow">
                            @if($related->image)
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            @endif
                            <div class="p-5">
                                <h4
                                    class="font-bold text-lg text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition">
                                    {{ $related->title }}
                                </h4>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mt-2 line-clamp-2">
                                    {{ $related->excerpt }}
                                </p>
                                <div class="flex items-center mt-4 text-sm text-gray-500 dark:text-gray-400">
                                    <span>{{ $related->readingStats?->estimated_reading_time ?? 5 }} min read</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Comments Section -->
        <div class="my-12 border-t border-gray-200 dark:border-gray-700 pt-10">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                Discussion ({{ $comments->count() }})
            </h3>

            @auth
                <div class="mb-8 bg-gray-50 dark:bg-gray-800 rounded-xl p-5 shadow-sm">
                    <textarea wire:model="commentContent" placeholder="Add a comment..."
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></textarea>
                    <div class="flex justify-end mt-3">
                        <button wire:click="addComment"
                            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">Post
                            Comment</button>
                    </div>
                    {{-- <textarea wire:model="commentContent" placeholder="Share your thoughts..."
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></textarea>
                    <div class="flex justify-end mt-3">
                        <button wire:click="addComment"
                            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition"
                            :disabled="!commentContent.trim()">
                            Post Comment
                        </button>
                    </div> --}}
                </div>
            @else
                <div class="mb-8 bg-gray-50 dark:bg-gray-800 rounded-xl p-5 shadow-sm text-center">
                    <p class="text-gray-600 dark:text-gray-300">
                        Please <a href="{{ route('login') }}"
                            class="text-indigo-600 dark:text-indigo-400 hover:underline">sign in</a>
                        to participate in the discussion.
                    </p>
                </div>
            @endauth

            <div class="space-y-6">
                @foreach($comments as $comment)
                    <div class="border-b border-gray-100 dark:border-gray-700 pb-6 last:border-0">
                        <div class="flex items-start space-x-4">
                            <a href="{{ route('profile.user', $comment->user) }}" class="flex-shrink-0">
                                <img src="{{ $comment->user->avatar_url ?: asset('images/default-avatar.png') }}"
                                    alt="{{ $comment->user->name }}"
                                    class="w-10 h-10 rounded-full ring-2 ring-gray-100 dark:ring-gray-700 hover:ring-indigo-300 transition">
                            </a>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <a href="{{ route('profile.user', $comment->user) }}"
                                            class="font-medium text-gray-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                            {{ $comment->user->name }}
                                        </a>
                                        <span class="ml-2 text-xs text-gray-500 dark:text-gray-400">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    @if(auth()->id() === $comment->user_id)
                                        <button wire:click="deleteComment('{{ $comment->id }}')"
                                            class="text-gray-400 hover:text-red-500 transition" aria-label="Delete comment">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                                <p class="mt-2 text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $comment->content }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </article>
</div>
