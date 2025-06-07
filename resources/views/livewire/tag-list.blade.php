<div>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Tags</h1>
        <a href="{{ route('tags.create') }}" class="btn btn-primary">Create New Tag</a>
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

    @if (session()->has('error'))
        <div class="alert alert-error shadow-lg mb-4">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 border-b">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="w-full md:w-auto">
                    <input wire:model.live.debounce.300ms="search" type="text"
                           placeholder="Search tags..." class="input input-bordered w-full">
                </div>
                <div class="flex flex-wrap gap-2">
                    <select wire:model.live="perPage" class="select select-bordered">
                        <option value="10">10 per page</option>
                        <option value="25">25 per page</option>
                        <option value="50">50 per page</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th wire:click="sortBy('name')" class="cursor-pointer">
                            Name
                            @if($sortField === 'name')
                                @if($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                        <th wire:click="sortBy('slug')" class="cursor-pointer">
                            Slug
                            @if($sortField === 'slug')
                                @if($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                        <th>Posts</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tags as $tag)
                        <tr>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->slug }}</td>
                            <td>{{ $tag->posts_count }}</td>
                            <td class="flex gap-2">
                                <a href="{{ route('tags.edit', $tag) }}" class="btn btn-sm btn-outline">Edit</a>
                                <button onclick="confirm('Are you sure you want to delete this tag?') || event.stopImmediatePropagation()"
                                        wire:click="deleteTag('{{ $tag->id }}')"
                                        class="btn btn-sm btn-error">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No tags found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t">
            {{ $tags->links() }}
        </div>
    </div>
</div>
