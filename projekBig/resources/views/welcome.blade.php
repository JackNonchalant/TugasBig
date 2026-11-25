@extends('layouts.app')

@section('title', 'Platform Donasi Perlengkapan Pendidikan')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-white border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Gerakan Berbagi Perlengkapan Pendidikan
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-slate-900 leading-[1.15]">
                Pendidikan Berkualitas untuk <span class="text-emerald-600 underline decoration-emerald-300 decoration-wavy">Setiap Anak</span>.
            </h1>
            <p class="text-base sm:text-lg text-slate-600 mt-6 leading-relaxed">
                <strong>PojokBerbagi</strong> menjembatani kebaikan hati Anda sebagai <strong>Donatur</strong> dengan siswa dan sekolah yang membutuhkan buku pelajaran, alat tulis, seragam, hingga perangkat belajar.
            </p>

            <div class="mt-8 flex flex-wrap items-center gap-4">
                @auth
                    @if (auth()->user()->isDonor())
                        <a
                            href="{{ route('items.create') }}"
                            class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-emerald-600 text-white font-bold text-sm shadow-lg shadow-emerald-600/25 hover:bg-emerald-700 transition-all cursor-pointer"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Posting Barang Donasi
                        </a>
                        <a
                            href="{{ route('donor.dashboard') }}"
                            class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-slate-100 text-slate-800 font-semibold text-sm hover:bg-slate-200 transition-colors"
                        >
                            Dashboard Donatur
                        </a>
                    @elseif (auth()->user()->isBeneficiary())
                        <a
                            href="{{ route('beneficiary.dashboard') }}"
                            class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-emerald-600 text-white font-bold text-sm shadow-lg shadow-emerald-600/25 hover:bg-emerald-700 transition-all"
                        >
                            Lihat Katalog Donasi
                        </a>
                    @elseif (auth()->user()->isAdmin())
                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-purple-600 text-white font-bold text-sm shadow-lg shadow-purple-600/25 hover:bg-purple-700 transition-all"
                        >
                            Panel Admin
                        </a>
                    @endif
                @else
                    <a
                        href="{{ route('register') }}"
                        class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-emerald-600 text-white font-bold text-sm shadow-lg shadow-emerald-600/25 hover:bg-emerald-700 transition-all cursor-pointer"
                    >
                        Mulai Bergabung Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a
                        href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-slate-100 text-slate-800 font-semibold text-sm hover:bg-slate-200 transition-colors"
                    >
                        Masuk ke Akun
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>

<main>
{{-- ═════════════════════ HERO ═════════════════════ --}}
<section class="relative">
    <div class="mx-auto max-w-7xl px-5 pb-20 pt-12 sm:px-8 lg:pb-28 lg:pt-20">
        <div class="grid items-center gap-14 lg:grid-cols-12 lg:gap-10">

            {{-- Teks --}}
            <div class="lg:col-span-6">
                <p class="rise flex items-center gap-3 text-[12px] font-semibold uppercase tracking-[.18em] text-ochre" style="--d:80ms">
                    <span class="h-px w-9 bg-ochre"></span>
                    Redistribusi perlengkapan sekolah
                </p>

                <h1 class="font-display mt-6 text-[clamp(3rem,7vw,5.9rem)] leading-[.98] tracking-[-.02em] text-ink">
                    <span class="line"><span class="line-inner" style="--d:160ms">Dari rak bukumu,</span></span>
                    <span class="line"><span class="line-inner" style="--d:260ms">ke meja belajar</span></span>
                    <span class="line"><span class="line-inner" style="--d:360ms"><em class="text-ochre">anak lain.</em></span></span>
                </h1>

                <p class="rise mt-8 max-w-[34rem] text-[17px] leading-relaxed text-warm" style="--d:560ms">
                    PojokBerbagi mempertemukan donatur dengan siswa yang membutuhkan buku pelajaran, seragam, dan alat tulis layak pakai. Setiap barang diperiksa Tim Posko Transit sebelum sampai ke tangan penerima.
                </p>

<<<<<<<<< Temporary merge branch 1
                {{-- CTA Buttons --}}
                <div class="mt-8 flex flex-wrap items-center gap-3">
                    @auth
                        @if (auth()->user()->isDonor())
                            <a href="{{ route('items.create') }}"
                               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-700 text-white font-bold text-sm hover:bg-emerald-800 transition-colors shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Donasikan Barang
                            </a>
                            <a href="{{ route('katalog.index') }}"
                               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border-2 border-stone-300 text-stone-700 font-semibold text-sm hover:border-emerald-600 hover:text-emerald-700 transition-colors">
                                Lihat Katalog Kebutuhan
                            </a>
                        @elseif (auth()->user()->isBeneficiary())
                            <a href="{{ route('beneficiary.dashboard') }}"
                               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-700 text-white font-bold text-sm hover:bg-emerald-800 transition-colors shadow-sm">
                                Jelajahi Katalog Donasi
                            </a>
                            <a href="{{ route('katalog.index') }}"
                               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border-2 border-stone-300 text-stone-700 font-semibold text-sm hover:border-emerald-600 hover:text-emerald-700 transition-colors">
                                Lihat Katalog Kebutuhan
                            </a>
                        @elseif (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-700 text-white font-bold text-sm hover:bg-emerald-800 transition-colors shadow-sm">
                                Buka Panel Admin
                            </a>
                            <a href="{{ route('katalog.index') }}"
                               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border-2 border-stone-300 text-stone-700 font-semibold text-sm hover:border-emerald-600 hover:text-emerald-700 transition-colors">
                                Lihat Katalog Kebutuhan
                            </a>
                        @endif
                    @else
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-700 text-white font-bold text-sm hover:bg-emerald-800 transition-colors shadow-sm">
                            Mulai Berbagi Sekarang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="{{ route('katalog.index') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border-2 border-stone-300 text-stone-700 font-semibold text-sm hover:border-emerald-600 hover:text-emerald-700 transition-colors">
                            Lihat Katalog Kebutuhan
                        </a>
                    @endauth
=========
                <div class="rise mt-10 flex flex-wrap items-center gap-3" style="--d:680ms">
                    <a href="{{ $cta[0][1] }}"
                       class="group inline-flex items-center gap-2.5 rounded-xl bg-forest px-6 py-3.5 text-sm font-semibold text-paper transition duration-300 hover:bg-forest-soft active:scale-95">
                        {{ $cta[0][0] }}
                        <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </a>
                    <a href="{{ $cta[1][1] }}"
                       class="group inline-flex items-center gap-2.5 rounded-xl border border-stone-300 px-6 py-3.5 text-sm font-semibold text-ink transition duration-300 hover:border-forest hover:bg-stone-100/70 active:scale-95">
                        {{ $cta[1][0] }}
                        <svg class="h-4 w-4 text-warm transition duration-300 group-hover:translate-x-1 group-hover:text-forest" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </a>
>>>>>>>>> Temporary merge branch 2
                </div>
            </div>

            <!-- Penerima Manfaat Card -->
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg mb-4">
                        2
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Penerima Manfaat</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Jelajahi katalog perlengkapan belajar yang tersedia dan temukan bantuan barang yang sesuai dengan kebutuhan pendidikan.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 text-[11px] font-semibold text-blue-600">
                    Akses Langsung ke Detail Barang
                </div>
            </div>

            <!-- Admin Card -->
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold text-lg mb-4">
                        3
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Administrator</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Mengawasi ekosistem donasi, memonitor keaslian data barang, dan memastikan kelancaran proses penyaluran barang.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 text-[11px] font-semibold text-purple-600">
                    Keamanan & Validasi Sistem
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Donations Preview -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900">Barang Donasi Pendidikan Terkini</h2>
                <p class="text-xs text-slate-500 mt-1">Perlengkapan belajar siap disalurkan kepada siswa dan sekolah yang membutuhkan</p>
            </div>
            @auth
                @if (auth()->user()->isBeneficiary())
                    <a href="{{ route('beneficiary.dashboard') }}" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 flex items-center gap-1">
                        Lihat Semua Katalog &rarr;
                    </a>
                @endif
            @endauth
        </div>

        @if ($recentItems->isEmpty())
            <div class="p-8 text-center bg-slate-50 rounded-2xl border border-slate-200 text-xs text-slate-400">
                Belum ada barang donasi yang diposting.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($recentItems as $item)
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all flex flex-col overflow-hidden group">
                        <div class="relative aspect-video bg-slate-100 overflow-hidden">
                            @if ($item->foto)
                                <img src="{{ $item->foto_url }}" alt="{{ $item->nama_barang }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 p-4 bg-slate-50">
                                    <svg class="w-10 h-10 text-slate-300 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-[11px]">Tanpa Foto</span>
                                </div>
                            @endif
                            <span class="absolute top-2.5 right-2.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-white/90 text-slate-800 backdrop-blur shadow-sm">
                                {{ $item->kondisi }}
                            </span>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider mb-1 block">{{ $item->kategori }}</span>
                                <h3 class="font-bold text-slate-900 text-sm group-hover:text-emerald-600 transition-colors line-clamp-1">
                                    {{ $item->nama_barang }}
                                </h3>
                                <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">
                                    {{ $item->deskripsi }}
                                </p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                                <span class="font-bold text-slate-800">{{ $item->jumlah }} Unit</span>
                                @auth
                                    <a href="{{ route('items.show', $item->id) }}" class="font-semibold text-emerald-600 hover:text-emerald-700">
                                        Lihat Detail &rarr;
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:text-emerald-700">
                                        Masuk untuk Detail &rarr;
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
