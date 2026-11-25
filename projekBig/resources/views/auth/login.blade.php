@extends('layouts.app')

@section('title', 'Masuk ke Akun Anda')

@section('content')
<div class="min-h-[calc(100vh-12rem)] flex items-center justify-center py-12 px-5 sm:px-8">
    <div class="max-w-md w-full rise">
        <!-- Editorial Header -->
        <div class="mb-8">
            <p class="flex items-center gap-3 text-[11px] font-semibold uppercase tracking-[.18em] text-ochre mb-3">
                <span class="h-px w-8 bg-ochre"></span>
                Akses Akun
            </p>
            <h1 class="font-display text-4xl sm:text-[2.75rem] leading-[1.02] tracking-tight text-ink">
                Selamat Datang Kembali<em class="text-ochre">.</em>
            </h1>
            <p class="text-sm text-warm mt-2.5">Masuk untuk melanjutkan aktivitas berbagi atau memantau kebutuhan pendidikan.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl border border-stone-200 p-7 sm:p-9">
            @if ($errors->any())
                <div class="p-4 rounded-xl bg-red-50/80 border border-red-200 mb-6 text-sm text-red-900">
                    <div class="font-semibold mb-1 flex items-center gap-2 text-xs uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                        Terjadi kesalahan autentikasi
                    </div>
                    <ul class="list-disc list-inside space-y-0.5 text-xs text-red-800">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                            </svg>
                        </div>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="nama@email.com"
                            class="block w-full pl-10 pr-4 py-2.5 bg-paper border @error('email') border-red-300 ring-1 ring-red-300 @else border-stone-200 @enderror rounded-xl text-sm text-ink placeholder:text-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest transition-all"
                        >
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            placeholder="••••••••"
                            class="block w-full pl-10 pr-4 py-2.5 bg-paper border @error('password') border-red-300 ring-1 ring-red-300 @else border-stone-200 @enderror rounded-xl text-sm text-ink placeholder:text-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest transition-all"
                        >
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            class="w-4 h-4 rounded text-forest border-stone-300 focus:ring-forest/30 accent-forest"
                        >
                        <span class="text-xs text-warm font-medium">Ingat saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-1">
                    <button
                        type="submit"
                        class="group w-full inline-flex items-center justify-center gap-2 py-3 px-5 rounded-xl text-sm font-semibold text-paper bg-forest hover:bg-forest-soft transition duration-300 active:scale-95 cursor-pointer"
                    >
                        Masuk ke Akun
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </button>
                </div>
            </form>

            <div class="mt-7 pt-5 border-t border-stone-200/80 text-center">
                <p class="text-xs text-warm">
                    Belum memiliki akun PojokBerbagi?
                    <a href="{{ route('register') }}" class="font-semibold text-forest hover:text-ochre underline underline-offset-4 ml-1 transition-colors">
                        Daftar sekarang
                    </a>
                </p>
            </div>
        </div>

        <!-- Testing Helper Box -->
        <div class="mt-6 p-4 rounded-xl bg-cream/70 border border-stone-200 text-xs text-warm">
            <div class="font-semibold text-ink mb-2 text-[11px] uppercase tracking-wider">Akun Pengujian (Seeder)</div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                <div class="bg-paper p-2.5 rounded-lg border border-stone-200">
                    <span class="font-semibold text-forest block">Donatur</span>
                    <span class="text-[11px] block text-warm truncate">donatur@pojokberbagi.id</span>
                    <span class="text-[11px] block font-mono text-stone-400">password123</span>
                </div>
                <div class="bg-paper p-2.5 rounded-lg border border-stone-200">
                    <span class="font-semibold text-ink block">Penerima</span>
                    <span class="text-[11px] block text-warm truncate">penerima@pojokberbagi.id</span>
                    <span class="text-[11px] block font-mono text-stone-400">password123</span>
                </div>
                <div class="bg-paper p-2.5 rounded-lg border border-stone-200">
                    <span class="font-semibold text-ochre block">Admin</span>
                    <span class="text-[11px] block text-warm truncate">admin@pojokberbagi.id</span>
                    <span class="text-[11px] block font-mono text-stone-400">password123</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
