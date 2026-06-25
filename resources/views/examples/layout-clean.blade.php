<!--
    LAYOUT MASTER CLEAN MINIMALISM
    File: resources/views/layouts/app.blade.php

    Layout utama dengan navbar minimalis dan link ke CSS baru
-->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - Sistem Inventaris</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Clean Minimalism CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center" style="width: 100%;">
                <!-- Brand -->
                <a href="{{ route('dashboard') }}" class="navbar-brand">
                    <i class="fas fa-boxes mr-2"></i>
                    Inventaris
                </a>

                <!-- Navigation -->
                <ul class="navbar-nav d-flex" style="list-style: none;">
                    <li>
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                            <i class="fas fa-folder"></i> Kategori
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('items.index') }}" class="nav-link {{ request()->routeIs('items.*') ? 'active' : '' }}">
                            <i class="fas fa-box"></i> Barang
                        </a>
                    </li>
                </ul>

                <!-- User Menu -->
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="container-fluid mt-3">
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="container-fluid mt-3">
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="container-fluid mt-3">
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Terdapat kesalahan:</strong>
            <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="mt-4 mb-5">
        @yield('content')
    </main>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')

    <!-- Auto-dismiss alerts -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto dismiss alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.3s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }, 5000);
        });
    });
    </script>
</body>
</html>
