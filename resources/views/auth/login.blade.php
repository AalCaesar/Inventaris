<x-guest-layout>
    <div class="auth-form-header">
        <div class="auth-form-icon">
            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-8.25-4.5L3.75 7.5m16.5 0l-8.25 4.5m8.25-4.5v9l-8.25 4.5m0-9L3.75 7.5m8.25 4.5v9m-8.25-13.5v9l8.25 4.5" />
            </svg>
        </div>
        <div class="auth-form-badge">Sistem Inventaris</div>
        <h2 class="auth-form-title">Masuk ke Dashboard</h2>
        <p class="auth-form-description">Kelola kategori, stok, dan penyimpanan barang dari satu tempat.</p>
    </div>

    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@email.com">
            @if ($errors->get('email'))
                <div class="auth-error">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="auth-field">
            <div class="auth-row-between">
                <label for="password">Password</label>
                @if (Route::has('password.request'))
                    <a class="auth-link" href="{{ route('password.request') }}">Lupa password?</a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password">
            @if ($errors->get('password'))
                <div class="auth-error">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <label for="remember_me" class="auth-remember">
            <input id="remember_me" type="checkbox" name="remember">
            Ingat saya
        </label>

        <button type="submit" class="auth-submit">
            Masuk
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
            </svg>
        </button>

        <div class="auth-switch">
            Belum punya akun?
            <a href="{{ route('register') }}" class="auth-link">Daftar di sini</a>
        </div>
    </form>
</x-guest-layout>
