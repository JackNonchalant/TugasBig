@extends('layouts.app')

@section('title', 'Daftar Akun Baru')

@section('content')
<div class="min-h-[calc(100vh-12rem)] flex items-center justify-center py-12 px-5 sm:px-8">
    <div class="max-w-lg w-full rise">
        <!-- Editorial Header -->
        <div class="mb-8">
            <p class="flex items-center gap-3 text-[11px] font-semibold uppercase tracking-[.18em] text-ochre mb-3">
                <span class="h-px w-8 bg-ochre"></span>
                Pendaftaran Anggota
            </p>
            <h1 class="font-display text-4xl sm:text-[2.75rem] leading-[1.02] tracking-tight text-ink">
                Bergabung bersama <em class="text-ochre">PojokBerbagi.</em>
            </h1>
            <p class="text-sm text-warm mt-2.5">Daftar sebagai Donatur atau Penerima Manfaat perlengkapan pendidikan.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl border border-stone-200 p-7 sm:p-9">
            @if ($errors->any())
                <div class="p-4 rounded-xl bg-red-50/80 border border-red-200 mb-6 text-sm text-red-900">
                    <div class="font-semibold mb-1 flex items-center gap-2 text-xs uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                        Mohon perbaiki isian form berikut
                    </div>
                    <ul class="list-disc list-inside space-y-0.5 text-xs text-red-800">
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
                    <label for="name" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
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
                        class="block w-full px-4 py-2.5 bg-paper border @error('name') border-red-300 ring-1 ring-red-300 @else border-stone-200 @enderror rounded-xl text-sm text-ink placeholder:text-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest transition-all"
                    >
                </div>

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
                        Alamat Email
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="nama@email.com"
                        class="block w-full px-4 py-2.5 bg-paper border @error('email') border-red-300 ring-1 ring-red-300 @else border-stone-200 @enderror rounded-xl text-sm text-ink placeholder:text-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest transition-all"
                    >
                </div>

                <!-- Role Selection -->
                <div>
                    <label class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-1.5">
                        Pilih Peran Akun <span class="text-ochre">*</span>
                    </label>
                    <p class="text-xs text-warm mb-3">Tentukan peran Anda dalam ekosistem PojokBerbagi:</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <label class="relative flex flex-col p-4 border border-stone-200 bg-paper rounded-xl cursor-pointer hover:border-forest/50 has-[:checked]:border-forest has-[:checked]:bg-cream/60 has-[:checked]:ring-1 has-[:checked]:ring-forest transition-all">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-semibold text-sm text-ink flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-forest"></span>
                                    Donatur
                                </span>
                                <input
                                    type="radio"
                                    name="role"
                                    value="donor"
                                    class="w-4 h-4 text-forest border-stone-300 focus:ring-forest accent-forest"
                                    {{ old('role', 'donor') === 'donor' ? 'checked' : '' }}
                                    required
                                >
                            </div>
                            <span class="text-xs text-warm leading-relaxed">
                                Ingin mendonasikan buku, alat tulis, seragam, atau perangkat belajar.
                            </span>
                        </label>

                        <label class="relative flex flex-col p-4 border border-stone-200 bg-paper rounded-xl cursor-pointer hover:border-ochre/60 has-[:checked]:border-ochre has-[:checked]:bg-cream/60 has-[:checked]:ring-1 has-[:checked]:ring-ochre transition-all">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-semibold text-sm text-ink flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-ochre"></span>
                                    Penerima Manfaat
                                </span>
                                <input
                                    type="radio"
                                    name="role"
                                    value="beneficiary"
                                    class="w-4 h-4 text-ochre border-stone-300 focus:ring-ochre accent-ochre"
                                    {{ old('role') === 'beneficiary' ? 'checked' : '' }}
                                    required
                                >
                            </div>
                            <span class="text-xs text-warm leading-relaxed">
                                Siswa, orang tua, atau pihak sekolah yang membutuhkan perlengkapan belajar.
                            </span>
                        </label>
                    </div>
                    @error('role')
                        <p class="text-xs text-red-700 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
                        Password (Minimal 8 karakter)
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        placeholder="••••••••"
                        class="block w-full px-4 py-2.5 bg-paper border @error('password') border-red-300 ring-1 ring-red-300 @else border-stone-200 @enderror rounded-xl text-sm text-ink placeholder:text-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest transition-all"
                    >
                </div>

                <!-- Password Confirmation Input -->
                <div>
                    <label for="password_confirmation" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
                        Konfirmasi Password
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        required
                        placeholder="••••••••"
                        class="block w-full px-4 py-2.5 bg-paper border border-stone-200 rounded-xl text-sm text-ink placeholder:text-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest transition-all"
                    >
                </div>

                <!-- Submit Button -->
                <div class="pt-1">
                    <button
                        type="submit"
                        class="group w-full inline-flex items-center justify-center gap-2 py-3 px-5 rounded-xl text-sm font-semibold text-paper bg-forest hover:bg-forest-soft transition duration-300 active:scale-95 cursor-pointer"
                    >
                        Buat Akun PojokBerbagi
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </button>
                </div>
            </form>

            <div class="mt-7 pt-5 border-t border-stone-200/80 text-center">
                <p class="text-xs text-warm">
                    Sudah memiliki akun?
                    <a href="{{ route('login') }}" class="font-semibold text-forest hover:text-ochre underline underline-offset-4 ml-1 transition-colors">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
