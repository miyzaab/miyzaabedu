<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Miyzaab Edu') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        @keyframes float-delayed {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float-delayed 8s ease-in-out infinite;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .animation-delay-200 {
            animation-delay: 0.2s;
        }

        .animation-delay-400 {
            animation-delay: 0.4s;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900 bg-teal-50">
    <div class="min-h-screen flex justify-center bg-gradient-to-br from-teal-500 to-emerald-600">
        <!-- Mobile Container -->
        <div
            class="w-full max-w-md bg-white min-h-screen shadow-2xl relative flex flex-col justify-center py-12 px-6 sm:px-8">

            <div class="text-center mb-8">
                <a href="/" class="inline-block">
                    <span class="text-4xl font-bold text-gray-800 tracking-tight">Miyzaab<span
                            class="text-emerald-600">Edu</span></span>
                </a>
                <p class="mt-2 text-sm text-gray-600">Platform Edukasi Islam Modern</p>
            </div>

            <div class="w-full">
                {{ $slot }}
            </div>

            <div class="mt-8 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} Miyzaab Edu. All rights reserved.
            </div>

            <!-- Decor -->
            <div class="absolute top-0 left-0 w-32 h-32 bg-emerald-50 rounded-br-full -z-10 opacity-50"></div>
            <div class="absolute bottom-0 right-0 w-32 h-32 bg-teal-50 rounded-tl-full -z-10 opacity-50"></div>
        </div>
    </div>
</body>

</html>