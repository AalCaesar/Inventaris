<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistem Inventaris Barang</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-950 text-slate-100">
    <div class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950"></div>
        <div class="absolute left-1/2 top-0 h-96 w-96 -translate-x-1/2 rounded-full bg-blue-500/20 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 h-96 w-96 rounded-full bg-cyan-400/10 blur-3xl"></div>

        <div class="relative mx-auto flex min-h-screen w-full max-w-7xl flex-col px-6 py-6 lg:px-8">
            <header class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-4 py-3 shadow-2xl shadow-slate-950/30 backdrop-blur md:px-6">
                <a href="/" class="flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600 shadow-lg shadow-blue-600/30">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-8.25-4.5L3.75 7.5m16.5 0l-8.25 4.5m8.25-4.5v9l-8.25 4.5m0-9L3.75 7.5m8.25 4.5v9m-8.25-13.5v9l8.25 4.5" />
                        </svg>
                    </span>
                    <span>
                        <span class="block text-sm font-bold tracking-wide text-white md:text-base">Sistem Inventaris</span>
                        <span class="block text-xs font-medium text-slate-400">Manajemen Barang</span>
                    </span>
                </a>

                @if (Route::has('login'))
                    <nav class="flex items-center gap-2 text-sm font-semibold">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="rounded-xl bg-white px-4 py-2 text-slate-950 transition hover:bg-blue-50">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="rounded-xl px-4 py-2 text-slate-200 transition hover:bg-white/10 hover:text-white">
                                Masuk
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="hidden rounded-xl bg-white px-4 py-2 text-slate-950 transition hover:bg-blue-50 sm:inline-flex">
                                    Daftar
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            <main class="grid flex-1 items-center gap-12 py-14 lg:grid-cols-[1.02fr_0.98fr] lg:py-20">
                <section class="max-w-3xl">
                    <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-blue-400/20 bg-blue-400/10 px-4 py-2 text-sm font-semibold text-blue-100 shadow-lg shadow-blue-950/20">
                        <span class="h-2 w-2 rounded-full bg-cyan-300"></span>
                        Penyimpanan dan Manajemen Barang
                    </div>

                    <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                        Kelola Inventaris Barang Lebih Rapi dan Terukur
                    </h1>

                    <p class="mt-6 max-w-2xl text-base leading-8 text-slate-300 sm:text-lg">
                        Pantau kategori, stok, nilai inventaris, dan barang yang perlu restock dalam satu dashboard web yang ringkas. Cocok untuk membantu pencatatan penyimpanan barang agar lebih cepat, akurat, dan mudah dipantau.
                    </p>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-bold text-white shadow-xl shadow-blue-600/25 transition hover:-translate-y-0.5 hover:bg-blue-500">
                                    Buka Dashboard
                                    <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-bold text-white shadow-xl shadow-blue-600/25 transition hover:-translate-y-0.5 hover:bg-blue-500">
                                    Masuk Dashboard
                                    <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-6 py-3 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:bg-white/10">
                                        Daftar Akun
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>

                    <div class="mt-10 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                            <div class="text-2xl font-extrabold text-white">Real-time</div>
                            <p class="mt-1 text-sm text-slate-400">Pantau status stok barang.</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                            <div class="text-2xl font-extrabold text-white">Rapi</div>
                            <p class="mt-1 text-sm text-slate-400">Kelompokkan berdasarkan kategori.</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                            <div class="text-2xl font-extrabold text-white">Terukur</div>
                            <p class="mt-1 text-sm text-slate-400">Hitung nilai inventaris.</p>
                        </div>
                    </div>
                </section>

                <section class="rounded-3xl border border-white/10 bg-white/10 p-4 shadow-2xl shadow-slate-950/40 backdrop-blur md:p-6">
                    <div class="rounded-2xl border border-slate-700/70 bg-slate-950/80 p-5">
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-400">Preview Dashboard</p>
                                <h2 class="mt-1 text-xl font-bold text-white">Ringkasan Inventaris</h2>
                            </div>
                            <span class="rounded-full bg-emerald-400/10 px-3 py-1 text-xs font-bold text-emerald-300">Stok Terpantau</span>
                        </div>

                        <div class="mt-5 grid grid-cols-2 gap-3">
                            <div class="rounded-2xl border border-white/10 bg-white/[0.06] p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Kategori</p>
                                <p class="mt-3 text-2xl font-extrabold text-white">24</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/[0.06] p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Barang</p>
                                <p class="mt-3 text-2xl font-extrabold text-white">1.248</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/[0.06] p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Nilai Inventaris</p>
                                <p class="mt-3 text-xl font-extrabold text-white">Rp 86,5 jt</p>
                            </div>
                            <div class="rounded-2xl border border-amber-300/20 bg-amber-300/10 p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-amber-200">Stok Rendah</p>
                                <p class="mt-3 text-2xl font-extrabold text-white">12</p>
                            </div>
                        </div>

                        <div class="mt-5 rounded-2xl border border-white/10 bg-slate-900/80 p-4">
                            <div class="mb-3 flex items-center justify-between">
                                <h3 class="text-sm font-bold text-white">Aktivitas Barang</h3>
                                <span class="text-xs font-semibold text-slate-400">Hari ini</span>
                            </div>
                            <div class="space-y-3">
                                <div class="grid grid-cols-[0.8fr_1.4fr_0.8fr] items-center gap-3 rounded-xl bg-white/[0.04] px-3 py-3 text-sm">
                                    <span class="font-mono text-blue-300">BRG-018</span>
                                    <span class="font-semibold text-slate-200">Kabel LAN</span>
                                    <span class="rounded-full bg-emerald-400/10 px-2 py-1 text-center text-xs font-bold text-emerald-300">Aman</span>
                                </div>
                                <div class="grid grid-cols-[0.8fr_1.4fr_0.8fr] items-center gap-3 rounded-xl bg-white/[0.04] px-3 py-3 text-sm">
                                    <span class="font-mono text-blue-300">BRG-042</span>
                                    <span class="font-semibold text-slate-200">Kertas A4</span>
                                    <span class="rounded-full bg-amber-400/10 px-2 py-1 text-center text-xs font-bold text-amber-300">Restock</span>
                                </div>
                                <div class="grid grid-cols-[0.8fr_1.4fr_0.8fr] items-center gap-3 rounded-xl bg-white/[0.04] px-3 py-3 text-sm">
                                    <span class="font-mono text-blue-300">BRG-077</span>
                                    <span class="font-semibold text-slate-200">Mouse Wireless</span>
                                    <span class="rounded-full bg-sky-400/10 px-2 py-1 text-center text-xs font-bold text-sky-300">Masuk</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <section class="grid gap-4 pb-12 md:grid-cols-4">
                <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                    <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-blue-500/15 text-blue-200">01</div>
                    <h3 class="font-bold text-white">Katalog Kategori</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-400">Pisahkan barang berdasarkan jenis penyimpanan agar pencarian lebih mudah.</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                    <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-500/15 text-cyan-200">02</div>
                    <h3 class="font-bold text-white">Monitoring Stok</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-400">Lihat jumlah barang dan identifikasi stok rendah sebelum kehabisan.</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                    <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-500/15 text-emerald-200">03</div>
                    <h3 class="font-bold text-white">Nilai Inventaris</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-400">Pantau estimasi nilai aset dan barang tersimpan secara lebih terukur.</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                    <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-amber-500/15 text-amber-200">04</div>
                    <h3 class="font-bold text-white">Pengingat Restock</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-400">Fokus pada barang yang perlu ditambah agar operasional tetap lancar.</p>
                </div>
            </section>

            <footer class="border-t border-white/10 py-6 text-center text-sm text-slate-500">
                Sistem Inventaris &copy; {{ date('Y') }}. Manajemen penyimpanan barang berbasis web.
            </footer>
        </div>
    </div>
</body>
</html>
