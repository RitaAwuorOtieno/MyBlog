@extends('admin.layout')

@section('title', 'Edit Post')

@section('content')

<h2 class="text-2xl font-semibold mb-4">Edit Post</h2>

<form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block font-semibold mb-1">Title</label>
        <input type="text" name="title"
               class="w-full border p-3 rounded"
               value="{{ $post->title }}" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Content</label>
        <textarea name="content" rows="6"
                  class="w-full border p-3 rounded"
                  required>{{ $post->content }}</textarea>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Update Post
    </button>
</form>

@endsection
