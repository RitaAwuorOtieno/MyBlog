@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Hero Section with Video Background -->
    <section class="relative h-screen flex flex-col justify-center items-center text-center overflow-hidden rounded-xl mb-20">
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover brightness-50">
            <source src="{{ asset('videos/blog-hero.mp4') }}" type="video/mp4" />
            Your browser does not support the video tag.
        </video>

        <div class="relative z-10 max-w-4xl px-6">
            <h1 class="text-6xl font-extrabold text-white drop-shadow-lg leading-tight mb-6">
                Welcome to <span class="text-blue-400">Our Blog</span>
            </h1>
            <p class="text-xl text-blue-200 mb-8">
                Dive deep into inspiring stories, tutorials, and the latest insights from industry leaders. Your learning journey starts here.
            </p>
            <a href="#posts"
               class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold px-8 py-4 rounded-lg shadow-lg transition duration-300">
                Explore Posts
            </a>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-10 animate-bounce">
            <svg class="w-8 h-8 text-white mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </section>

    <!-- Featured Posts Section -->
    <section id="posts" class="mb-24">
        <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-12 text-center">Latest Posts</h2>

        @if($posts->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @foreach($posts as $post)
            <article class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-400 overflow-hidden flex flex-col">
                @if($post->image_url ?? false)
                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="h-48 w-full object-cover rounded-t-xl">
                @else
                    <div class="h-48 w-full bg-gray-200 dark:bg-gray-700 rounded-t-xl flex items-center justify-center text-gray-400 dark:text-gray-600">
                        No Image
                    </div>
                @endif

                <div class="p-6 flex-grow flex flex-col">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-3">{{ $post->title }}</h3>
                    <p class="text-gray-700 dark:text-gray-300 flex-grow">{{ Str::limit($post->content, 150) }}</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach($post->tags ?? [] as $tag)
                            <span class="bg-blue-100 dark:bg-blue-700 text-blue-800 dark:text-blue-200 text-xs font-semibold uppercase tracking-wide px-3 py-1 rounded-full">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                    <a href="#" class="mt-6 inline-block text-blue-600 dark:text-blue-400 font-semibold hover:underline self-start">Read more &rarr;</a>
                </div>

                <footer class="px-6 py-3 bg-gray-100 dark:bg-gray-700 text-sm text-gray-600 dark:text-gray-300">
                    <span>Published on {{ $post->created_at->format('M d, Y') }}</span>
                </footer>
            </article>
            @endforeach
        </div>
        @else
            <p class="text-center text-gray-600 dark:text-gray-400">No posts yet. Stay tuned!</p>
        @endif
    </section>

    <!-- Newsletter Call to Action -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl text-center py-16 px-8 text-white shadow-lg">
        <h2 class="text-4xl font-extrabold mb-4">Subscribe to Our Newsletter</h2>
        <p class="max-w-xl mx-auto mb-8 text-lg tracking-wide">
            Get the latest articles, tips, and tutorials delivered straight to your inbox. Join thousands of readers and never miss out!
        </p>
        <form action="" method="POST" class="max-w-md mx-auto flex flex-col sm:flex-row gap-4">
            @csrf
            <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required
                class="flex-grow rounded-md px-5 py-4 text-gray-900 focus:outline-none focus:ring-4 focus:ring-indigo-300"
            />
            <button
                type="submit"
                class="bg-white text-indigo-700 font-bold rounded-md px-8 py-4 hover:bg-indigo-100 transition duration-300"
            >
                Subscribe
            </button>
        </form>
    </section>

    <!-- Footer Section -->
    <footer class="mt-24 bg-gray-900 text-gray-400 dark:text-gray-300 py-12">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between px-6 sm:px-8 lg:px-0">
            <!-- About -->
            <div class="mb-8 md:mb-0 max-w-sm">
                <h3 class="text-white text-xl font-bold mb-4">Your Blog Name</h3>
                <p class="text-gray-400 leading-relaxed">
                    Sharing knowledge and stories that inspire. Connect with us on social media and stay informed.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="mb-8 md:mb-0">
                <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                    <li><a href="#" class="hover:text-white transition">About</a></li>
                    <li><a href="#" class="hover:text-white transition">Blog</a></li>
                    <li><a href="#" class="hover:text-white transition">Contact</a></li>
                </ul>
            </div>

            <!-- Social Links -->
            <div>
                <h4 class="text-white font-semibold mb-4">Follow Us</h4>
                <div class="flex space-x-6">
                    <a href="#" aria-label="Twitter" class="hover:text-white transition">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14.86 5.48 5.48 0 002.4-3.02 10.9 10.9 0 01-3.47 1.33A5.43 5.43 0 0016.4 2c-3 0-5.4 2.44-5.4 5.45 0 .43.05.85.14 1.25C7.69 7.5 4.07 5.67 1.64 2.76a5.48 5.48 0 00-.73 2.74c0 1.9.97 3.57 2.44 4.56a5.33 5.33 0 01-2.45-.67v.06c0 2.65 1.9 4.87 4.43 5.37a5.5 5.5 0 01-2.44.1 5.45 5.45 0 005.08 3.78 10.94 10.94 0 01-6.75 2.33c-.44 0-.86-.03-1.28-.08a15.42 15.42 0 008.29 2.43c9.94 0 15.38-8.29 15.38-15.47 0-.24 0-.48-.02-.71A11 11 0 0023 3z"/></svg>
                    </a>
                    <a href="#" aria-label="Facebook" class="hover:text-white transition">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M22.68 0H1.32A1.32 1.32 0 000 1.32v21.36A1.32 1.32 0 001.32 24h11.5v-9.3H9.7v-3.63h3.11V8.41c0-3.1 1.9-4.78 4.66-4.78 1.32 0 2.46.1 2.79.14v3.24h-1.91c-1.5 0-1.79.71-1.79 1.75v2.3h3.58l-.47 3.62h-3.11V24h6.1A1.32 1.32 0 0024 22.68V1.32A1.32 1.32 0 0022.68 0z"/></svg>
                    </a>
                    <a href="#" aria-label="Instagram" class="hover:text-white transition">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2.2c3.1 0 3.48 0 4.7.07 1.18.06 1.82.25 2.24.42.57.24.98.53 1.41.96.43.43.72.84.96 1.41.17.42.36 1.06.42 2.24.07 1.22.07 1.6.07 4.7s0 3.48-.07 4.7c-.06 1.18-.25 1.82-.42 2.24-.24.57-.53.98-.96 1.41-.43.43-.84.72-1.41.96-.42.17-1.06.36-2.24.42-1.22.07-1.6.07-4.7.07s-3.48 0-4.7-.07c-1.18-.06-1.82-.25-2.24-.42-.57-.24-.98-.53-1.41-.96-.43-.43-.72-.84-.96-1.41-.17-.42-.36-1.06-.42-2.24C2.2 15.48 2.2 15.1 2.2 12s0-3.48.07-4.7c.06-1.18.25-1.82.42-2.24.24-.57.53-.98.96-1.41.43-.43.84-.72 1.41-.96.42-.17 1.06-.36 2.24-.42C8.52 2.2 8.9 2.2 12 2.2zm0 1.8c-3 0-3.36 0-4.55.06-1.1.06-1.7.23-2.1.39-.53.22-.9.49-1.3.89-.4.4-.67.77-.89 1.3-.16.4-.33 1-.39 2.1-.06 1.19-.06 1.55-.06 4.55s0 3.36.06 4.55c.06 1.1.23 1.7.39 2.1.22.53.49.9.89 1.3.4.4.77.67 1.3.89.4.16 1 .33 2.1.39 1.19.06 1.55.06 4.55.06s3.36 0 4.55-.06c1.1-.06 1.7-.23 2.1-.39.53-.22.9-.49 1.3-.89.4-.4.67-.77.89-1.3.16-.4.33-1 .39-2.1.06-1.19.06-1.55.06-4.55s0-3.36-.06-4.55c-.06-1.1-.23-1.7-.39-2.1-.22-.53-.49-.9-.89-1.3-.4-.4-.77-.67-1.3-.89-.4-.16-1-.33-2.1-.39C15.36 4 15 4 12 4zM12 7.8a4.2 4.2 0 104.2 4.2A4.21 4.21 0 0012 7.8zm0 6.9a2.7 2.7 0 112.7-2.7A2.7 2.7 0 0112 14.7zm4.5-7.8a1 1 0 11-1-1 1 1 0 011 1z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="text-center text-gray-500 dark:text-gray-400 mt-8 text-sm">
            &copy; {{ date('Y') }} Your Blog Name. All rights reserved.
        </div>
    </footer>
</div>
@endsection
