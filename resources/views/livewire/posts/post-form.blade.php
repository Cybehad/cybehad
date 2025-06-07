<div>
    <form wire:submit="save">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Main content -->
            <div class="md:col-span-2 space-y-6">
                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <div class="form-control">
                            <label class="label" for="title">
                                <span class="label-text">Title</span>
                            </label>
                            <input wire:model="post.title" type="text" id="title" class="input input-bordered">
                            @error('post.title') <span class="text-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label" for="slug">
                                <span class="label-text">Slug</span>
                            </label>
                            <input wire:model="post.slug" type="text" id="slug" class="input input-bordered">
                            @error('post.slug') <span class="text-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label" for="excerpt">
                                <span class="label-text">Excerpt</span>
                            </label>
                            <textarea wire:model="post.excerpt" id="excerpt" class="textarea textarea-bordered h-24"></textarea>
                            @error('post.excerpt') <span class="text-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label" for="content">
                                <span class="label-text">Content</span>
                            </label>
                            <textarea wire:model="post.content" id="content" class="textarea textarea-bordered h-64"></textarea>
                            @error('post.content') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Content Blocks -->
                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <h2 class="card-title">Content Blocks</h2>
                        <div class="space-y-4">
                            @foreach($contentBlocks as $index => $block)
                                <div class="border rounded-lg p-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-medium">{{ ucfirst($block['type']) }} Block</span>
                                        <button type="button" wire:click="removeContentBlock({{ $index }})" class="btn btn-sm btn-error">
                                            Remove
                                        </button>
                                    </div>
                                    <div class="prose max-w-none">
                                        {!! $block['content'] !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 space-y-4">
                            <select wire:model="newBlockType" class="select select-bordered w-full">
                                <option value="text">Text Block</option>
                                <option value="image">Image Block</option>
                                <option value="video">Video Block</option>
                                <option value="quote">Quote Block</option>
                            </select>
                            <textarea wire:model="newBlockContent" class="textarea textarea-bordered w-full" placeholder="Block content"></textarea>
                            <button type="button" wire:click="addContentBlock" class="btn btn-primary">
                                Add Block
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <h2 class="card-title">Publish</h2>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text">Status</span>
                                <select wire:model="post.status" class="select select-bordered">
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                    <option value="archived">Archived</option>
                                </select>
                            </label>
                        </div>

                        <div class="form-control">
                            <label class="label" for="published_at">
                                <span class="label-text">Publish Date</span>
                            </label>
                            <input wire:model="post.published_at" type="datetime-local" id="published_at" class="input input-bordered">
                        </div>

                        <div class="card-actions justify-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                Save Post
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <h2 class="card-title">Featured Image</h2>
                        <div class="form-control">
                            @if($image)
                                <img src="{{ $image->temporaryUrl() }}" class="w-full h-auto mb-4 rounded-lg">
                            @elseif($post->image)
                                <img src="{{ asset('storage/'.$post->image) }}" class="w-full h-auto mb-4 rounded-lg">
                            @endif
                            <input wire:model="image" type="file" class="file-input file-input-bordered w-full">
                            @error('image') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <h2 class="card-title">Categories</h2>
                        <div class="form-control">
                            <select wire:model="post.category_id" class="select select-bordered">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('post.category_id') <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <h2 class="card-title">Tags</h2>
                        <div class="form-control">
                            <select wire:model="selectedTags" multiple class="select select-bordered h-auto">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
