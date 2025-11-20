@extends('admin.layout')

@section('title', 'Create Post')

@section('content')

<h2 class="text-2xl font-semibold mb-4">Create New Post</h2>

<form action="{{ route('admin.posts.store') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label class="block font-semibold mb-1">Title</label>
        <input type="text" name="title"
               class="w-full border p-3 rounded"
               value="{{ old('title') }}" required>
        @error('title')
            <p class="text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Content</label>
        <textarea name="content" rows="6"
                  class="w-full border p-3 rounded"
                  required>{{ old('content') }}</textarea>
        @error('content')
            <p class="text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">
        Save Post
    </button>
</form>

@endsection
