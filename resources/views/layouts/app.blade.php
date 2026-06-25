<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#fcfcfc]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Inventaris') }} - @yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
<body class="font-sans antialiased text-[#334155] h-full flex overflow-hidden selection:bg-[#6366f1] selection:text-white">

    <!-- Mobile sidebar backdrop -->
    <div id="sidebar-backdrop" class="fixed inset-0 z-40 bg-gray-900/50 hidden transition-opacity lg:hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-[#e2e8f0] transform -translate-x-full lg:translate-x-0 lg:static lg:flex lg:flex-col transition-transform duration-300 ease-in-out">
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between h-16 px-6 border-b border-[#e2e8f0]">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-[6px] bg-[#6366f1] flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625-.625M3.75 7.5l.625-.625M20.25 7.5V3.75m0 3.75L12 15m8.25-7.5l-8.25 8.25m0 0V12m0 3L3.75 7.5M12 15l-8.25-7.5" /></svg>
                </div>
                <span class="text-base font-semibold text-[#334155]">Inventaris</span>
            </a>
            <!-- Mobile Close Button -->
            <button id="close-sidebar" class="lg:hidden text-[#64748b] hover:text-[#334155] focus:outline-none">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Sidebar Navigation -->
        <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-[6px] text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#f1f5f9] text-[#6366f1]' : 'text-[#64748b] hover:bg-[#f8fafc] hover:text-[#334155]' }}">
                <i class="fas fa-home w-5 text-center {{ request()->routeIs('dashboard') ? 'text-[#6366f1]' : 'text-[#94a3b8]' }}"></i>
                Dashboard
            </a>
            <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-[6px] text-sm font-medium transition-colors {{ request()->routeIs('categories.*') ? 'bg-[#f1f5f9] text-[#6366f1]' : 'text-[#64748b] hover:bg-[#f8fafc] hover:text-[#334155]' }}">
                <i class="fas fa-folder w-5 text-center {{ request()->routeIs('categories.*') ? 'text-[#6366f1]' : 'text-[#94a3b8]' }}"></i>
                Kategori
            </a>
            <a href="{{ route('items.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-[6px] text-sm font-medium transition-colors {{ request()->routeIs('items.*') ? 'bg-[#f1f5f9] text-[#6366f1]' : 'text-[#64748b] hover:bg-[#f8fafc] hover:text-[#334155]' }}">
                <i class="fas fa-box w-5 text-center {{ request()->routeIs('items.*') ? 'text-[#6366f1]' : 'text-[#94a3b8]' }}"></i>
                Barang
            </a>
        </div>

        <!-- Sidebar Footer (Logout) -->
        <div class="p-4 border-t border-[#e2e8f0]">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-[6px] text-sm font-medium text-[#ef4444] hover:bg-red-50 transition-colors">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-[#fcfcfc]">

        <!-- Top Header -->
        <header class="h-16 flex items-center justify-between px-4 sm:px-6 lg:px-8 bg-white border-b border-[#e2e8f0] z-30 shadow-sm">
            <div class="flex items-center">
                <button id="open-sidebar" class="lg:hidden text-[#64748b] hover:text-[#334155] focus:outline-none mr-4">
                    <i class="fas fa-bars text-lg"></i>
                </button>
                <h1 class="text-xl font-semibold text-[#334155]">@yield('title', 'Dashboard')</h1>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-[#f1f5f9] flex items-center justify-center text-[#64748b]">
                        <i class="fas fa-user text-sm"></i>
                    </div>
                    <span class="text-sm font-medium text-[#334155] hidden sm:block">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </header>

        <!-- Main Scrollable Area -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-[8px] shadow-sm">
                    <i class="fas fa-check-circle text-emerald-500"></i>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-[8px] shadow-sm">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-[8px] shadow-sm">
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fas fa-exclamation-triangle text-red-500"></i>
                        <strong class="text-sm font-semibold">Terdapat kesalahan:</strong>
                    </div>
                    <ul class="list-disc list-inside text-sm ml-7 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Content Injected Here -->
            @yield('content')

            <!-- Footer inside main content -->
            <footer class="mt-12 border-t border-[#e2e8f0] pt-6 pb-2 text-center">
                <p class="text-xs text-[#94a3b8]">&copy; {{ date('Y') }} Sistem Inventaris. All rights reserved.</p>
            </footer>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Mobile Sidebar Toggle Logic
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const openBtn = document.getElementById('open-sidebar');
            const closeBtn = document.getElementById('close-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Prevent background scrolling
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
                document.body.style.overflow = '';
            }

            if(openBtn) openBtn.addEventListener('click', openSidebar);
            if(closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if(backdrop) backdrop.addEventListener('click', closeSidebar);
        });
    </script>

    @stack('scripts')
</body>
</html>
