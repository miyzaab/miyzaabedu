<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MiyzaabEdu - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#10b981",
                        secondary: "#0f766e",
                        "background-light": "#f3f4f6",
                        "background-dark": "#111827",
                        "card-light": "#ffffff",
                        "card-dark": "#1f2937",
                    },
                    fontFamily: {
                        display: ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-5px)'
                            },
                        }
                    }
                },
            },
        };
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .text-gradient {
                @apply bg-clip-text text-transparent bg-gradient-to-r from-emerald-500 to-teal-500;
            }
            .bg-gradient-primary {
                @apply bg-gradient-to-r from-emerald-500 to-teal-600;
            }
            .bg-gradient-sidebar {
                @apply bg-gradient-to-b from-emerald-900 via-[#065f46] to-teal-900;
            }
        }
    </style>
</head>

<body
    class="font-display bg-background-light dark:bg-background-dark text-gray-800 dark:text-gray-100 transition-colors duration-200">
    <div class="flex h-screen overflow-hidden">
        <aside
            class="w-64 flex-shrink-0 flex flex-col bg-gradient-sidebar dark:from-gray-900 dark:to-gray-900 border-r border-gray-700 dark:border-gray-800 transition-all duration-300 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none opacity-20">
                <div class="absolute -top-24 -left-24 w-64 h-64 rounded-full bg-emerald-400 blur-3xl"></div>
                <div class="absolute top-1/2 -right-24 w-48 h-48 rounded-full bg-teal-400 blur-3xl"></div>
            </div>
            <div class="h-16 flex items-center px-6 border-b border-white/10 dark:border-gray-800 relative z-10">
                <span class="material-icons-outlined text-white text-2xl mr-2 animate-pulse-slow">verified_user</span>
                <span class="text-white font-bold text-xl tracking-tight">Admin Panel</span>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto custom-scrollbar relative z-10">
                <a class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.dashboard') ? 'text-white bg-white/10 shadow-sm ring-1 ring-white/20' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} transition-all duration-200 group"
                    href="{{ route('admin.dashboard') }}">
                    <span
                        class="material-icons-outlined mr-3 transform group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">dashboard</span>
                    Dashboard
                </a>
                <a class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.audio.*') ? 'text-white bg-white/10 shadow-sm ring-1 ring-white/20' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} transition-all duration-200 group"
                    href="{{ route('admin.audio.index') }}">
                    <span
                        class="material-icons-outlined mr-3 transform group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300 {{ request()->routeIs('admin.audio.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">library_music</span>
                    Audio
                </a>
                <a class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.videos.*') ? 'text-white bg-white/10 shadow-sm ring-1 ring-white/20' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} transition-all duration-200 group"
                    href="{{ route('admin.videos.index') }}">
                    <span
                        class="material-icons-outlined mr-3 transform group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300 {{ request()->routeIs('admin.videos.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">movie</span>
                    Video
                </a>
                <a class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.articles.*') ? 'text-white bg-white/10 shadow-sm ring-1 ring-white/20' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} transition-all duration-200 group"
                    href="{{ route('admin.articles.index') }}">
                    <span
                        class="material-icons-outlined mr-3 transform group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300 {{ request()->routeIs('admin.articles.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">article</span>
                    Artikel
                </a>
                <a class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.quizzes.*') ? 'text-white bg-white/10 shadow-sm ring-1 ring-white/20' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} transition-all duration-200 group"
                    href="{{ route('admin.quizzes.index') }}">
                    <span
                        class="material-icons-outlined mr-3 transform group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300 {{ request()->routeIs('admin.quizzes.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">quiz</span>
                    Kuis
                </a>
                @if(auth()->user() && auth()->user()->isSuperAdmin())
                    <a class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.users.*') ? 'text-white bg-white/10 shadow-sm ring-1 ring-white/20' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} transition-all duration-200 group"
                        href="{{ route('admin.users.index') }}">
                        <span
                            class="material-icons-outlined mr-3 transform group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">people</span>
                        Manajemen Pengguna
                    </a>
                @endif
                <a class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.categories.*') ? 'text-white bg-white/10 shadow-sm ring-1 ring-white/20' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} transition-all duration-200 group"
                    href="{{ route('admin.categories.index') }}">
                    <span
                        class="material-icons-outlined mr-3 transform group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300 {{ request()->routeIs('admin.categories.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">folder_open</span>
                    Kategori
                </a>
                <a class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.progress.*') ? 'text-white bg-white/10 shadow-sm ring-1 ring-white/20' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} transition-all duration-200 group"
                    href="{{ route('admin.progress.index') }}">
                    <span
                        class="material-icons-outlined mr-3 transform group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300 {{ request()->routeIs('admin.progress.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">trending_up</span>
                    Perkembangan User
                </a>
                <div class="border-t border-white/10 my-4"></div>
                <a class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-emerald-300 hover:bg-emerald-500/10 hover:text-emerald-200 transition-all duration-200 group"
                    href="{{ route('dashboard') }}">
                    <span
                        class="material-icons-outlined mr-3 text-emerald-300 group-hover:text-emerald-200 transform group-hover:translate-x-1 transition-transform duration-300">arrow_back</span>
                    Kembali ke Aplikasi
                </a>
            </nav>
            <div class="border-t border-white/10 p-4 relative z-10">
                <div class="flex items-center group cursor-pointer">
                    <div class="relative">
                        <div
                            class="h-9 w-9 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white font-bold">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                    </div>
                    <div class="ml-3 group-hover:translate-x-1 transition-transform duration-200">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->name ?? 'Admin User' }}</p>
                        <p class="text-xs text-gray-400">{{ Auth::user()->email ?? 'admin@example.com' }}</p>
                    </div>
                </div>
            </div>
        </aside>
        <main class="flex-1 flex flex-col h-screen overflow-y-auto">
            <header
                class="h-16 bg-card-light dark:bg-gray-800 shadow-sm flex items-center justify-between px-6 lg:px-8 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-10 backdrop-blur-md bg-opacity-90 dark:bg-opacity-90">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">
                        @yield('title', 'Dashboard Admin')</h1>
                </div>
                <div class="flex items-center gap-4">
                    <!-- Dark Mode Toggle -->
                    <button id="darkModeToggle" onclick="toggleDarkMode()"
                        class="relative flex items-center justify-center w-12 h-12 rounded-xl bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-300 group">
                        <!-- Sun Icon (Light Mode) -->
                        <span
                            class="material-icons-outlined text-amber-500 text-xl absolute transition-all duration-300 opacity-100 dark:opacity-0 scale-100 dark:scale-50 rotate-0 dark:rotate-90">
                            light_mode
                        </span>
                        <!-- Moon Icon (Dark Mode) -->
                        <span
                            class="material-icons-outlined text-indigo-400 text-xl absolute transition-all duration-300 opacity-0 dark:opacity-100 scale-50 dark:scale-100 -rotate-90 dark:rotate-0">
                            dark_mode
                        </span>
                    </button>
                </div>
            </header>

            <div class="p-6 lg:p-8 flex-1">
                @if(session('success'))
                    <div
                        class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center">
                        <span class="material-icons-outlined mr-2">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center">
                        <span class="material-icons-outlined mr-2">error</span>
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </div>

            <footer
                class="mt-auto px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-800">
                © {{ date('Y') }} MiyzaabEdu Admin Panel. All rights reserved.
            </footer>
        </main>
    </div>
    <script>
        // Dark Mode Toggle Function
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('admin_theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        }

        // On page load, apply saved theme
        if (localStorage.admin_theme === 'dark' || (!('admin_theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</body>

</html>