<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MiyzaabEdu - Belajar Islam Lebih Terstruktur</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Playfair+Display:ital,wght@0,600;1,600&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#10B981",
                        "primary-dark": "#059669",
                        "background-light": "#F8FAFC",
                        "background-dark": "#0F172A",
                        "card-light": "#FFFFFF",
                        "card-dark": "#1E293B",
                        "text-light": "#334155",
                        "text-dark": "#E2E8F0",
                        "subtle-light": "#94A3B8",
                        "subtle-dark": "#64748B",
                        "accent-audio": "#E9D5FF",
                        "accent-video": "#FECACA",
                        "accent-article": "#BFDBFE",
                        "accent-quiz": "#FEF08A",
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        display: ['Plus Jakarta Sans', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                        'xl': "1rem",
                        '2xl': "1.5rem",
                        '3xl': "2rem",
                    },
                    boxShadow: {
                        'soft': '0 4px 20px -2px rgba(0, 0, 0, 0.05)',
                        'glow': '0 0 15px rgba(16, 185, 129, 0.3)',
                    },
                    animation: {
                        'blob': 'blob 25s infinite',
                        'gradient': 'gradient 60s ease infinite',
                        'scroll-vertical': 'scrollVertical 30s linear infinite',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(20px, -30px) scale(1.05)' }, // Reduced movement
                            '66%': { transform: 'translate(-15px, 15px) scale(0.95)' }, // Reduced movement
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        },
                        gradient: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                        },
                        scrollVertical: {
                            '0%': { transform: 'translateY(0)' },
                            '100%': { transform: 'translateY(-50%)' },
                        }
                    }
                },
            },
        };
    </script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #475569;
        }

        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-image: linear-gradient(to right, #0F172A, #10B981);
        }

        .dark .text-gradient {
            background-image: linear-gradient(to right, #F8FAFC, #34D399);
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .bg-emerald-gradient {
            background: linear-gradient(-45deg, #ecfdf5, #d1fae5, #e0f2fe, #f0f9ff);
            background-size: 300% 300%;
            animation: gradient 60s ease infinite;
        }

        .dark .bg-emerald-gradient {
            background: linear-gradient(-45deg, #022c22, #064e3b, #0f172a, #111827);
            background-size: 300% 300%;
        }

        details>summary {
            list-style: none;
        }

        details>summary::-webkit-details-marker {
            display: none;
        }

        details[open] summary~* {
            animation: sweep .3s ease-in-out;
        }

        @keyframes sweep {
            0% {
                opacity: 0;
                transform: translateY(-10px)
            }

            100% {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .accordion-icon {
            transition: transform 0.3s ease;
        }

        details[open] .accordion-icon {
            transform: rotate(180deg);
        }
    </style>
</head>

<body
    class="bg-emerald-gradient text-text-light dark:text-text-dark font-sans transition-colors duration-300 min-h-screen flex flex-col relative overflow-x-hidden">
    <div class="fixed inset-0 pointer-events-none overflow-hidden -z-10">
        <div
            class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-300/15 dark:bg-emerald-600/5 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-3xl opacity-30 animate-blob">
        </div>
        <div
            class="absolute top-0 right-1/4 w-96 h-96 bg-teal-300/15 dark:bg-teal-600/5 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-3xl opacity-30 animate-blob animation-delay-4000">
        </div>
        <div
            class="absolute -bottom-32 left-1/3 w-96 h-96 bg-green-300/15 dark:bg-green-600/5 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-3xl opacity-30 animate-blob animation-delay-8000">
        </div>
    </div>
    <header
        class="fixed w-full top-0 z-50 transition-all duration-300 backdrop-blur-md bg-white/10 dark:bg-slate-900/10 border-b border-white/20 dark:border-white/5"
        id="navbar">
        <div class="container mx-auto px-6 h-20 flex items-center justify-between">
            <a class="flex items-center gap-0 text-2xl font-bold tracking-tight text-slate-900 dark:text-white group"
                href="#">
                <span>Miyzaab</span><span
                    class="text-primary group-hover:scale-110 transition-transform duration-300 inline-block">Edu</span>
            </a>
            <div class="flex items-center gap-6">
                <!-- Theme Toggle -->
                <button id="theme-toggle"
                    class="p-2 rounded-full text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors focus:outline-none"
                    aria-label="Toggle Dark Mode">
                    <span class="material-icons-round text-xl block dark:hidden">dark_mode</span>
                    <span class="material-icons-round text-xl hidden dark:block">light_mode</span>
                </button>

                <a class="hidden md:block font-medium text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary transition-colors"
                    href="{{ route('login') }}">Masuk</a>
                <a class="bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-full font-semibold shadow-glow transition-all duration-300 transform hover:-translate-y-0.5 active:scale-95"
                    href="{{ route('register') }}">
                    Daftar
                </a>
            </div>
        </div>
    </header>
    <main class="flex-grow pt-32 pb-20 relative z-10">
        <section class="container mx-auto px-6 text-center max-w-5xl relative">
            <div
                class="absolute top-10 left-0 w-24 h-24 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-full blur-2xl opacity-10 animate-pulse">
            </div>
            <div
                class="absolute bottom-20 right-0 w-40 h-40 bg-gradient-to-tl from-green-400 to-emerald-600 rounded-full blur-3xl opacity-10 animate-pulse delay-700">
            </div>
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-emerald-100 dark:border-emerald-900 mb-8"
                data-aos="fade-down">
                <span class="flex h-2 w-2 relative">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="text-sm font-medium text-emerald-800 dark:text-emerald-300">Platform Belajar Islam
                </span>
            </div>
            <h1 class="text-3xl sm:text-5xl md:text-7xl lg:text-8xl font-extrabold leading-tight mb-6 md:mb-8 tracking-tight"
                data-aos="fade-up">
                Belajar Islam <br />
                <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500 dark:from-emerald-400 dark:to-teal-300">
                    Melalui digital</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-600 dark:text-slate-300 mb-12 max-w-2xl mx-auto leading-relaxed"
                data-aos="fade-up" data-aos-delay="100">
                Jelajahi samudra ilmu dengan metode modern. Kurikulum terstruktur, audio learning jernih, dan kuis
                interaktif untuk menemani perjalanan belajarmu setiap hari.
            </p>
            <div class="flex flex-col sm:flex-row gap-5 justify-center items-center" data-aos="fade-up"
                data-aos-delay="200">
                <a class="group relative px-8 py-4 bg-emerald-600 text-white rounded-full font-bold text-lg shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 transition-all duration-300 overflow-hidden"
                    href="{{ route('register') }}">
                    <div
                        class="absolute inset-0 w-full h-full bg-gradient-to-r from-emerald-500 to-teal-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <span class="relative flex items-center gap-2">
                        Mulai Belajar Sekarang
                        <span
                            class="material-icons-round group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </span>
                </a>
            </div>
            <div class="absolute top-1/4 -left-12 hidden lg:block animate-float" style="animation-delay: 0s;">
                <div
                    class="bg-white dark:bg-slate-800 p-4 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 transform -rotate-6">
                    <span class="material-icons-round text-4xl text-emerald-500">menu_book</span>
                </div>
            </div>
            <div class="absolute bottom-1/4 -right-8 hidden lg:block animate-float" style="animation-delay: 2s;">
                <div
                    class="bg-white dark:bg-slate-800 p-4 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 transform rotate-6">
                    <span class="material-icons-round text-4xl text-teal-500">headphones</span>
                </div>
            </div>
        </section>
        <section class="container mx-auto px-4 sm:px-6 mt-16 sm:mt-32 mb-12 sm:mb-20">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-16 items-center">
                <div class="space-y-8" data-aos="fade-right">
                    <div
                        class="inline-block px-4 py-1.5 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-sm font-bold uppercase tracking-wider">
                        Tentang Kami
                    </div>
                    <h2
                        class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white leading-tight">
                        Membangun Generasi <br />
                        <span class="text-emerald-500">Berilmu &amp; Beradab</span>
                    </h2>
                    <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed">
                        MiyzaabEdu hadir sebagai jembatan ilmu yang menghubungkan keilmuan Islam dengan
                        kemudahan teknologi masa kini.
                    </p>
                    <div class="grid gap-6 mt-4">
                        <div
                            class="flex gap-4 items-start p-4 rounded-xl hover:bg-white/40 dark:hover:bg-slate-800/40 transition-colors duration-300">
                            <div
                                class="w-12 h-12 rounded-lg bg-teal-100 dark:bg-teal-900/30 flex items-center justify-center shrink-0 text-teal-600 dark:text-teal-400">
                                <span class="material-icons-round text-2xl">visibility</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl text-slate-900 dark:text-white mb-1">Visi Kami</h3>
                                <p class="text-slate-600 dark:text-slate-400 text-sm">Menjadi platform edukasi Islam
                                    terdepan yang berkiblat kepada Al-Qur'an dan As-Sunnah.</p>
                            </div>
                        </div>
                        <div
                            class="flex gap-4 items-start p-4 rounded-xl hover:bg-white/40 dark:hover:bg-slate-800/40 transition-colors duration-300">
                            <div
                                class="w-12 h-12 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center shrink-0 text-emerald-600 dark:text-emerald-400">
                                <span class="material-icons-round text-2xl">rocket_launch</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl text-slate-900 dark:text-white mb-1">Misi Kami</h3>
                                <p class="text-slate-600 dark:text-slate-400 text-sm">Menyajikan konten belajar Islam
                                    yang ilmiah, mudah diakses, serta relevan dengan tantangan zaman.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative" data-aos="fade-left">
                    <div
                        class="absolute inset-0 bg-gradient-to-tr from-emerald-500/20 to-teal-500/20 rounded-3xl transform rotate-3">
                    </div>
                    <div
                        class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl relative border border-slate-100 dark:border-slate-700 overflow-hidden h-[350px] sm:h-[500px]">
                        <div
                            class="absolute top-0 left-0 w-full h-24 bg-gradient-to-b from-white via-white/80 to-transparent dark:from-slate-800 dark:via-slate-800/80 z-10 flex items-center px-8">
                            <h3 class="font-bold text-xl text-slate-900 dark:text-white">Fitur Unggulan &amp; Benefits
                            </h3>
                        </div>
                        <div class="animate-scroll-vertical w-full">
                            <div class="space-y-4 px-6 pt-24 pb-4">
                                <div
                                    class="bg-slate-50 dark:bg-slate-700/50 p-6 rounded-2xl hover:-translate-y-1 transition-transform duration-300 border border-slate-100 dark:border-slate-600">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="bg-emerald-100 dark:bg-emerald-900/50 p-2 rounded-lg">
                                            <span
                                                class="material-icons-round text-emerald-600 dark:text-emerald-400">school</span>
                                        </div>
                                        <span class="font-bold text-slate-800 dark:text-white">Kurikulum
                                            Terstruktur</span>
                                    </div>
                                    <p class="text-sm text-slate-600 dark:text-slate-300">Dimulai dari kitab-kitab dasar
                                        yang disarankan oleh para Ulama.</p>
                                </div>
                                <div
                                    class="bg-slate-50 dark:bg-slate-700/50 p-6 rounded-2xl hover:-translate-y-1 transition-transform duration-300 border border-slate-100 dark:border-slate-600">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="bg-teal-100 dark:bg-teal-900/50 p-2 rounded-lg">
                                            <span
                                                class="material-icons-round text-teal-600 dark:text-teal-400">verified_user</span>
                                        </div>
                                        <span class="font-bold text-slate-800 dark:text-white">Guru Terpercaya</span>
                                    </div>
                                    <p class="text-sm text-slate-600 dark:text-slate-300">Pematri yang kompeten di
                                        dalam bidangnya serta lulusan sekolah terbaik.</p>
                                </div>
                                <div
                                    class="bg-slate-50 dark:bg-slate-700/50 p-6 rounded-2xl hover:-translate-y-1 transition-transform duration-300 border border-slate-100 dark:border-slate-600">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="bg-blue-100 dark:bg-blue-900/50 p-2 rounded-lg">
                                            <span
                                                class="material-icons-round text-blue-600 dark:text-blue-400">schedule</span>
                                        </div>
                                        <span class="font-bold text-slate-800 dark:text-white">Fleksibel 24 Jam</span>
                                    </div>
                                    <p class="text-sm text-slate-600 dark:text-slate-300">Fitur yang membantu anda untuk
                                        belajar kapapun Anda mau.</p>
                                </div>
                                <div
                                    class="bg-slate-50 dark:bg-slate-700/50 p-6 rounded-2xl hover:-translate-y-1 transition-transform duration-300 border border-slate-100 dark:border-slate-600">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="bg-purple-100 dark:bg-purple-900/50 p-2 rounded-lg">
                                            <span
                                                class="material-icons-round text-purple-600 dark:text-purple-400">groups</span>
                                        </div>
                                        <span class="font-bold text-slate-800 dark:text-white">Komunitas Aktif</span>
                                    </div>
                                    <p class="text-sm text-slate-600 dark:text-slate-300">Saling bertukar fikiran dengan
                                        teman-teman lainnya.</p>
                                </div>
                            </div>
                            <div class="space-y-4 px-6 pt-4 pb-24">
                                <div
                                    class="bg-slate-50 dark:bg-slate-700/50 p-6 rounded-2xl hover:-translate-y-1 transition-transform duration-300 border border-slate-100 dark:border-slate-600">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="bg-emerald-100 dark:bg-emerald-900/50 p-2 rounded-lg">
                                            <span
                                                class="material-icons-round text-emerald-600 dark:text-emerald-400">school</span>
                                        </div>
                                        <span class="font-bold text-slate-800 dark:text-white">Kurikulum
                                            Terstruktur</span>
                                    </div>
                                    <p class="text-sm text-slate-600 dark:text-slate-300">Dimulai dari kitab-kitab dasar
                                        yang disarankan oleh para Ulama.</p>
                                </div>
                                <div
                                    class="bg-slate-50 dark:bg-slate-700/50 p-6 rounded-2xl hover:-translate-y-1 transition-transform duration-300 border border-slate-100 dark:border-slate-600">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="bg-teal-100 dark:bg-teal-900/50 p-2 rounded-lg">
                                            <span
                                                class="material-icons-round text-teal-600 dark:text-teal-400">verified_user</span>
                                        </div>
                                        <span class="font-bold text-slate-800 dark:text-white">Guru Terpercaya</span>
                                    </div>
                                    <p class="text-sm text-slate-600 dark:text-slate-300">Pematri yang kompeten di dalam
                                        bidangnya serta lulusan sekolah terbaik</p>
                                </div>
                                <div
                                    class="bg-slate-50 dark:bg-slate-700/50 p-6 rounded-2xl hover:-translate-y-1 transition-transform duration-300 border border-slate-100 dark:border-slate-600">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="bg-blue-100 dark:bg-blue-900/50 p-2 rounded-lg">
                                            <span
                                                class="material-icons-round text-blue-600 dark:text-blue-400">schedule</span>
                                        </div>
                                        <span class="font-bold text-slate-800 dark:text-white">Fleksibel 24 Jam</span>
                                    </div>
                                    <p class="text-sm text-slate-600 dark:text-slate-300">Fitur yang membantu anda untuk
                                        belajar kapapun Anda mau.</p>
                                </div>
                                <div
                                    class="bg-slate-50 dark:bg-slate-700/50 p-6 rounded-2xl hover:-translate-y-1 transition-transform duration-300 border border-slate-100 dark:border-slate-600">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="bg-purple-100 dark:bg-purple-900/50 p-2 rounded-lg">
                                            <span
                                                class="material-icons-round text-purple-600 dark:text-purple-400">groups</span>
                                        </div>
                                        <span class="font-bold text-slate-800 dark:text-white">Komunitas Aktif</span>
                                    </div>
                                    <p class="text-sm text-slate-600 dark:text-slate-300">Saling bertukar fikiran dengan
                                        teman-teman lainnya.</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-white via-white/80 to-transparent dark:from-slate-800 dark:via-slate-800/80 z-10 pointer-events-none">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="container mx-auto px-6 mt-24 mb-20" data-aos="zoom-in-up">
            <div
                class="relative bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl p-8 md:p-12 overflow-hidden shadow-2xl shadow-emerald-500/20 text-white transform hover:scale-[1.01] transition-transform duration-500 border border-white/10">
                <div class="absolute top-0 right-0 opacity-10 pointer-events-none mix-blend-overlay">
                    <svg height="400" viewBox="0 0 200 200" width="400" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-5.3C93.5,8.6,82.2,21.4,70.6,31.4C59,41.4,47.1,48.6,35.4,55.8C23.7,63,12.2,70.2,-0.9,71.7C-14,73.3,-26.6,69.1,-37.6,61.4C-48.6,53.7,-58,42.5,-65.4,29.9C-72.8,17.3,-78.2,3.3,-76.3,-9.6C-74.4,-22.5,-65.2,-34.3,-54.2,-42.6C-43.2,-50.9,-30.4,-55.7,-17.8,-63.9C-5.2,-72.1,7.2,-83.7,20.5,-85.8C33.8,-87.9,47.9,-80.5,44.7,-76.4Z"
                            fill="#FFFFFF" transform="translate(100 100)"></path>
                    </svg>
                </div>
                <div
                    class="relative z-10 flex flex-col items-start max-w-3xl backdrop-blur-sm bg-white/5 p-6 rounded-2xl border border-white/10">
                    <div
                        class="flex items-center gap-2 mb-6 text-emerald-100 uppercase tracking-widest text-xs font-bold bg-white/10 px-3 py-1 rounded-full w-max">
                        <span class="material-icons-round text-sm">bolt</span>
                        Mutiara Hari Ini
                    </div>

                    <!-- Slider Container -->
                    <div id="quote-slider" class="w-full relative min-h-[180px] md:min-h-[150px]">
                        <!-- Slide 1 -->
                        <div class="quote-slide absolute inset-0 transition-opacity duration-700 opacity-100">
                            <blockquote
                                class="font-serif text-2xl md:text-3xl lg:text-4xl leading-relaxed italic mb-8 drop-shadow-sm">
                                "Ilmu itu lebih baik daripada harta. Ilmu menjaga engkau dan engkau menjaga harta."
                            </blockquote>
                            <cite class="not-italic font-semibold text-emerald-50 text-lg flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-white font-bold">
                                    A</div>
                                Ali bin Abi Thalib
                            </cite>
                        </div>

                        <!-- Slide 2 -->
                        <div class="quote-slide absolute inset-0 transition-opacity duration-700 opacity-0">
                            <blockquote
                                class="font-serif text-2xl md:text-3xl lg:text-4xl leading-relaxed italic mb-8 drop-shadow-sm">
                                "Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mudahkan baginya jalan menuju
                                surga."
                            </blockquote>
                            <cite class="not-italic font-semibold text-emerald-50 text-lg flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-white font-bold">
                                    ﷺ</div>
                                Rasulullah ﷺ (HR. Muslim)
                            </cite>
                        </div>

                        <!-- Slide 3 -->
                        <div class="quote-slide absolute inset-0 transition-opacity duration-700 opacity-0">
                            <blockquote
                                class="font-serif text-2xl md:text-3xl lg:text-4xl leading-relaxed italic mb-8 drop-shadow-sm">
                                "Sampaikanlah dariku walau hanya satu ayat."
                            </blockquote>
                            <cite class="not-italic font-semibold text-emerald-50 text-lg flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-white font-bold">
                                    ﷺ</div>
                                Rasulullah ﷺ (HR. Bukhari)
                            </cite>
                        </div>
                    </div>

                    <!-- Dots Indicator -->
                    <div class="flex items-center justify-between w-full pt-4 border-t border-white/10 mt-4">
                        <div class="text-sm text-emerald-100/70"> </div>
                        <div class="flex gap-2" id="quote-dots">
                            <button onclick="goToSlide(0)"
                                class="quote-dot w-2.5 h-2.5 rounded-full bg-white opacity-100 shadow-[0_0_10px_rgba(255,255,255,0.8)] transition-opacity"></button>
                            <button onclick="goToSlide(1)"
                                class="quote-dot w-2.5 h-2.5 rounded-full bg-white opacity-40 hover:opacity-100 transition-opacity cursor-pointer"></button>
                            <button onclick="goToSlide(2)"
                                class="quote-dot w-2.5 h-2.5 rounded-full bg-white opacity-40 hover:opacity-100 transition-opacity cursor-pointer"></button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                let currentSlide = 0;
                const slides = document.querySelectorAll('.quote-slide');
                const dots = document.querySelectorAll('.quote-dot');

                function goToSlide(index) {
                    slides[currentSlide].classList.remove('opacity-100');
                    slides[currentSlide].classList.add('opacity-0');
                    dots[currentSlide].classList.remove('opacity-100', 'shadow-[0_0_10px_rgba(255,255,255,0.8)]');
                    dots[currentSlide].classList.add('opacity-40');

                    currentSlide = index;

                    slides[currentSlide].classList.remove('opacity-0');
                    slides[currentSlide].classList.add('opacity-100');
                    dots[currentSlide].classList.remove('opacity-40');
                    dots[currentSlide].classList.add('opacity-100', 'shadow-[0_0_10px_rgba(255,255,255,0.8)]');
                }

                function nextSlide() {
                    goToSlide((currentSlide + 1) % slides.length);
                }

                // Auto-slide every 5 seconds
                setInterval(nextSlide, 5000);
            </script>
        </section>
        <section class="container mx-auto px-4 sm:px-6 mb-16 sm:mb-24">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 mb-8 sm:mb-10"
                data-aos="fade-right">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-slate-800 dark:text-white">Fitur Unggulan
                </h2>
                <a class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 font-medium text-sm md:text-base transition-colors flex items-center gap-1 group bg-emerald-50 dark:bg-emerald-900/30 px-4 py-2 rounded-lg"
                    href="#">
                    Lihat Semua
                    <span
                        class="material-icons-round text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
                <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-md rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-soft hover:shadow-xl dark:shadow-none border border-white/50 dark:border-white/5 transition-all duration-300 hover:-translate-y-2"
                    data-aos="fade-up" data-aos-delay="0">
                    <div
                        class="w-10 h-10 sm:w-14 sm:h-14 rounded-lg sm:rounded-xl bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-300 flex items-center justify-center mb-3 sm:mb-5 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <span class="material-icons-round text-xl sm:text-3xl">mic</span>
                    </div>
                    <h3 class="text-base sm:text-xl font-bold mb-1 sm:mb-2 text-slate-800 dark:text-white">Audio</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-xs sm:text-sm leading-relaxed hidden sm:block">
                        Kajian audio terstruktur yang bisa didengarkan kapanpun.
                    </p>
                </div>
                <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-md rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-soft hover:shadow-xl dark:shadow-none border border-white/50 dark:border-white/5 transition-all duration-300 hover:-translate-y-2"
                    data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="w-10 h-10 sm:w-14 sm:h-14 rounded-lg sm:rounded-xl bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-300 flex items-center justify-center mb-3 sm:mb-5 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <span class="material-icons-round text-xl sm:text-3xl">play_circle_filled</span>
                    </div>
                    <h3 class="text-base sm:text-xl font-bold mb-1 sm:mb-2 text-slate-800 dark:text-white">Video</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-xs sm:text-sm leading-relaxed hidden sm:block">
                        Tonton video kajian visual yang menarik dan interaktif.
                    </p>
                </div>
                <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-md rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-soft hover:shadow-xl dark:shadow-none border border-white/50 dark:border-white/5 transition-all duration-300 hover:-translate-y-2"
                    data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="w-10 h-10 sm:w-14 sm:h-14 rounded-lg sm:rounded-xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 flex items-center justify-center mb-3 sm:mb-5 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <span class="material-icons-round text-xl sm:text-3xl">article</span>
                    </div>
                    <h3 class="text-base sm:text-xl font-bold mb-1 sm:mb-2 text-slate-800 dark:text-white">Artikel</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-xs sm:text-sm leading-relaxed hidden sm:block">
                        Baca tulisan ilmiah yang ringkas dan mudah dipahami.
                    </p>
                </div>
                <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-md rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-soft hover:shadow-xl dark:shadow-none border border-white/50 dark:border-white/5 transition-all duration-300 hover:-translate-y-2"
                    data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="w-10 h-10 sm:w-14 sm:h-14 rounded-lg sm:rounded-xl bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-300 flex items-center justify-center mb-3 sm:mb-5 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <span class="material-icons-round text-xl sm:text-3xl">quiz</span>
                    </div>
                    <h3 class="text-base sm:text-xl font-bold mb-1 sm:mb-2 text-slate-800 dark:text-white">Kuis</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-xs sm:text-sm leading-relaxed hidden sm:block">
                        Uji pemahamanmu dengan kuis menarik di setiap sesi.
                    </p>
                </div>
            </div>
        </section>
        <section class="container mx-auto px-6 mb-24 max-w-4xl" data-aos="fade-up">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-white mb-4">Pertanyaan Umum</h2>
                <p class="text-slate-600 dark:text-slate-400">Temukan jawaban cepat untuk pertanyaan yang sering
                    diajukan.</p>
            </div>
            <div class="space-y-4">
                <details
                    class="group bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
                    <summary
                        class="flex justify-between items-center cursor-pointer p-6 list-none hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                        <span class="font-bold text-lg text-slate-800 dark:text-white">Apakah semua materi
                            gratis?</span>
                        <span
                            class="accordion-icon material-icons-round text-emerald-500 bg-emerald-100 dark:bg-emerald-900/30 rounded-full p-1">expand_more</span>
                    </summary>
                    <div
                        class="px-6 pb-6 text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-100 dark:border-slate-700/50 pt-4">
                        Sebagian besar materi dasar kami sediakan secara gratis tanpa berbayar.
                    </div>
                </details>
                <details
                    class="group bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
                    <summary
                        class="flex justify-between items-center cursor-pointer p-6 list-none hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                        <span class="font-bold text-lg text-slate-800 dark:text-white">Bagaimana cara mengikuti
                            kuis?</span>
                        <span
                            class="accordion-icon material-icons-round text-emerald-500 bg-emerald-100 dark:bg-emerald-900/30 rounded-full p-1">expand_more</span>
                    </summary>
                    <div
                        class="px-6 pb-6 text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-100 dark:border-slate-700/50 pt-4">
                        Setiap selesai menyimak materi, tombol kuis akan aktif secara otomatis. Anda dapat mengikutinya
                        langsung dari halaman materi tersebut untuk menguji pemahaman.
                    </div>
                </details>
                <details
                    class="group bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
                    <summary
                        class="flex justify-between items-center cursor-pointer p-6 list-none hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                        <span class="font-bold text-lg text-slate-800 dark:text-white">Apakah bisa diakses
                            offline?</span>
                        <span
                            class="accordion-icon material-icons-round text-emerald-500 bg-emerald-100 dark:bg-emerald-900/30 rounded-full p-1">expand_more</span>
                    </summary>
                    <div
                        class="px-6 pb-6 text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-100 dark:border-slate-700/50 pt-4">
                        Saat ini fitur offline (download materi) hanya tersedia pada aplikasi mobile MiyzaabEdu. Untuk
                        versi web, koneksi internet tetap diperlukan.
                    </div>
                </details>
                <details
                    class="group bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
                    <summary
                        class="flex justify-between items-center cursor-pointer p-6 list-none hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                        <span class="font-bold text-lg text-slate-800 dark:text-white">Metode apa yang digunakan?</span>
                        <span
                            class="accordion-icon material-icons-round text-emerald-500 bg-emerald-100 dark:bg-emerald-900/30 rounded-full p-1">expand_more</span>
                    </summary>
                    <div
                        class="px-6 pb-6 text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-100 dark:border-slate-700/50 pt-4">
                        Kami menggunakan metode *blended learning* yang menggabungkan kajian kitab
                        dengan pendekatan modern yang interaktif dan mudah dipahami.
                    </div>
                </details>
            </div>
        </section>
        <section class="container mx-auto px-6 mb-12">
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 dark:from-slate-800 dark:to-slate-900/90 backdrop-blur-lg rounded-3xl p-8 md:p-12 relative overflow-hidden border border-white/5 shadow-2xl"
                data-aos="fade-up">
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl">
                </div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-64 h-64 bg-teal-500/10 rounded-full blur-3xl">
                </div>
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="text-left max-w-xl">
                        <h2 class="text-3xl font-bold text-white mb-3">Ada Pertanyaan Lain?</h2>
                        <p class="text-slate-300 text-lg leading-relaxed">Kirim Pesan Anda melalui WhatsApp kami, Tim
                            kami siap membantu menjawab pertanyaan seputar materi atau teknis platform.</p>
                    </div>
                    <a class="flex items-center gap-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-4 px-8 rounded-full transition-all duration-300 shadow-lg shadow-emerald-500/25 transform hover:-translate-y-1 group"
                        href="https://wa.me/085161120715" target="_blank">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z">
                            </path>
                        </svg>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </section>
    </main>
    <footer
        class="border-t border-slate-200/50 dark:border-slate-800 py-10 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md transition-colors duration-300">
        <div class="container mx-auto px-6 text-center">
            <div
                class="flex items-center justify-center gap-0 text-2xl font-bold tracking-tight text-slate-900 dark:text-white mb-6">
                <span>Miyzaab</span><span class="text-emerald-500">Edu</span>
            </div>
            <p class="text-slate-500 dark:text-slate-400 text-sm">
                © 2026 MiyzaabEdu. All rights reserved.
            </p>
        </div>
    </footer>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS Animation
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-cubic',
        });
        // Dark Mode Logic
        const themeToggleBtn = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;
        // Check local storage or system preference
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            htmlElement.classList.add('dark');
        } else {
            htmlElement.classList.remove('dark');
        }
        // Only add listener if the button exists (it was removed in this edit but kept logic for robustness if re-added)
        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', () => {
                htmlElement.classList.toggle('dark');
                if (htmlElement.classList.contains('dark')) {
                    localStorage.theme = 'dark';
                } else {
                    localStorage.theme = 'light';
                }
            });
        }
        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 20) {
                navbar.classList.add('shadow-sm');
                navbar.classList.add('bg-white/90');
                navbar.classList.add('dark:bg-slate-900/90');
                navbar.classList.remove('bg-white/10');
                navbar.classList.remove('dark:bg-slate-900/10');
            } else {
                navbar.classList.remove('shadow-sm');
                navbar.classList.remove('bg-white/90');
                navbar.classList.remove('dark:bg-slate-900/90');
                navbar.classList.add('bg-white/10');
                navbar.classList.add('dark:bg-slate-900/10');
            }
        });
    </script>
</body>

</html>