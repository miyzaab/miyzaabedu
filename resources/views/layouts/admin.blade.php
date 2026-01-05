<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
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
    <style>
        /* Mobile sidebar - hidden by default */
        @media (max-width: 767px) {
            #sidebar {
                transform: translateX(-100%) !important;
            }
            #sidebar.sidebar-open {
                transform: translateX(0) !important;
            }
        }
    </style>
</head>

<body
    class="font-display bg-background-light dark:bg-background-dark text-gray-800 dark:text-gray-100 transition-colors duration-200">
    <div class="flex h-screen overflow-hidden bg-background-light dark:bg-background-dark relative">
        <!-- Mobile Overlay -->
        <div id="sidebar-overlay"
            class="fixed inset-0 bg-black/50 z-20 hidden md:hidden backdrop-blur-sm transition-opacity"></div>

        <aside id="sidebar"
            class="w-64 flex flex-col bg-gradient-sidebar dark:from-gray-900 dark:to-gray-900 border-r border-gray-700 dark:border-gray-800 transition-transform duration-300 fixed md:relative inset-y-0 left-0 z-30 -translate-x-full md:translate-x-0 overflow-hidden shadow-xl md:shadow-none">
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
                <a class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.users.*') ? 'text-white bg-white/10 shadow-sm ring-1 ring-white/20' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} transition-all duration-200 group"
                    href="{{ route('admin.users.index') }}">
                    <span
                        class="material-icons-outlined mr-3 transform group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">people</span>
                    Manajemen Pengguna
                </a>
                <a class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.categories.*') ? 'text-white bg-white/10 shadow-sm ring-1 ring-white/20' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} transition-all duration-200 group"
                    href="{{ route('admin.categories.index') }}">
                    <span
                        class="material-icons-outlined mr-3 transform group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300 {{ request()->routeIs('admin.categories.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">folder_open</span>
                    Kategori
                </a>
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
                        <img alt="Admin User"
                            class="h-9 w-9 rounded-full object-cover border-2 border-transparent bg-clip-border bg-gradient-to-br from-emerald-400 to-teal-500 p-[2px]"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDLJ19NvD7b_7ahpxf9ABPqcQSxKWVv62sgwYuz9cxQOny-xNV9XQTN5y13j5MFY0PZu8T4p-pTwRGAOJk2LYZ_b9Sz-Y2NAvCabysLF00mt2j0KmvqSOUcBk8zfncIxR-t1hAmBTcWcfuGjLBf208WrrwYLaE2Yf8W-860ilHRereAEZLgWW5H3pe-3Ojr6mjOYyflX-DzsBP-qUjDIjTSXqmwFLiNbIW7GorlBhDjqbLhiCUacnDr4UQcQjPvTQXx-X88y3yteePe" />
                    </div>
                    <div class="ml-3 group-hover:translate-x-1 transition-transform duration-200">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->name ?? 'Admin User' }}</p>
                        <p class="text-xs text-gray-400">View Profile</p>
                    </div>
                </div>
            </div>
        </aside>
        <main class="flex-1 flex flex-col h-screen overflow-y-auto">
            <header
                class="h-16 bg-card-light dark:bg-gray-800 shadow-sm flex items-center justify-between px-4 sm:px-6 lg:px-8 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-10 backdrop-blur-md bg-opacity-90 dark:bg-opacity-90">
                <div class="flex items-center">
                    <button id="sidebar-toggle"
                        class="md:hidden mr-3 text-gray-500 hover:text-primary focus:outline-none transition-colors">
                        <span class="material-icons-outlined text-2xl">menu</span>
                    </button>
                    <h1 class="text-lg sm:text-2xl font-bold text-gray-900 dark:text-white tracking-tight">Dashboard
                        Admin</h1>
                </div>
                <div class="flex items-center gap-4">
                    <div class="hidden md:flex relative group">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span
                                class="material-icons-outlined text-gray-400 text-lg group-hover:text-primary transition-colors">search</span>
                        </span>
                        <input
                            class="block w-64 pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-gray-50 dark:bg-gray-700 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary sm:text-sm transition-all shadow-sm focus:shadow-md"
                            placeholder="Search..." type="text" />
                    </div>
                    <button
                        class="p-2 rounded-full text-gray-500 hover:text-primary hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-400 transition-colors relative group">
                        <span
                            class="material-icons-outlined transform group-hover:rotate-12 transition-transform duration-300">notifications</span>
                        <span
                            class="absolute top-2 right-2 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white dark:ring-gray-800 animate-pulse"></span>
                    </button>
                    <button
                        class="p-2 rounded-full text-gray-500 hover:text-primary hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-400 transition-colors group">
                        <span
                            class="material-icons-outlined dark:hidden transform group-hover:rotate-45 transition-transform duration-500">dark_mode</span>
                        <span
                            class="material-icons-outlined hidden dark:block transform group-hover:rotate-90 transition-transform duration-500">light_mode</span>
                    </button>
                </div>
            </header>

            @yield('content')

            <footer
                class="mt-auto px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-800">
                © {{ date('Y') }} MiyzaabEdu Admin Panel. All rights reserved.
            </footer>
        </main>
    </div>
    <script>
        const toggleButton = document.querySelector('button[title="Toggle Theme"]') || document.querySelector(
            '.material-icons-outlined:contains("dark_mode")')?.parentNode;

        // Mobile Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('sidebar-open');
            overlay.classList.toggle('hidden');
        }

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', toggleSidebar);
        }

        if (overlay) {
            overlay.addEventListener('click', toggleSidebar);
        }

        // Close sidebar when clicking a link on mobile
        const sidebarLinks = sidebar.querySelectorAll('a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) { // md breakpoint
                    sidebar.classList.remove('sidebar-open');
                    overlay.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>