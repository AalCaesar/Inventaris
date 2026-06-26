<x-guest-layout>
    <!-- Register Card Container -->
    <div class="w-full max-w-[420px] bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] p-8 sm:p-10">

        <!-- Header Text -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-[#334155] tracking-tight">Buat Akun Baru</h2>
            <p class="text-sm text-[#64748b] mt-2">Daftarkan akun Anda untuk mulai mengelola inventaris barang.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Nama Lengkap -->
            <div>
                <label for="name" class="block text-sm font-medium text-[#334155] mb-1.5">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe"
                       class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2.5 bg-[#f8fafc] text-[#334155] text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all">
                @if ($errors->get('name'))
                    <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-[#334155] mb-1.5">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@email.com"
                       class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2.5 bg-[#f8fafc] text-[#334155] text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all">
                @if ($errors->get('email'))
                    <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-[#334155] mb-1.5">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter"
                       class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2.5 bg-[#f8fafc] text-[#334155] text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all">
                @if ($errors->get('password'))
                    <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-[#334155] mb-1.5">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password"
                       class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2.5 bg-[#f8fafc] text-[#334155] text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all">
                @if ($errors->get('password_confirmation'))
                    <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#6366f1] text-white text-sm font-medium py-2.5 px-4 rounded-[6px] transition-all duration-200 hover:bg-[#4f46e5] focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-[#6366f1] shadow-sm">
                    Daftar Akun
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </button>
            </div>
        </form>

        <!-- Login Link -->
        <div class="mt-8 text-center text-sm text-[#64748b]">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-medium text-[#6366f1] hover:text-[#4f46e5] transition-colors">
                Masuk di sini
            </a>
        </div>
    </div>
</x-guest-layout>
