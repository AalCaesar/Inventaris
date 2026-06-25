<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#fcfcfc]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Inventaris') }} - Autentikasi</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-[#334155] h-full flex flex-col selection:bg-[#6366f1] selection:text-white">

    <!-- Minimalist Header -->
    <header class="w-full px-6 py-6 absolute top-0 left-0">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-8 h-8 rounded-[6px] bg-[#6366f1] flex items-center justify-center transition-transform duration-300 group-hover:scale-105">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625-.625M3.75 7.5l.625-.625M20.25 7.5V3.75m0 3.75L12 15m8.25-7.5l-8.25 8.25m0 0V12m0 3L3.75 7.5M12 15l-8.25-7.5" />
                    </svg>
                </div>
                <span class="text-sm font-semibold tracking-tight text-[#334155]">Inventaris</span>
            </a>

            <a href="/" class="text-sm font-medium text-[#64748b] hover:text-[#334155] transition-colors">
                Kembali ke Beranda
            </a>
        </div>
    </header>

    <!-- Main Content Centered -->
    <main class="flex-1 flex flex-col items-center justify-center px-4 sm:px-6 py-20">
        <!-- Render slot (login/register form) -->
        {{ $slot }}
    </main>

    <!-- Minimalist Footer -->
    <footer class="w-full py-6 text-center absolute bottom-0 left-0">
        <p class="text-xs text-[#94a3b8]">
            &copy; {{ date('Y') }} Sistem Inventaris. All rights reserved.
        </p>
    </footer>

</body>
</html>
