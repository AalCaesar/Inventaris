<x-guest-layout>
    <!-- Register Card Container -->
    <div class="w-full max-w-[420px] bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] p-8">

        <!-- Header Text -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-[#334155] tracking-tight">Buat Akun</h2>
            <p class="text-sm text-[#64748b] mt-2">Daftarkan akun untuk mulai mengelola stok barang</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Nama Lengkap -->
            <div>
                <label for="name" class="block text-xs font-medium uppercase tracking-wider text-[#64748b] mb-1.5">Nama</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe"
                       class="w-full px-3 py-2 border border-[#e2e8f0] rounded-[6px] focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] text-[#334155] transition-all">
                @if ($errors->get('name'))
                    <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-medium uppercase tracking-wider text-[#64748b] mb-1.5">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@email.com"
                       class="w-full px-3 py-2 border border-[#e2e8f0] rounded-[6px] focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] text-[#334155] transition-all">
                @if ($errors->get('email'))
                    <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-medium uppercase tracking-wider text-[#64748b] mb-1.5">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter"
                       class="w-full px-3 py-2 border border-[#e2e8f0] rounded-[6px] focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] text-[#334155] transition-all">
                @if ($errors->get('password'))
                    <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-xs font-medium uppercase tracking-wider text-[#64748b] mb-1.5">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password"
                       class="w-full px-3 py-2 border border-[#e2e8f0] rounded-[6px] focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] text-[#334155] transition-all">
                @if ($errors->get('password_confirmation'))
                    <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#6366f1] text-white text-sm font-medium py-2 px-4 rounded-[6px] transition-all duration-200 hover:bg-[#4f46e5] focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-[#6366f1]">
                    Daftar Akun
                </button>
            </div>
        </form>

        <!-- Login Link -->
        <div class="mt-6 text-center text-sm text-[#64748b]">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-medium text-[#6366f1] hover:text-[#4f46e5] transition-colors">
                Masuk di sini
            </a>
        </div>
    </div>
</x-guest-layout>
