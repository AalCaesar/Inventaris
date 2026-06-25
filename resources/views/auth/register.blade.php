<x-guest-layout>
    <div class="auth-form-header">
        <div class="auth-form-icon">
            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-8.25-4.5L3.75 7.5m16.5 0l-8.25 4.5m8.25-4.5v9l-8.25 4.5m0-9L3.75 7.5m8.25 4.5v9m-8.25-13.5v9l8.25 4.5" />
            </svg>
        </div>
        <div class="auth-form-badge">Buat Akun Inventaris</div>
        <h2 class="auth-form-title">Mulai Kelola Barang</h2>
        <p class="auth-form-description">Daftarkan akun untuk mengakses dashboard penyimpanan dan stok barang.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <label for="name">Nama</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nama lengkap">
            @if ($errors->get('name'))
                <div class="auth-error">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="auth-field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@email.com">
            @if ($errors->get('email'))
                <div class="auth-error">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="auth-field">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter">
            @if ($errors->get('password'))
                <div class="auth-error">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <div class="auth-field">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password">
            @if ($errors->get('password_confirmation'))
                <div class="auth-error">{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>

        <button type="submit" class="auth-submit">
            Daftar Akun
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
            </svg>
        </button>

        <div class="auth-switch">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="auth-link">Masuk di sini</a>
        </div>
    </form>
</x-guest-layout>
