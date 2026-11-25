@extends('layouts.app')

@section('title', 'Katalog Barang Edukasi')

@section('content')
<div class="max-w-7xl mx-auto px-5 sm:px-8 pt-10">
    <!-- Editorial Header Section -->
    <div class="pb-8 border-b border-stone-200 mb-8 rise">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
            <div>
                <p class="flex items-center gap-3 text-[11px] font-semibold uppercase tracking-[.18em] text-ochre mb-3">
                    <span class="h-px w-8 bg-ochre"></span>
                    Katalog Barang Edukasi Tersedia
                </p>
                <h1 class="font-display text-4xl sm:text-5xl leading-[1.02] tracking-tight text-ink">
                    Jelajahi perlengkapan <em class="text-ochre">pendidikan.</em>
                </h1>
                <p class="text-sm sm:text-[15px] text-warm mt-3 max-w-2xl leading-relaxed">
                    Daftar seluruh barang donasi layak pakai yang telah lolos pemeriksaan Tim Posko Transit dan siap disalurkan kepada siswa yang membutuhkan.
                </p>
            </div>

            <!-- Info Jumlah & Switcher Grid / List -->
            <div class="flex items-center justify-between md:justify-end gap-3 shrink-0">
                <span class="text-xs font-medium text-warm bg-white border border-stone-200 px-3.5 py-2 rounded-xl">
                    Menampilkan <strong class="text-ink">{{ $items->count() }}</strong> dari <strong class="text-ink">{{ $items->total() }}</strong> barang
                </span>

                <div class="inline-flex rounded-xl border border-stone-200 bg-white p-1" role="group" aria-label="Mode Tampilan">
                    <button type="button" id="btn-grid" onclick="setViewMode('grid')"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-forest text-paper transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Grid
                    </button>
                    <button type="button" id="btn-list" onclick="setViewMode('list')"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-warm hover:text-ink transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        List
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Barang Katalog -->
    @if ($items->isEmpty())
        <div class="bg-white rounded-2xl border border-dashed border-stone-300 p-14 text-center">
            <p class="font-display text-2xl text-ink">Belum ada barang donasi tersedia.</p>
            <p class="text-sm text-warm mt-2 max-w-md mx-auto">
                Saat ini belum ada perlengkapan pendidikan yang tersedia di katalog. Silakan cek kembali secara berkala.
            </p>
        </div>
    @else
        <!-- Container Grid / List -->
        <div id="catalog-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($items as $i => $item)
                <article class="catalog-card reveal group bg-white rounded-xl border border-stone-200 overflow-hidden hover:border-stone-300 transition-colors flex flex-col" style="--d:{{ ($i % 4) * 60 }}ms">
                    <!-- Thumbnail / Foto Barang -->
                    <div class="catalog-thumb relative h-48 bg-cream overflow-hidden shrink-0">
                        @if ($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}"
                                 alt="{{ $item->nama_barang }}"
                                 loading="lazy"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center bg-cream text-stone-400 p-4 text-center">
                                <span class="font-display text-xl italic text-stone-500 line-clamp-2">{{ $item->kategori }}</span>
                                <span class="text-[11px] text-stone-400 mt-1">Foto Barang Edukasi</span>
                            </div>
                        @endif

                        <!-- Badge Kondisi -->
                        <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-md text-[10.5px] font-semibold bg-paper/90 text-warm backdrop-blur border border-stone-200">
                            {{ $item->kondisi }}
                        </span>
                    </div>

                    <!-- Konten Kartu -->
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <p class="text-[10.5px] font-semibold text-ochre uppercase tracking-[.14em] mb-1.5">
                                {{ $item->kategori }}
                            </p>

                            <h2 class="font-display text-[1.45rem] leading-[1.15] text-ink group-hover:text-forest transition-colors line-clamp-2">
                                {{ $item->nama_barang }}
                            </h2>

                            <p class="text-xs text-warm mt-2 line-clamp-2 leading-relaxed">
                                {{ $item->deskripsi }}
                            </p>
                        </div>

                        <!-- Footer Kartu -->
                        <div class="mt-4 pt-4 border-t border-stone-200/80">
                            <div class="flex items-center justify-between text-xs text-warm mb-3">
                                <span class="truncate max-w-[60%]" title="{{ $item->donor->name ?? 'Donatur' }}">
                                    Oleh: <strong class="text-ink">{{ $item->donor->name ?? 'Donatur' }}</strong>
                                </span>
                                <span class="font-semibold text-forest bg-cream px-2 py-0.5 rounded-md border border-stone-200">
                                    Stok: {{ $item->jumlah }}
                                </span>
                            </div>

                            @auth
                                <a href="{{ route('items.show', $item->id) }}"
                                   class="group/btn w-full inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-semibold text-paper bg-forest hover:bg-forest-soft transition duration-300 active:scale-95">
                                    Lihat Detail Barang
                                    <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                   class="group/btn w-full inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-semibold text-forest bg-paper hover:bg-cream border border-stone-300 transition duration-300 active:scale-95">
                                    Masuk untuk Lihat Detail
                                    <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                                    </svg>
                                </a>
                            @endauth
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        @if ($items->hasPages())
            <div class="mt-8 bg-white rounded-xl border border-stone-200 px-6 py-4">
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

        const activeCls = 'inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-forest text-paper transition-all cursor-pointer';
        const idleCls   = 'inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-warm hover:text-ink transition-all cursor-pointer';

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

            btnList.className = activeCls;
            btnGrid.className = idleCls;
        } else {
            container.className = 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6';
            cards.forEach(card => {
                card.classList.remove('sm:flex-row');
            });
            thumbs.forEach(thumb => {
                thumb.classList.remove('sm:h-auto', 'sm:w-56');
                thumb.classList.add('h-48');
            });

            btnGrid.className = activeCls;
            btnList.className = idleCls;
        }
    }
</script>
@endpush
