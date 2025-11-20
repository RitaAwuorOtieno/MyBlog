<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="flex">

        {{-- Sidebar --}}
        <aside class="w-64 h-screen bg-white shadow-lg fixed">
            <div class="p-6 border-b">
                <h2 class="text-xl font-bold">Admin Panel</h2>
            </div>

            <nav class="mt-4">
                <ul>
                    <li class="px-6 py-3 hover:bg-gray-200">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="px-6 py-3 hover:bg-gray-200">
                        <a href="{{ route('posts.index') }}">Manage Posts</a>
                    </li>

                    <li class="px-6 py-3 hover:bg-gray-200">
                        <a href="{{ route('admin.payments') }}">Mpesa Payments</a>
                    </li>

                    <li class="px-6 py-3 hover:bg-gray-200">
                        <a href="{{ route('admin.contacts') }}">Contacts</a>
                    </li>
                </ul>
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="ml-64 flex-1">

            {{-- Top navbar --}}
            <header class="bg-white p-4 shadow flex justify-between">
                <h1 class="text-2xl font-semibold">@yield('header')</h1>

                <div>
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="bg-red-500 text-white px-4 py-2 rounded">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
