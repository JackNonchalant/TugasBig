@extends('layouts.app')

@section('title', 'Masuk ke Akun Anda')

@section('content')
<div class="min-h-[calc(100vh-16rem)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white shadow-lg shadow-emerald-500/30 mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold tracking-tight text-slate-900">Selamat Datang Kembali</h2>
            <p class="text-sm text-slate-500 mt-1">Masuk untuk melanjutkan ke akun PojokBerbagi Anda</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xl shadow-slate-100 p-8 sm:p-10">
            @if ($errors->any())
                <div class="p-4 rounded-xl bg-red-50 border border-red-200 mb-6 text-sm text-red-700">
                    <div class="font-semibold mb-1 flex items-center gap-2">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        Terjadi kesalahan autentikasi:
                    </div>
                    <ul class="list-disc list-inside space-y-0.5 text-xs">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                    <form class="flex flex-col gap-space-md" method="POST" action="{{ route('login.post') }}" id="login-form">
                        @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
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
                            class="block w-full pl-11 pr-4 py-2.5 bg-slate-50 border @error('email') border-red-300 ring-1 ring-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                        >
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            placeholder="••••••••"
                            class="block w-full pl-11 pr-4 py-2.5 bg-slate-50 border @error('password') border-red-300 ring-1 ring-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
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
                            class="w-4 h-4 rounded text-emerald-600 border-slate-300 focus:ring-emerald-500"
                        >
                        <span class="text-xs text-slate-600 font-medium">Ingat saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button
                        type="submit"
                        class="w-full flex justify-center py-3 px-4 rounded-xl text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 shadow-md shadow-emerald-600/25 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all cursor-pointer"
                    >
                        Masuk ke Akun
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-500">
                    Belum memiliki akun PojokBerbagi?
                    <a href="{{ route('register') }}" class="font-semibold text-emerald-600 hover:text-emerald-700 underline underline-offset-4 ml-1">
                        Daftar sekarang
                    </a>
                </p>
            </div>
        </div>

        <!-- Testing Helper Box -->
        <div class="mt-6 p-4 rounded-xl bg-slate-100/80 border border-slate-200 text-xs text-slate-600">
            <div class="font-semibold text-slate-700 mb-1">Akun Pengujian (Seeder):</div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 mt-2">
                <div class="bg-white p-2 rounded-lg border border-slate-200">
                    <span class="font-bold text-emerald-700 block">Donatur:</span>
                    <span class="text-[11px] block text-slate-500">donatur@pojokberbagi.id</span>
                    <span class="text-[11px] block font-mono text-slate-400">password123</span>
                </div>
                <div class="bg-white p-2 rounded-lg border border-slate-200">
                    <span class="font-bold text-blue-700 block">Penerima:</span>
                    <span class="text-[11px] block text-slate-500">penerima@pojokberbagi.id</span>
                    <span class="text-[11px] block font-mono text-slate-400">password123</span>
                </div>
                <div class="bg-white p-2 rounded-lg border border-slate-200">
                    <span class="font-bold text-purple-700 block">Admin:</span>
                    <span class="text-[11px] block text-slate-500">admin@pojokberbagi.id</span>
                    <span class="text-[11px] block font-mono text-slate-400">password123</span>
                </div>
            </div>
        </div>
    </main>

    <!-- Password Visibility Toggle & Quick Fill Script -->
    <script>
        (function () {
            const toggleBtn = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (toggleBtn && passwordInput && eyeIcon) {
                toggleBtn.addEventListener('click', function () {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    eyeIcon.textContent = isPassword ? 'visibility_off' : 'visibility';
                });
            }
        })();

        function fillLogin(email, password) {
            document.getElementById('identifier').value = email;
            document.getElementById('password').value = password;
        }
    </script>
</body>
</html>
