@extends('layouts.app')

@section('title', 'Katalog Barang Edukasi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
    <!-- Header Section -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold uppercase tracking-wider mb-3">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Katalog Barang Edukasi Tersedia
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
                    Jelajahi Perlengkapan Pendidikan
                </h1>
                <p class="text-sm text-slate-600 mt-1.5 max-w-2xl">
                    Daftar seluruh barang donasi edukasi layak pakai yang telah terverifikasi dan siap diajukan oleh penerima manfaat.
                </p>
            </div>

            <!-- Info Jumlah & Tombol Switcher Grid / List -->
            <div class="flex items-center justify-between md:justify-end gap-3 shrink-0">
                <span class="text-xs font-medium text-slate-500 bg-slate-100 px-3 py-2 rounded-xl">
                    Menampilkan <strong class="text-slate-800">{{ $items->count() }}</strong> dari <strong class="text-slate-800">{{ $items->total() }}</strong> barang
                </span>

                <div class="inline-flex rounded-xl border border-slate-200 bg-slate-50 p-1" role="group" aria-label="Mode Tampilan">
                    <button type="button" id="btn-grid" onclick="setViewMode('grid')"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-white text-emerald-600 shadow-sm transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Grid
                    </button>
                    <button type="button" id="btn-list" onclick="setViewMode('list')"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:text-slate-900 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        List
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Barang Katalog -->
    @if ($items->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center shadow-sm">
            <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Belum Ada Barang Donasi Tersedia</h3>
            <p class="text-sm text-slate-500 mt-1 max-w-md mx-auto">
                Saat ini belum ada perlengkapan pendidikan yang tersedia di katalog. Silakan cek kembali secara berkala.
            </p>
        </div>
    @else
        <!-- Container Grid / List -->
        <div id="catalog-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($items as $item)
                @php
                    $badgeColor = match (true) {
                        str_contains(strtolower($item->kategori), 'buku pelajaran') => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                        str_contains(strtolower($item->kategori), 'seragam') => 'bg-blue-50 text-blue-700 border-blue-200',
                        str_contains(strtolower($item->kategori), 'peraga') => 'bg-purple-50 text-purple-700 border-purple-200',
                        default => 'bg-amber-50 text-amber-700 border-amber-200',
                    };
                @endphp

                <article class="catalog-card group bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md hover:border-emerald-300 transition-all flex flex-col">
                    <!-- Thumbnail / Foto Barang -->
                    <div class="catalog-thumb relative h-48 bg-slate-100 overflow-hidden shrink-0">
                        @if ($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}"
                                 alt="{{ $item->nama_barang }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-emerald-50 to-teal-50 text-emerald-700/70 p-4 text-center">
                                <svg class="w-10 h-10 mb-1.5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <span class="text-xs font-medium">Foto Barang Edukasi</span>
                            </div>
                        @endif

                        <!-- Badge Kondisi -->
                        <span class="absolute top-3 right-3 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-white/95 text-slate-700 shadow-sm border border-slate-200/80">
                            {{ $item->kondisi }}
                        </span>
                    </div>

                    <!-- Konten Kartu -->
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <!-- Badge Kategori -->
                            <div class="mb-2.5">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-semibold border {{ $badgeColor }}">
                                    {{ $item->kategori }}
                                </span>
                            </div>

                            <!-- Nama Barang -->
                            <h2 class="text-base font-bold text-slate-900 group-hover:text-emerald-600 transition-colors line-clamp-2">
                                {{ $item->nama_barang }}
                            </h2>

                            <!-- Ringkasan Deskripsi -->
                            <p class="text-xs text-slate-600 mt-2 line-clamp-2 leading-relaxed">
                                {{ $item->deskripsi }}
                            </p>
                        </div>

                        <!-- Footer Kartu: Info Stok, Donatur & Tombol Detail -->
                        <div class="mt-4 pt-4 border-t border-slate-100">
                            <div class="flex items-center justify-between text-xs text-slate-500 mb-3">
                                <span class="truncate max-w-[60%]" title="{{ $item->donor->name ?? 'Donatur' }}">
                                    Oleh: <strong class="text-slate-700">{{ $item->donor->name ?? 'Donatur' }}</strong>
                                </span>
                                <span class="font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md">
                                    Stok: {{ $item->jumlah }}
                                </span>
                            </div>

                            @auth
                                <a href="{{ route('items.show', $item->id) }}"
                                   class="w-full inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-semibold text-white bg-emerald-600 hover:bg-emerald-700 shadow-sm shadow-emerald-600/20 transition-all">
                                    Lihat Detail Barang
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                   class="w-full inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 transition-all">
                                    Masuk untuk Lihat Detail
                                </a>
                            @endauth
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        <!-- Pagination: Maksimal 12 item per halaman -->
        @if ($items->hasPages())
            <div class="mt-8 bg-white rounded-2xl border border-slate-200 px-6 py-4 shadow-sm">
                {{ $items->links() }}
            </div>
        @endif
    @endif
</div>
@endsection

@push('scripts')
<script>
    function setViewMode(mode) {
        const container = document.getElementById('catalog-container');
        const cards = document.querySelectorAll('.catalog-card');
        const thumbs = document.querySelectorAll('.catalog-thumb');
        const btnGrid = document.getElementById('btn-grid');
        const btnList = document.getElementById('btn-list');

        if (!container) return;

        if (mode === 'list') {
            container.className = 'flex flex-col gap-4';
            cards.forEach(card => {
                card.classList.remove('flex-col');
                card.classList.add('flex-col', 'sm:flex-row');
            });
            thumbs.forEach(thumb => {
                thumb.classList.remove('h-48');
                thumb.classList.add('h-48', 'sm:h-auto', 'sm:w-56');
            });

            btnList.className = 'inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-white text-emerald-600 shadow-sm transition-all';
            btnGrid.className = 'inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:text-slate-900 transition-all';
        } else {
            container.className = 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6';
            cards.forEach(card => {
                card.classList.remove('sm:flex-row');
            });
            thumbs.forEach(thumb => {
                thumb.classList.remove('sm:h-auto', 'sm:w-56');
                thumb.classList.add('h-48');
            });

            btnGrid.className = 'inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-white text-emerald-600 shadow-sm transition-all';
            btnList.className = 'inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:text-slate-900 transition-all';
        }
    }
</script>
@endpush