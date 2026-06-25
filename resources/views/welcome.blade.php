<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Inventaris - Manajemen Barang</title>

    <!-- Preconnect & Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind Config for Inter Font -->
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
<body class="h-full bg-[#fcfcfc] text-[#334155] font-sans antialiased selection:bg-[#6366f1] selection:text-white flex flex-col">

    <!-- Top Navigation (Minimalist) -->
    <header class="w-full px-6 py-6 md:px-12 flex items-center justify-between absolute top-0 left-0">
        <a href="/" class="flex items-center gap-3 group">
            <div class="w-9 h-9 rounded-[8px] bg-[#6366f1] flex items-center justify-center transition-transform duration-300 group-hover:scale-105">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625-.625M3.75 7.5l.625-.625M20.25 7.5V3.75m0 3.75L12 15m8.25-7.5l-8.25 8.25m0 0V12m0 3L3.75 7.5M12 15l-8.25-7.5" />
                </svg>
            </div>
            <span class="text-base font-semibold tracking-tight text-[#334155]">Inventaris</span>
        </a>

        @if (Route::has('login'))
            <nav class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-[#64748b] transition-colors duration-200 hover:text-[#334155]">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-[#64748b] transition-colors duration-200 hover:text-[#334155]">
                        Masuk
                    </a>
                @endauth
            </nav>
        @endif
    </header>

    <!-- Centered Main Content -->
    <main class="flex-1 flex items-center justify-center px-4 py-24 sm:px-6 lg:px-8">
        <!-- Main Card Component -->
        <div class="w-full max-w-2xl bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] p-8 sm:p-12 text-center">

            <!-- Icon/Logo Center -->
            <div class="mx-auto w-16 h-16 bg-[#f8fafc] border border-[#e2e8f0] rounded-[8px] flex items-center justify-center mb-8">
                <svg class="w-8 h-8 text-[#6366f1]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
            </div>

            <!-- Typography & Content -->
            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-[#334155] mb-4">
                Manajemen Barang Modern
            </h1>

            <p class="text-base sm:text-lg text-[#64748b] leading-relaxed mb-10 max-w-xl mx-auto">
                Ruang kerja terpusat untuk memantau kategori, stok, dan nilai inventaris dengan antarmuka yang bersih dan bebas distraksi.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-[#6366f1] text-white text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#4f46e5] shadow-sm">
                            Buka Dashboard
                            <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-[#6366f1] text-white text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#4f46e5] shadow-sm">
                            Masuk ke Sistem
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-white text-[#334155] text-sm font-medium rounded-[6px] border border-[#e2e8f0] transition-all duration-200 hover:bg-[#f8fafc] hover:border-[#cbd5e1]">
                                Buat Akun Baru
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <!-- Features Micro-list -->
            <div class="mt-12 pt-8 border-t border-[#f1f5f9] grid grid-cols-1 sm:grid-cols-3 gap-6 text-sm text-[#64748b]">
                <div class="flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-[#10b981]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                    Real-time Stok
                </div>
                <div class="flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-[#10b981]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                    Data Terpusat
                </div>
                <div class="flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-[#10b981]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                    Notifikasi Limit
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full py-6 text-center absolute bottom-0 left-0">
        <p class="text-xs text-[#94a3b8]">
            &copy; {{ date('Y') }} Sistem Inventaris. All rights reserved.
        </p>
    </footer>

</body>
</html>
