@extends('admin.layout')

@section('title', 'Posts')

@section('content')

<div class="flex justify-between mb-4">
    <h2 class="text-2xl font-semibold">All Posts</h2>

    <a href="{{ route('admin.posts.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded">
        + New Post
    </a>
</div>

@if(session('success'))
    <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="min-w-full bg-white rounded shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 text-left">#</th>
            <th class="p-3 text-left">Title</th>
            <th class="p-3 text-left">Created</th>
            <th class="p-3 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr class="border-b">
            <td class="p-3">{{ $post->id }}</td>
            <td class="p-3 font-semibold">{{ $post->title }}</td>
            <td class="p-3">{{ $post->created_at->format('d M Y') }}</td>
            <td class="p-3 space-x-2">
                <a href="{{ route('posts.edit', $post->id) }}"
                   class="text-blue-600 hover:underline">
                    Edit
                </a>

                <form action="{{ route('posts.destroy', $post->id) }}" 
                      method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 hover:underline"
                            onclick="return confirm('Delete this post?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $posts->links() }}
</div>

@endsection
