@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold text-indigo-600 mb-6">Edit Post</h1>

    <form action="{{ route('admin.update', $post) }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-gray-700 font-medium">Title</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Content</label>
            <textarea name="content" rows="6" class="w-full border-gray-300 rounded-lg shadow-sm" required>{{ old('content', $post->content) }}</textarea>
            @error('content') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">Cancel</a>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                Update Post
            </button>
        </div>
    </form>
</div>
@endsection
