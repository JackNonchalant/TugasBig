@extends('layouts.app')

@section('title', 'Platform Donasi Perlengkapan Pendidikan')

@section('content')

{{-- ═══════════════════════════════════════════════════════
     HERO SECTION — Split Layout (60/40)
     Warm off-white background, editorial typography
     ═══════════════════════════════════════════════════════ --}}
<section class="relative overflow-hidden" style="background: linear-gradient(170deg, #FAF9F6 0%, #f0ece4 100%);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10 lg:gap-16 items-center">

            {{-- LEFT: Text (≈60%) --}}
            <div class="lg:col-span-3">
                {{-- Editorial label — not a stiff pill badge --}}
                <p class="text-sm font-semibold tracking-wide text-amber-700 mb-5 flex items-center gap-2">
                    <span class="inline-block w-8 h-px bg-amber-600"></span>
                    Gerakan Berbagi Perlengkapan Pendidikan
                </p>

                <h1 class="text-3xl sm:text-4xl lg:text-[2.85rem] font-extrabold leading-[1.18] text-stone-900">
                    Pendidikan Berkualitas<br class="hidden sm:inline"> untuk
                    <span class="font-editorial font-bold text-emerald-700 italic"> Setiap Anak</span>.
                </h1>

                <p class="mt-5 text-base sm:text-[17px] text-stone-500 leading-relaxed max-w-xl">
                    <strong class="text-stone-700">PojokBerbagi</strong> menghubungkan kebaikan hati Anda dengan siswa yang membutuhkan — buku pelajaran, alat tulis, seragam, hingga perangkat belajar. Transparan, terverifikasi, dan langsung berdampak.
                </p>

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
                            <a href="{{ route('admin.distributions.index') }}"
                               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border-2 border-stone-300 text-stone-700 font-semibold text-sm hover:border-emerald-600 hover:text-emerald-700 transition-colors">
                                Kelola Penyaluran
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
                </div>

                {{-- Social proof micro-stats --}}
                <div class="mt-8 flex flex-wrap items-center gap-6 text-sm text-stone-500">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/></svg>
                        </div>
                        <span><strong class="text-stone-800">{{ \App\Models\User::where('role','donor')->count() ?: '50' }}+</strong> Donatur</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <span><strong class="text-stone-800">{{ \App\Models\DonationItem::count() ?: '120' }}+</strong> Barang Tercatat</span>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Visual collage (≈40%) --}}
            <div class="lg:col-span-2 relative hidden lg:block">
                {{-- Photo collage using CSS illustration placeholders (no real images needed) --}}
                <div class="relative w-full aspect-[4/5]">
                    {{-- Main visual card --}}
                    <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-emerald-100 via-emerald-50 to-amber-50 border border-stone-200/60 shadow-lg overflow-hidden">
                        {{-- Abstract illustration suggesting education --}}
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-8 text-center">
                            <div class="w-24 h-24 rounded-full bg-emerald-200/80 flex items-center justify-center mb-4">
                                <svg class="w-12 h-12 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-emerald-800/60">Buku · Seragam · Alat Tulis</p>
                            <p class="text-xs text-emerald-700/40 mt-1">Perlengkapan belajar untuk masa depan</p>
                        </div>
                    </div>

                    {{-- Floating card: Buku Tersalurkan --}}
                    <div class="absolute -left-6 top-8 bg-white rounded-2xl shadow-xl border border-stone-100 px-4 py-3 flex items-center gap-3 animate-float-slow">
                        <div class="w-10 h-10 rounded-xl bg-emerald-600 flex items-center justify-center text-white shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/></svg>
                        </div>
                        <div>
                            <div class="text-lg font-extrabold text-stone-900 leading-none">1.240+</div>
                            <div class="text-[11px] text-stone-400 font-medium">Buku Tersalurkan</div>
                        </div>
                    </div>

                    {{-- Floating card: Sekolah Terbantu --}}
                    <div class="absolute -right-4 bottom-16 bg-white rounded-2xl shadow-xl border border-stone-100 px-4 py-3 flex items-center gap-3 animate-float-delayed">
                        <div class="w-10 h-10 rounded-xl bg-amber-500 flex items-center justify-center text-white shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <div class="text-lg font-extrabold text-stone-900 leading-none">85</div>
                            <div class="text-[11px] text-stone-400 font-medium">Sekolah Terbantu</div>
                        </div>
                    </div>

                    {{-- Floating card: check mark --}}
                    <div class="absolute left-4 bottom-4 bg-emerald-600 text-white rounded-xl shadow-lg px-3 py-2 text-xs font-bold flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Terverifikasi & Transparan
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════
     SECTION: Tiga Peran Utama
     Warm palette, humanis cards
     ═══════════════════════════════════════════════════════ --}}
<section class="py-14 lg:py-16 border-t border-stone-200/40" style="background:#FAF9F6;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto mb-10">
            <p class="text-sm font-semibold tracking-wide text-amber-700 mb-2 flex items-center justify-center gap-2">
                <span class="inline-block w-6 h-px bg-amber-600"></span>
                Bagaimana Ini Bekerja
                <span class="inline-block w-6 h-px bg-amber-600"></span>
            </p>
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-stone-900">
                Ekosistem Saling Bantu yang<br class="hidden sm:inline"> <span class="font-editorial italic text-emerald-700">Aman &amp; Terverifikasi</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            {{-- Donatur --}}
            <div class="bg-white p-7 rounded-2xl border border-stone-200/60 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between group">
                <div>
                    <div class="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center mb-4 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-stone-900 mb-1.5">Donatur</h3>
                    <p class="text-[13px] text-stone-500 leading-relaxed">
                        Unggah barang edukasi layak pakai melalui form sederhana. Pantau status donasi Anda hingga barang diterima siswa.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-stone-100 text-[11px] font-semibold text-emerald-700">
                    Buku · Seragam · Alat Tulis · Perangkat Belajar
                </div>
            </div>

            {{-- Penerima Manfaat --}}
            <div class="bg-white p-7 rounded-2xl border border-stone-200/60 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between group">
                <div>
                    <div class="w-11 h-11 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center mb-4 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-stone-900 mb-1.5">Penerima Manfaat</h3>
                    <p class="text-[13px] text-stone-500 leading-relaxed">
                        Jelajahi katalog perlengkapan belajar yang tersedia dan temukan bantuan sesuai kebutuhan pendidikan Anda.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-stone-100 text-[11px] font-semibold text-sky-700">
                    Akses Mudah · Cari & Temukan · Detail Lengkap
                </div>
            </div>

            {{-- Tim Posko Transit --}}
            <div class="bg-white p-7 rounded-2xl border border-stone-200/60 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between group">
                <div>
                    <div class="w-11 h-11 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center mb-4 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-stone-900 mb-1.5">Tim Posko Transit</h3>
                    <p class="text-[13px] text-stone-500 leading-relaxed">
                        Verifikasi barang, kelola penyaluran, catat bukti serah terima, dan pastikan setiap donasi sampai tepat sasaran.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-stone-100 text-[11px] font-semibold text-amber-700">
                    Verifikasi · Tracking · Bukti Serah Terima
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════
     SECTION: Barang Donasi Terkini
     ═══════════════════════════════════════════════════════ --}}
<section class="py-14 lg:py-16 bg-white border-t border-stone-200/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-8">
            <div>
                <p class="text-sm font-semibold tracking-wide text-amber-700 mb-1 flex items-center gap-2">
                    <span class="inline-block w-6 h-px bg-amber-600"></span>
                    Tersedia Sekarang
                </p>
                <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-stone-900">Barang Donasi Terkini</h2>
                <p class="text-[13px] text-stone-500 mt-1">Perlengkapan belajar siap disalurkan kepada siswa yang membutuhkan</p>
            </div>
            <a href="{{ route('katalog.index') }}" class="text-[13px] font-bold text-emerald-700 hover:text-emerald-800 flex items-center gap-1 transition-colors shrink-0">
                Lihat Semua Katalog
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        @if ($recentItems->isEmpty())
            <div class="p-10 text-center rounded-2xl border border-dashed border-stone-300" style="background:#FAF9F6;">
                <svg class="w-10 h-10 mx-auto text-stone-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                <p class="text-sm text-stone-400">Belum ada barang donasi yang diposting.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($recentItems as $item)
                    <div class="bg-white rounded-2xl border border-stone-200/60 shadow-sm hover:shadow-md transition-all flex flex-col overflow-hidden group">
                        {{-- Image --}}
                        <div class="relative aspect-[16/10] bg-stone-100 overflow-hidden">
                            @if ($item->foto)
                                <img src="{{ $item->foto_url }}" alt="{{ $item->nama_barang }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-stone-300 p-4" style="background: linear-gradient(135deg, #f5f0e8, #eee8db);">
                                    <svg class="w-10 h-10 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="text-xs text-stone-400">Tanpa Foto</span>
                                </div>
                            @endif
                            <span class="absolute top-2.5 right-2.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-white/90 text-stone-700 backdrop-blur-sm shadow-sm">
                                {{ $item->kondisi }}
                            </span>
                        </div>
                        {{-- Content --}}
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-bold text-amber-700 uppercase tracking-wider mb-1 block">{{ $item->kategori }}</span>
                                <h3 class="font-bold text-stone-900 text-sm group-hover:text-emerald-700 transition-colors line-clamp-1">
                                    {{ $item->nama_barang }}
                                </h3>
                                <p class="text-[13px] text-stone-500 mt-1.5 line-clamp-2 leading-relaxed">
                                    {{ $item->deskripsi }}
                                </p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-stone-100 flex items-center justify-between text-xs">
                                <span class="font-bold text-stone-700">{{ $item->jumlah }} Unit</span>
                                @auth
                                    <a href="{{ route('items.show', $item->id) }}" class="font-bold text-emerald-700 hover:text-emerald-800 transition-colors">
                                        Lihat Detail →
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="font-bold text-emerald-700 hover:text-emerald-800 transition-colors">
                                        Masuk untuk Detail →
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════
     SECTION: CTA Penutup
     ═══════════════════════════════════════════════════════ --}}
<section class="py-16 border-t border-stone-200/40" style="background: linear-gradient(170deg, #ecfdf5 0%, #FAF9F6 100%);">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-stone-900 mb-3">
            Mulai Berbagi, <span class="font-editorial italic text-emerald-700">Mulai Hari Ini</span>
        </h2>
        <p class="text-[15px] text-stone-500 mb-8 max-w-lg mx-auto leading-relaxed">
            Setiap buku, seragam, atau alat tulis yang Anda donasikan membuka jalan bagi seorang anak untuk meraih masa depan yang lebih cerah.
        </p>
        <div class="flex flex-wrap justify-center gap-3">
            @auth
                <a href="{{ route('katalog.index') }}"
                   class="inline-flex items-center gap-2 px-7 py-3 rounded-xl bg-emerald-700 text-white font-bold text-sm hover:bg-emerald-800 transition-colors shadow-sm">
                    Jelajahi Katalog
                </a>
            @else
                <a href="{{ route('register') }}"
                   class="inline-flex items-center gap-2 px-7 py-3 rounded-xl bg-emerald-700 text-white font-bold text-sm hover:bg-emerald-800 transition-colors shadow-sm">
                    Bergabung Sekarang
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="{{ route('katalog.index') }}"
                   class="inline-flex items-center gap-2 px-7 py-3 rounded-xl border-2 border-stone-300 text-stone-700 font-semibold text-sm hover:border-emerald-600 hover:text-emerald-700 transition-colors">
                    Lihat Katalog Kebutuhan
                </a>
            @endauth
        </div>
    </div>
</section>

@push('head')
<style>
    @keyframes float-slow {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    @keyframes float-delayed {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }
    .animate-float-slow { animation: float-slow 5s ease-in-out infinite; }
    .animate-float-delayed { animation: float-delayed 6s ease-in-out 1s infinite; }
</style>
@endpush

@endsection
