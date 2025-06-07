<div>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">
            {{ $category->exists ? 'Edit Category' : 'Create New Category' }}
        </h1>
        <a href="{{ route('categories.index') }}" class="btn btn-outline">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Categories
        </a>
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
                                <span class="label-text">Category Name*</span>
                            </label>
                            <input wire:model="category.name" type="text" id="name"
                                   class="input input-bordered w-full" placeholder="e.g. Technology, Travel">
                            @error('category.name') <span class="text-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label" for="slug">
                                <span class="label-text">Slug*</span>
                            </label>
                            <input wire:model="category.slug" type="text" id="slug"
                                   class="input input-bordered w-full" placeholder="Will be generated automatically">
                            @error('category.slug') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div class="form-control">
                            <label class="label" for="parent_id">
                                <span class="label-text">Parent Category</span>
                            </label>
                            <select wire:model="category.parent_id" id="parent_id" class="select select-bordered w-full">
                                <option value="">No Parent (Top Level)</option>
                                @foreach($categories as $cat)
                                    @if(!$category->exists || $cat->id !== $category->id)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category.parent_id') <span class="text-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label" for="description">
                                <span class="label-text">Description</span>
                            </label>
                            <textarea wire:model="category.description" id="description"
                                      class="textarea textarea-bordered h-32"
                                      placeholder="Optional category description"></textarea>
                            @error('category.description') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="card-actions justify-end mt-6">
                    <button type="submit" class="btn btn-primary">
                        @if($category->exists)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Update Category
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Create Category
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if($category->exists)
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Stats Card -->
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h2 class="card-title">Category Stats</h2>
                    <div class="stats stats-vertical shadow bg-transparent">
                        <div class="stat">
                            <div class="stat-title">Total Posts</div>
                            <div class="stat-value">{{ $category->posts_count }}</div>
                            <div class="stat-desc">In this category</div>
                        </div>
                        <div class="stat">
                            <div class="stat-title">Subcategories</div>
                            <div class="stat-value">{{ $category->children_count }}</div>
                            <div class="stat-desc">Nested categories</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline Card -->
            <div class="card bg-base-100 shadow md:col-span-2">
                <div class="card-body">
                    <h2 class="card-title">Activity Timeline</h2>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="flex flex-col items-center">
                                <div class="h-4 w-4 bg-primary rounded-full mt-1"></div>
                                <div class="h-full w-px bg-gray-200"></div>
                            </div>
                            <div>
                                <p class="font-medium">Category Created</p>
                                <p class="text-sm text-gray-500">{{ $category->created_at->format('M d, Y \a\t h:i A') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex flex-col items-center">
                                <div class="h-4 w-4 bg-secondary rounded-full mt-1"></div>
                                <div class="h-full w-px bg-gray-200"></div>
                            </div>
                            <div>
                                <p class="font-medium">Last Updated</p>
                                <p class="text-sm text-gray-500">{{ $category->updated_at->format('M d, Y \a\t h:i A') }}</p>
                                @if($category->updated_at->diffInHours($category->created_at) > 0)
                                    <p class="text-xs text-gray-400 mt-1">
                                        ({{ $category->updated_at->diffForHumans() }})
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
