<div>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Posts</h1>
        <a href="{{ route('posts.admin.create') }}" class="btn btn-primary">Create New Post</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 border-b">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="w-full md:w-auto">
                    <input wire:model.live.debounce.300ms="search" type="text"
                           placeholder="Search posts..." class="input input-bordered w-full">
                </div>
                <div class="flex flex-wrap gap-2">
                    <select wire:model.live="statusFilter" class="select select-bordered">
                        <option value="">All Statuses</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
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
                        <th wire:click="sortBy('title')" class="cursor-pointer">
                            Title
                            @if($sortField === 'title')
                                @if($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                        <th>Category</th>
                        <th wire:click="sortBy('status')" class="cursor-pointer">
                            Status
                            @if($sortField === 'status')
                                @if($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                        <th wire:click="sortBy('published_at')" class="cursor-pointer">
                            Published
                            @if($sortField === 'published_at')
                                @if($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>
                                <span class="badge badge-{{ $post->status === 'published' ? 'success' : ($post->status === 'draft' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </td>
                            <td>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M d, Y') : '-' }}</td>
                            <td class="flex gap-2">
                                <a href="{{ route('posts.admin.edit', $post) }}" class="btn btn-sm btn-outline">Edit</a>
                                <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                        wire:click="deletePost('{{ $post->id }}')"
                                        class="btn btn-sm btn-error">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No posts found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t">
            {{ $posts->links() }}
        </div>
    </div>
</div>
