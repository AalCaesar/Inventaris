<x-guest-layout>
    <!-- Login Card Container -->
    <div class="w-full max-w-[400px] bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] p-8 sm:p-10">

        <!-- Header Text -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-[#334155] tracking-tight">Masuk ke Akun</h2>
            <p class="text-sm text-[#64748b] mt-2">Silakan masukkan email dan password Anda untuk mengelola inventaris.</p>
        </div>

        <!-- Status Message -->
        @if (session('status'))
            <div class="mb-6 p-4 rounded-[6px] bg-emerald-50 border border-emerald-200 text-sm font-medium text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-[#334155] mb-1.5">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@email.com"
                       class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2.5 bg-[#f8fafc] text-[#334155] text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all">
                @if ($errors->get('email'))
                    <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-sm font-medium text-[#334155]">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs font-medium text-[#6366f1] hover:text-[#4f46e5] transition-colors">
                            Lupa password?
                        </a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••"
                       class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2.5 bg-[#f8fafc] text-[#334155] text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all">
                @if ($errors->get('password'))
                    <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-[#e2e8f0] text-[#6366f1] focus:ring-[#6366f1]/50 bg-[#f8fafc]">
                <label for="remember_me" class="ml-2 block text-sm text-[#64748b] select-none cursor-pointer">
                    Ingat saya
                </label>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#6366f1] text-white text-sm font-medium py-2.5 px-4 rounded-[6px] transition-all duration-200 hover:bg-[#4f46e5] focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-[#6366f1]">
                    Masuk
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </button>
            </div>
        </form>

        <!-- Register Link -->
        <div class="mt-8 text-center text-sm text-[#64748b]">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-medium text-[#6366f1] hover:text-[#4f46e5] transition-colors">
                Daftar sekarang
            </a>
        </div>
    </div>
</x-guest-layout>
