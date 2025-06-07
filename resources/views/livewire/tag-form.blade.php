<div>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">
            {{ $tag->exists ? 'Edit Tag' : 'Create New Tag' }}
        </h1>
        <a href="{{ route('tags.index') }}" class="btn btn-outline">Back to Tags</a>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success shadow-lg mb-4">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('message') }}</span>
            </div>
        </div>
    @endif

    <div class="card bg-base-100 shadow">
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <div class="form-control">
                            <label class="label" for="name">
                                <span class="label-text">Tag Name</span>
                            </label>
                            <input wire:model="tag.name" type="text" id="name"
                                   class="input input-bordered w-full" placeholder="Enter tag name">
                            @error('tag.name') <span class="text-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label" for="slug">
                                <span class="label-text">Slug</span>
                            </label>
                            <input wire:model="tag.slug" type="text" id="slug"
                                   class="input input-bordered w-full" placeholder="Tag slug will be generated automatically">
                            @error('tag.slug') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div class="form-control">
                            <label class="label" for="description">
                                <span class="label-text">Description</span>
                            </label>
                            <textarea wire:model="tag.description" id="description"
                                      class="textarea textarea-bordered h-32"
                                      placeholder="Optional tag description"></textarea>
                            @error('tag.description') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="card-actions justify-end mt-6">
                    <button type="submit" class="btn btn-primary">
                        {{ $tag->exists ? 'Update Tag' : 'Create Tag' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if($tag->exists)
        <div class="mt-6 card bg-base-100 shadow">
            <div class="card-body">
                <h2 class="card-title">Tag Statistics</h2>
                <div class="stats stats-vertical lg:stats-horizontal shadow">
                    <div class="stat">
                        <div class="stat-title">Total Posts</div>
                        <div class="stat-value">{{ $tag->posts_count }}</div>
                        <div class="stat-desc">Posts using this tag</div>
                    </div>

                    <div class="stat">
                        <div class="stat-title">Created</div>
                        <div class="stat-value">{{ $tag->created_at->diffForHumans() }}</div>
                        <div class="stat-desc">{{ $tag->created_at->format('M d, Y') }}</div>
                    </div>

                    <div class="stat">
                        <div class="stat-title">Last Updated</div>
                        <div class="stat-value">{{ $tag->updated_at->diffForHumans() }}</div>
                        <div class="stat-desc">{{ $tag->updated_at->format('M d, Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
