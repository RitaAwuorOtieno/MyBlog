@extends('layouts.app')

@section('title', 'Contact Us - MyBlog')

@section('content')
    <section class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-indigo-600 text-center">Contact Us</h1>

        <form action="#" method="POST" class="space-y-6">
            {{-- Name --}}
            <div>
                <label for="name" class="block mb-2 font-semibold text-gray-700">Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Your full name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required
                />
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block mb-2 font-semibold text-gray-700">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="you@example.com"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required
                />
            </div>

            {{-- Subject --}}
            <div>
                <label for="subject" class="block mb-2 font-semibold text-gray-700">Subject</label>
                <input
                    type="text"
                    id="subject"
                    name="subject"
                    placeholder="Subject of your message"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required
                />
            </div>

            {{-- Message --}}
            <div>
                <label for="message" class="block mb-2 font-semibold text-gray-700">Message</label>
                <textarea
                    id="message"
                    name="message"
                    rows="5"
                    placeholder="Write your message here..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-y"
                    required
                ></textarea>
            </div>

          
            <div class="text-center">
         <button type="submit">Send Message</button>

            </div>
        </form>
    </section>
@endsection
