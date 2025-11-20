@extends('layouts.app')

@section('title', 'About Us - MyBlog')

@section('content')
    <section class="max-w-4xl mx-auto bg-white p-10 rounded-lg shadow-md">
        <h1 class="text-4xl font-bold mb-6 text-indigo-600 text-center">About MyBlog</h1>

        <p class="text-gray-700 mb-6 leading-relaxed text-lg">
            Welcome to <span class="font-semibold">MyBlog</span>, your number one source for all things related to Laravel, Tailwind CSS, and web development. We're dedicated to providing you the best tutorials, tips, and resources to help you become a better developer.
        </p>

        <p class="text-gray-700 mb-6 leading-relaxed text-lg">
            Founded in 2025, MyBlog has come a long way from its beginnings. When we first started out, our passion for teaching and sharing knowledge drove us to create a blog that’s both easy to understand and practical. We hope you enjoy our content as much as we enjoy offering it to you.
        </p>

        <p class="text-gray-700 mb-6 leading-relaxed text-lg">
            If you have any questions or comments, please don’t hesitate to <a href="{{ url('/contact') }}" class="text-indigo-600 font-semibold hover:underline">contact us</a>. We’re here to help!
        </p>

        <div class="mt-10 text-center">
            <h2 class="text-2xl font-bold text-indigo-600 mb-2">Our Mission</h2>
            <p class="text-gray-700 text-lg max-w-2xl mx-auto leading-relaxed">
                To empower developers worldwide with clear, accessible, and practical web development tutorials and resources.
            </p>
        </div>
    </section>
@endsection
