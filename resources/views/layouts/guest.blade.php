<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistem Inventaris Barang</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Figtree', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: #f8fafc;
            background:
                radial-gradient(circle at top center, rgba(37, 99, 235, .28), transparent 32rem),
                radial-gradient(circle at right bottom, rgba(6, 182, 212, .16), transparent 30rem),
                linear-gradient(135deg, #020617 0%, #0f172a 48%, #172554 100%);
        }

        a { color: inherit; }

        .auth-shell {
            width: min(100% - 2rem, 72rem);
            min-height: 100vh;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            padding: 1.5rem 0;
        }

        .auth-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .auth-brand {
            display: inline-flex;
            align-items: center;
            gap: .75rem;
            text-decoration: none;
        }

        .auth-brand-icon {
            width: 2.75rem;
            height: 2.75rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: .9rem;
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
            box-shadow: 0 18px 36px rgba(37, 99, 235, .28);
        }

        .auth-brand-title {
            display: block;
            font-size: .98rem;
            font-weight: 800;
            letter-spacing: -.02em;
            color: #fff;
        }

        .auth-brand-subtitle {
            display: block;
            margin-top: .12rem;
            font-size: .78rem;
            font-weight: 600;
            color: #94a3b8;
        }

        .auth-home-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 2.5rem;
            padding: .65rem 1rem;
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: .85rem;
            color: #cbd5e1;
            background: rgba(255, 255, 255, .055);
            font-size: .88rem;
            font-weight: 700;
            text-decoration: none;
            backdrop-filter: blur(12px);
            transition: .2s ease;
        }

        .auth-home-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, .1);
            transform: translateY(-1px);
        }

        .auth-main {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 4rem;
            padding: 3rem 0;
        }

        .auth-copy-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .52rem .9rem;
            border-radius: 999px;
            border: 1px solid rgba(96, 165, 250, .24);
            color: #dbeafe;
            background: rgba(59, 130, 246, .11);
            font-size: .88rem;
            font-weight: 800;
            box-shadow: 0 18px 48px rgba(15, 23, 42, .24);
        }

        .auth-copy-dot {
            width: .5rem;
            height: .5rem;
            border-radius: 999px;
            background: #67e8f9;
        }

        .auth-copy-title {
            max-width: 34rem;
            margin: 1.4rem 0 0;
            color: #fff;
            font-size: clamp(2.35rem, 5vw, 3.35rem);
            line-height: 1.04;
            font-weight: 800;
            letter-spacing: -.055em;
        }

        .auth-copy-text {
            max-width: 32rem;
            margin: 1.15rem 0 0;
            color: #cbd5e1;
            font-size: 1rem;
            line-height: 1.8;
        }

        .auth-feature-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
            margin-top: 2rem;
            max-width: 34rem;
        }

        .auth-feature-card {
            padding: 1.25rem;
            border-radius: 1.25rem;
            border: 1px solid rgba(255, 255, 255, .11);
            background: rgba(255, 255, 255, .055);
            backdrop-filter: blur(16px);
            box-shadow: 0 22px 60px rgba(2, 6, 23, .18);
        }

        .auth-feature-number {
            width: 2.65rem;
            height: 2.65rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            border-radius: .9rem;
            color: #bfdbfe;
            background: rgba(59, 130, 246, .14);
            font-weight: 800;
        }

        .auth-feature-card h2 {
            margin: 0;
            color: #fff;
            font-size: 1rem;
            font-weight: 800;
        }

        .auth-feature-card p {
            margin: .5rem 0 0;
            color: #94a3b8;
            font-size: .9rem;
            line-height: 1.6;
        }

        .auth-card-wrap {
            width: 100%;
            max-width: 29rem;
            margin: 0 auto;
            padding: .5rem;
            border-radius: 1.75rem;
            border: 1px solid rgba(255, 255, 255, .11);
            background: rgba(255, 255, 255, .1);
            box-shadow: 0 28px 90px rgba(2, 6, 23, .38);
            backdrop-filter: blur(18px);
        }

        .auth-card {
            padding: 2rem;
            border-radius: 1.35rem;
            border: 1px solid rgba(148, 163, 184, .34);
            background: rgba(2, 6, 23, .84);
        }

        .auth-form-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .auth-form-icon {
            width: 3.5rem;
            height: 3.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            border-radius: 1rem;
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
            box-shadow: 0 18px 36px rgba(37, 99, 235, .28);
        }

        .auth-form-badge {
            display: inline-flex;
            margin-bottom: .65rem;
            padding: .32rem .75rem;
            border-radius: 999px;
            border: 1px solid rgba(96, 165, 250, .24);
            color: #dbeafe;
            background: rgba(59, 130, 246, .11);
            font-size: .72rem;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .auth-form-title {
            margin: 0;
            color: #fff;
            font-size: 1.65rem;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -.035em;
        }

        .auth-form-description {
            margin: .55rem auto 0;
            max-width: 22rem;
            color: #94a3b8;
            font-size: .92rem;
            line-height: 1.65;
        }

        .auth-form {
            display: grid;
            gap: 1.15rem;
        }

        .auth-field label,
        .auth-field .auth-label {
            display: block;
            margin-bottom: .55rem;
            color: #e2e8f0 !important;
            font-size: .88rem;
            font-weight: 800;
        }

        .auth-field input[type='text'],
        .auth-field input[type='email'],
        .auth-field input[type='password'] {
            width: 100%;
            min-height: 3rem;
            padding: .85rem 1rem;
            border: 1px solid rgba(255, 255, 255, .12) !important;
            border-radius: .9rem !important;
            color: #f8fafc !important;
            background: rgba(255, 255, 255, .055) !important;
            outline: none;
            box-shadow: none !important;
            transition: .2s ease;
        }

        .auth-field input::placeholder {
            color: #64748b;
        }

        .auth-field input:focus {
            border-color: rgba(96, 165, 250, .72) !important;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .18) !important;
        }

        .auth-error {
            margin-top: .5rem;
            color: #fca5a5;
            font-size: .84rem;
            font-weight: 600;
        }

        .auth-row-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .auth-link {
            color: #93c5fd;
            font-size: .84rem;
            font-weight: 800;
            text-decoration: none;
            transition: .2s ease;
        }

        .auth-link:hover {
            color: #bfdbfe;
        }

        .auth-remember {
            display: flex;
            align-items: center;
            padding: .85rem 1rem;
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: .9rem;
            color: #cbd5e1;
            background: rgba(255, 255, 255, .035);
            font-size: .9rem;
            font-weight: 700;
        }

        .auth-remember input {
            width: 1rem;
            height: 1rem;
            margin: 0 .7rem 0 0;
            accent-color: #2563eb;
        }

        .auth-submit {
            width: 100%;
            min-height: 3.05rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .55rem;
            padding: .85rem 1.25rem;
            border: 0;
            border-radius: .95rem;
            color: #fff;
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
            box-shadow: 0 18px 36px rgba(37, 99, 235, .28);
            font-size: .95rem;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
        }

        .auth-submit:hover {
            transform: translateY(-1px);
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        }

        .auth-switch {
            color: #94a3b8;
            text-align: center;
            font-size: .92rem;
        }

        .auth-status {
            margin-bottom: 1rem;
            padding: .85rem 1rem;
            border: 1px solid rgba(52, 211, 153, .22);
            border-radius: .9rem;
            color: #bbf7d0;
            background: rgba(52, 211, 153, .1);
            font-size: .9rem;
            font-weight: 700;
        }

        @media (max-width: 920px) {
            .auth-main {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 2rem 0;
            }

            .auth-copy {
                display: none;
            }
        }

        @media (max-width: 520px) {
            .auth-shell { width: min(100% - 1rem, 72rem); padding: 1rem 0; }
            .auth-header { align-items: flex-start; }
            .auth-home-link { padding: .6rem .75rem; font-size: .78rem; }
            .auth-card { padding: 1.25rem; }
        }
    </style>
</head>
<body>
    <div class="auth-shell">
        <header class="auth-header">
            <a href="/" class="auth-brand">
                <span class="auth-brand-icon">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-8.25-4.5L3.75 7.5m16.5 0l-8.25 4.5m8.25-4.5v9l-8.25 4.5m0-9L3.75 7.5m8.25 4.5v9m-8.25-13.5v9l8.25 4.5" />
                    </svg>
                </span>
                <span>
                    <span class="auth-brand-title">Sistem Inventaris</span>
                    <span class="auth-brand-subtitle">Manajemen Barang</span>
                </span>
            </a>

            <a href="/" class="auth-home-link">Kembali ke Beranda</a>
        </header>

        <main class="auth-main">
            <section class="auth-copy">
                <div class="auth-copy-badge">
                    <span class="auth-copy-dot"></span>
                    Akses Sistem Inventaris
                </div>
                <h1 class="auth-copy-title">Masuk untuk mengelola penyimpanan barang dengan lebih rapi.</h1>
                <p class="auth-copy-text">Pantau kategori, stok, nilai inventaris, dan barang yang perlu restock dalam dashboard yang aman dan mudah digunakan.</p>

                <div class="auth-feature-grid">
                    <div class="auth-feature-card">
                        <div class="auth-feature-number">01</div>
                        <h2>Data Terpusat</h2>
                        <p>Kategori dan barang tersimpan dalam satu sistem.</p>
                    </div>
                    <div class="auth-feature-card">
                        <div class="auth-feature-number">02</div>
                        <h2>Stok Terkontrol</h2>
                        <p>Identifikasi barang stok rendah sebelum habis.</p>
                    </div>
                </div>
            </section>

            <section class="auth-card-wrap">
                <div class="auth-card">
                    {{ $slot }}
                </div>
            </section>
        </main>
    </div>
</body>
</html>
