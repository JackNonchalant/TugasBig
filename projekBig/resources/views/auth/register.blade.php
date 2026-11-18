@extends('layouts.app')

@section('title', 'Daftar Akun Baru')

@section('content')
<div class="min-h-[calc(100vh-16rem)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg w-full">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white shadow-lg shadow-emerald-500/30 mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold tracking-tight text-slate-900">Bergabung Bersama PojokBerbagi</h2>
            <p class="text-sm text-slate-500 mt-1">Daftar sebagai Donatur atau Penerima Manfaat barang pendidikan</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xl shadow-slate-100 p-8 sm:p-10">
            @if ($errors->any())
                <div class="p-4 rounded-xl bg-red-50 border border-red-200 mb-6 text-sm text-red-700">
                    <div class="font-semibold mb-1 flex items-center gap-2">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        Mohon perbaiki isian form berikut:
                    </div>
                    <ul class="list-disc list-inside space-y-0.5 text-xs">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}" class="space-y-5">
                @csrf

                <!-- Name Input -->
                <div>
                    <label for="name" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Lengkap
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        placeholder="Contoh: Budi Santoso"
                        class="block w-full px-4 py-2.5 bg-slate-50 border @error('name') border-red-300 ring-1 ring-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    >
                </div>

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                        Alamat Email
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="nama@email.com"
                        class="block w-full px-4 py-2.5 bg-slate-50 border @error('email') border-red-300 ring-1 ring-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    >
                </div>

                <!-- Role Selection (Cards / Radio) -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                        Pilih Peran Akun <span class="text-red-500">*</span>
                    </label>
                    <p class="text-xs text-slate-500 mb-3">Tentukan peran Anda dalam komunitas PojokBerbagi:</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <!-- Donatur Option -->
                        <label class="relative flex flex-col p-4 border rounded-xl cursor-pointer hover:border-emerald-500 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50 has-[:checked]:ring-2 has-[:checked]:ring-emerald-500/20 transition-all">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-sm text-slate-900 flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                    Donatur
                                </span>
                                <input
                                    type="radio"
                                    name="role"
                                    value="donor"
                                    class="w-4 h-4 text-emerald-600 border-slate-300 focus:ring-emerald-500"
                                    {{ old('role', 'donor') === 'donor' ? 'checked' : '' }}
                                    required
                                >
                            </div>
                            <span class="text-xs text-slate-500 leading-relaxed">
                                Ingin mendonasikan buku, alat tulis, seragam, atau perangkat belajar.
                            </span>
                        </label>

                        <!-- Penerima Manfaat Option -->
                        <label class="relative flex flex-col p-4 border rounded-xl cursor-pointer hover:border-blue-500 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50 has-[:checked]:ring-2 has-[:checked]:ring-blue-500/20 transition-all">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-sm text-slate-900 flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                                    Penerima Manfaat
                                </span>
                                <input
                                    type="radio"
                                    name="role"
                                    value="beneficiary"
                                    class="w-4 h-4 text-blue-600 border-slate-300 focus:ring-blue-500"
                                    {{ old('role') === 'beneficiary' ? 'checked' : '' }}
                                    required
                                >
                            </div>
                            <span class="text-xs text-slate-500 leading-relaxed">
                                Siswa, orang tua, atau pihak sekolah yang membutuhkan bantuan perlengkapan belajar.
                            </span>
                        </label>
                    </div>
                    @error('role')
                        <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                        Password (Minimal 8 karakter)
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        placeholder="••••••••"
                        class="block w-full px-4 py-2.5 bg-slate-50 border @error('password') border-red-300 ring-1 ring-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    >
                </div>

                <!-- Password Confirmation Input -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                        Konfirmasi Password
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        required
                        placeholder="••••••••"
                        class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                    >
                </div>

                <!-- Submit Button -->
                <div>
                    <button
                        type="submit"
                        class="w-full flex justify-center py-3 px-4 rounded-xl text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 shadow-md shadow-emerald-600/25 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all cursor-pointer"
                    >
                        Buat Akun PojokBerbagi
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-500">
                    Sudah memiliki akun?
                    <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:text-emerald-700 underline underline-offset-4 ml-1">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
