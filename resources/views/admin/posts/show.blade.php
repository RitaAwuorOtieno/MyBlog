@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>

    <div class="prose max-w-none">
        {!! nl2br(e($post->content)) !!}
    </div>

    <a href="{{ route('posts.index') }}" class="mt-6 inline-block text-indigo-600 hover:underline">Back to all posts</a>
@endsection
