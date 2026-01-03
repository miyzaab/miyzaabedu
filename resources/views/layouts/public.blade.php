<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Miyzaab Edu') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-50 flex flex-col min-h-screen">

    <!-- Navigation with Glassmorphism -->
    <nav x-data="{ open: false }"
        class="sticky top-0 w-full z-50 transition-all duration-300 bg-emerald-600/70 backdrop-blur-xl border-b border-white/20 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-white font-arabic">Miyzaab Edu</a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8">
                    <a href="/" class="text-white/90 hover:text-white transition">Beranda</a>
                    <a href="{{ route('articles.index') }}"
                        class="text-white/90 hover:text-white transition {{ request()->routeIs('articles.*') ? 'font-bold border-b-2 border-white' : '' }}">Artikel</a>
                    <a href="{{ route('audio.index') }}"
                        class="text-white/90 hover:text-white transition {{ request()->routeIs('audio.*') ? 'font-bold border-b-2 border-white' : '' }}">Audio</a>
                    <a href="{{ route('videos.index') }}"
                        class="text-white/90 hover:text-white transition {{ request()->routeIs('videos.*') ? 'font-bold border-b-2 border-white' : '' }}">Video</a>

                </div>

                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg backdrop-blur-sm transition">Dashboard
                            Penilaian</a>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-gray-200">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 bg-white text-emerald-700 rounded-lg font-semibold hover:bg-gray-100 transition">Daftar</a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="-mr-2 flex items-center md:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-200 hover:bg-emerald-700 focus:outline-none focus:bg-emerald-700 focus:text-white transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-emerald-700">
            <div class="pt-2 pb-3 space-y-1">
                <a href="/"
                    class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-white hover:text-gray-100 hover:bg-emerald-800 hover:border-gray-300 transition duration-150 ease-in-out">Beranda</a>
                <a href="{{ route('articles.index') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-white hover:text-gray-100 hover:bg-emerald-800 hover:border-gray-300 transition duration-150 ease-in-out">Artikel</a>
                <a href="{{ route('audio.index') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-white hover:text-gray-100 hover:bg-emerald-800 hover:border-gray-300 transition duration-150 ease-in-out">Audio</a>
                <a href="{{ route('videos.index') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-white hover:text-gray-100 hover:bg-emerald-800 hover:border-gray-300 transition duration-150 ease-in-out">Video</a>
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-white hover:text-gray-100 hover:bg-emerald-800 hover:border-gray-300 transition duration-150 ease-in-out">Dashboard
                        Penilaian</a>
                @endauth
            </div>
            <div class="pt-4 pb-1 border-t border-emerald-800">
                @auth
                    <div class="px-4">
                        <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-emerald-200">{{ Auth::user()->email }}</div>
                    </div>
                @else
                    <div class="px-4 space-y-2">
                        <a href="{{ route('login') }}" class="block text-white">Masuk</a>
                        <a href="{{ route('register') }}" class="block text-white">Daftar</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-800 py-12 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-white/50 font-arabic">&copy; {{ date('Y') }} Miyzaab Edu. Barakallahu Fiikum.</p>
        </div>
    </footer>
    @livewireScripts
</body>

</html>