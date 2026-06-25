<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --premium-navy: #0f172a;
            --premium-blue: #1e40af;
            --premium-blue-light: #2563eb;
            --premium-bg: #f8fafc;
            --premium-border: #e2e8f0;
            --premium-text: #0f172a;
            --premium-muted: #64748b;
            --premium-shadow: 0 10px 30px rgba(15, 23, 42, .08);
            --premium-shadow-soft: 0 4px 16px rgba(15, 23, 42, .06);
        }

        body {
            background: var(--premium-bg);
            color: var(--premium-text);
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%) !important;
            box-shadow: 10px 0 30px rgba(15, 23, 42, .14);
            transition: transform 0.3s ease-in-out;
        }

        .sidebar .nav-link {
            color: #cbd5e1 !important;
            padding: 0.9rem 1rem;
            border-radius: 0.75rem;
            margin: 0.25rem 0.75rem;
            font-weight: 600;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff !important;
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%) !important;
            box-shadow: 0 10px 24px rgba(37, 99, 235, .28);
            transform: translateX(3px);
        }

        .sidebar .nav-link i {
            margin-right: 0.75rem;
        }

        .sidebar .text-muted {
            color: #94a3b8 !important;
            opacity: 1;
            font-weight: 500;
        }

        .main-content {
            min-height: 100vh;
            background:
                radial-gradient(circle at top right, rgba(37, 99, 235, .16), transparent 34%),
                radial-gradient(circle at bottom left, rgba(14, 165, 233, .10), transparent 30%),
                linear-gradient(180deg, #0f172a 0%, #111827 100%);
            padding-top: 1.25rem;
            color: #e5e7eb;
        }

        .content-wrapper {
            padding: .25rem .75rem 1.5rem;
        }

        .content-wrapper > .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }

        .border-bottom {
            border-color: rgba(148, 163, 184, .18) !important;
        }

        h1, h2, h3, h4, h5, h6 {
            color: #f8fafc;
            letter-spacing: -0.03em;
        }

        .main-content .text-muted,
        .main-content .breadcrumb-item,
        .main-content span,
        .main-content p {
            color: #cbd5e1 !important;
        }

        .breadcrumb a {
            color: #60a5fa;
            font-weight: 700;
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: #e5e7eb !important;
        }

        .card {
            border: 1px solid rgba(148, 163, 184, .20) !important;
            border-radius: 1.15rem !important;
            box-shadow: 0 24px 60px rgba(0, 0, 0, .22) !important;
            overflow: hidden;
            transition: all .25s ease;
            background: rgba(15, 23, 42, .78) !important;
            backdrop-filter: blur(14px);
        }

        .card:hover {
            box-shadow: 0 28px 70px rgba(37, 99, 235, .18) !important;
            transform: translateY(-3px);
        }

        .col-xl-3 .card {
            min-height: 164px;
            border-top: 4px solid transparent !important;
        }

        .col-xl-3:nth-child(1) .card { border-top-color: #2563eb !important; }
        .col-xl-3:nth-child(2) .card { border-top-color: #059669 !important; }
        .col-xl-3:nth-child(3) .card { border-top-color: #06b6d4 !important; }
        .col-xl-3:nth-child(4) .card { border-top-color: #f59e0b !important; }

        .card-header {
            background: rgba(15, 23, 42, .92) !important;
            border-bottom: 1px solid rgba(148, 163, 184, .18) !important;
            padding: 1.15rem 1.4rem;
        }

        .card-header h6,
        .card .fw-bold {
            color: #f8fafc !important;
        }

        .card .h3,
        .card .h5,
        .card .h2,
        .card .mb-0 {
            color: #f8fafc !important;
        }

        .card .text-dark,
        .card .text-gray-800,
        .card .text-gray-700,
        .card .text-body,
        .card .fw-semibold,
        .card .metadata-value {
            color: #e5e7eb !important;
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn {
            border-radius: .75rem !important;
            font-weight: 700 !important;
            letter-spacing: -.01em;
            transition: all .25s ease !important;
        }

        .btn-primary {
            border: 0 !important;
            background: linear-gradient(135deg, var(--premium-blue) 0%, var(--premium-blue-light) 100%) !important;
            box-shadow: 0 10px 22px rgba(37, 99, 235, .26) !important;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(37, 99, 235, .34) !important;
        }

        .btn-warning {
            border: 0 !important;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
            color: #111827 !important;
        }

        .btn-danger {
            border: 0 !important;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
        }

        .btn-outline-warning {
            border: 2px solid #f59e0b !important;
            color: #d97706 !important;
            background: #fff !important;
        }

        .btn-outline-warning:hover {
            color: #fff !important;
            background: #f59e0b !important;
            transform: translateY(-2px);
        }

        label,
        .form-label {
            color: #e5e7eb !important;
            font-weight: 700 !important;
            letter-spacing: -.01em;
        }

        .form-text,
        small.text-muted,
        .card small,
        .card .text-muted,
        .card .text-secondary,
        .card time {
            color: #cbd5e1 !important;
            font-weight: 500;
        }

        .card .text-muted strong,
        .card .text-secondary strong {
            color: #f8fafc !important;
        }

        .card .row.mb-2 strong,
        .card .row.mb-2 small,
        .card .row.mb-2 .text-muted {
            color: #f8fafc !important;
            opacity: 1 !important;
        }

        .card .row.mb-2 small {
            color: #cbd5e1 !important;
            font-weight: 700;
        }

        .form-control,
        .form-select {
            border: 2px solid var(--premium-border) !important;
            border-radius: .85rem !important;
            padding: .85rem 1rem;
            box-shadow: 0 1px 2px rgba(15, 23, 42, .03);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--premium-blue-light) !important;
            box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .12) !important;
        }

        .table {
            margin-bottom: 0;
        }

        .table {
            color: #0f172a !important;
            background: #ffffff !important;
            border-radius: .9rem;
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%) !important;
            color: #ffffff !important;
            text-transform: uppercase;
            font-size: .8rem;
            letter-spacing: .06em;
            box-shadow: inset 0 -1px 0 rgba(255, 255, 255, .12);
        }

        .table thead th,
        .table-light th,
        .table-light td {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%) !important;
            color: #ffffff !important;
            border-color: rgba(255, 255, 255, .12) !important;
            font-weight: 800 !important;
        }

        .table th,
        .table td {
            padding: 1rem !important;
            vertical-align: middle;
            border-color: #dbe3ee !important;
            color: #0f172a !important;
        }

        .table tbody tr {
            background: #ffffff !important;
            transition: background-color .2s ease, transform .2s ease;
        }

        .table tbody tr:nth-child(even) {
            background: #f8fafc !important;
        }

        .table tbody tr:hover {
            background: #eef6ff !important;
        }

        .table code,
        .table a:not(.btn) {
            color: #2563eb !important;
            text-decoration: none;
            font-weight: 700;
        }

        .table .btn,
        .table .btn i,
        .table .btn svg {
            color: #ffffff !important;
        }

        .table .btn-primary {
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%) !important;
            box-shadow: 0 10px 22px rgba(37, 99, 235, .28) !important;
        }

        .table .text-muted,
        .table span,
        .table p,
        .table strong {
            color: #0f172a !important;
        }

        .fa-folder,
        .fa-box,
        .fa-money-bill-wave,
        .fa-exclamation-triangle {
            filter: drop-shadow(0 8px 14px rgba(15, 23, 42, .16));
        }

        .badge {
            border-radius: 999px !important;
            padding: .4rem .85rem !important;
            font-weight: 700 !important;
        }

        .badge.bg-info,
        .badge.bg-secondary {
            background: #e0f2fe !important;
            color: #075985 !important;
        }

        .badge.bg-warning {
            background: #fef3c7 !important;
            color: #92400e !important;
        }

        .mobile-header {
            background: #fff;
            box-shadow: var(--premium-shadow-soft);
        }

        .hamburger-btn {
            padding: 0.5rem;
            font-size: 1.5rem;
            border: none;
            background: none;
            color: var(--premium-navy);
        }

        .mobile-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background-color: rgba(15, 23, 42, .55);
            z-index: 1040;
        }

        .mobile-overlay.show {
            display: block;
        }

        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1050;
                width: 280px;
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                padding-left: 0 !important;
                padding-right: 0 !important;
            }
            .btn {
                min-height: 44px;
                padding: 0.5rem 1rem;
            }
            .nav-link {
                min-height: 44px;
                display: flex;
                align-items: center;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Mobile Header -->
    <div class="mobile-header d-md-none">
        <div class="d-flex justify-content-between align-items-center p-3">
            <button class="hamburger-btn" id="sidebarToggle" aria-label="Toggle Menu">
                <i class="fas fa-bars"></i>
            </button>
            <h5 class="mb-0">Sistem Inventaris</h5>
            <span class="text-muted">{{ Auth::user()->name }}</span>
        </div>
    </div>

    <!-- Mobile Overlay -->
    <div class="mobile-overlay" id="mobileOverlay"></div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block sidebar" id="sidebar">
                <div class="position-sticky pt-3">
                    <!-- Close button for mobile -->
                    <div class="d-md-none text-end px-3 mb-3">
                        <button class="btn btn-sm btn-light" id="sidebarClose" aria-label="Close Menu">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="text-center mb-4">
                        <h4 class="text-white">Sistem Inventaris</h4>
                        <p class="text-muted small">Manajemen Barang</p>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="fas fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                                <i class="fas fa-folder"></i>
                                Kategori
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('items.*') ? 'active' : '' }}" href="{{ route('items.index') }}">
                                <i class="fas fa-box"></i>
                                Barang
                            </a>
                        </li>
                    </ul>

                    <hr class="text-white-50">

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link text-start border-0 bg-transparent w-100">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto px-md-4 main-content">
                <!-- Top Navbar -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('title', 'Dashboard')</h1>
                    <div class="d-flex align-items-center">
                        <span class="me-3">{{ Auth::user()->name }}</span>
                    </div>
                </div>

                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        @yield('breadcrumb')
                    </ol>
                </nav>

                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Terdapat kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Page Content -->
                <div class="content-wrapper">
                    @yield('content')
                </div>

                <!-- Footer -->
                <footer class="pt-5 my-5 text-muted border-top">
                    <div class="text-center">
                        Sistem Inventaris &copy; {{ date('Y') }}
                    </div>
                </footer>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarClose = document.getElementById('sidebarClose');
            const mobileOverlay = document.getElementById('mobileOverlay');

            function openSidebar() {
                sidebar.classList.add('show');
                mobileOverlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.remove('show');
                mobileOverlay.classList.remove('show');
                document.body.style.overflow = '';
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', openSidebar);
            }

            if (sidebarClose) {
                sidebarClose.addEventListener('click', closeSidebar);
            }

            if (mobileOverlay) {
                mobileOverlay.addEventListener('click', closeSidebar);
            }

            // Close sidebar on link click (mobile only)
            if (window.innerWidth < 768) {
                const navLinks = sidebar.querySelectorAll('.nav-link');
                navLinks.forEach(link => {
                    link.addEventListener('click', closeSidebar);
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
