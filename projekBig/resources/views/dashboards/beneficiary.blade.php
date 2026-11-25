@extends('layouts.app')

@section('title', 'Katalog Donasi - Penerima Manfaat')

@section('content')
<div class="max-w-7xl mx-auto px-5 sm:px-8 py-10 space-y-8">
    <!-- Welcome Editorial Banner -->
    <div class="rounded-2xl bg-forest text-paper p-7 sm:p-10 border border-forest-soft rise">
        <div class="max-w-2xl">
            <p class="flex items-center gap-3 text-[11px] font-semibold uppercase tracking-[.18em] text-[#f0a974] mb-3">
                <span class="h-px w-8 bg-[#f0a974]"></span>
                Katalog Penerima Manfaat
            </p>
            <h1 class="font-display text-4xl sm:text-5xl leading-[1.03] tracking-tight">
                Perlengkapan belajar <em class="text-[#f0a974]">siap disalurkan.</em>
            </h1>
            <p class="text-paper/75 text-sm sm:text-[15px] mt-3 leading-relaxed">
                Temukan buku pelajaran, alat tulis, seragam, dan perangkat sekolah layak pakai yang telah diverifikasi Tim Posko Transit.
            </p>
        </div>
    </div>

    <!-- Search & Reset Bar (F-03: PBI-007, PBI-008, PBI-009) -->
    <form method="GET" action="{{ route('beneficiary.dashboard') }}" class="bg-white rounded-2xl border border-stone-200 p-3 flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">
        <div class="relative flex-1">
            <svg class="w-4 h-4 text-stone-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
                type="text"
                id="beneficiary-search-input"
                name="search"
                value="{{ $search ?? request('search') }}"
                maxlength="100"
                autocomplete="off"
                placeholder="Cari nama barang atau deskripsi yang dibutuhkan..."
                aria-label="Kata kunci pencarian barang donasi"
                class="w-full pl-10 pr-4 py-2.5 bg-paper border border-stone-200 rounded-xl text-sm text-ink placeholder:text-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest transition-all"
            >
        </div>
        <div class="flex items-center gap-2 shrink-0">
            <button type="submit"
                    class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-forest text-paper text-sm font-semibold hover:bg-forest-soft transition duration-300 active:scale-95 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Cari
            </button>
            <button type="button"
                    id="beneficiary-reset-btn"
                    onclick="document.getElementById('beneficiary-search-input').value=''; window.location.href='{{ route('beneficiary.dashboard') }}';"
                    class="{{ filled($search ?? request('search')) ? 'inline-flex' : 'hidden' }} items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl border border-stone-300 bg-paper text-sm font-semibold text-warm hover:text-ink hover:border-forest hover:bg-cream transition duration-300 active:scale-95 cursor-pointer">
                Reset
            </button>
        </div>
    </form>

    <!-- Items Grid Header -->
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3 border-b border-stone-200 pb-4">
        <div>
            <h2 class="font-display text-2xl sm:text-3xl text-ink">Barang Pendidikan Tersedia</h2>
            @if (filled($search ?? request('search')))
                <p class="text-xs text-warm mt-0.5">
                    Menampilkan hasil pencarian untuk <strong class="text-ink">"{{ $search ?? request('search') }}"</strong>
                </p>
            @else
                <p class="text-xs text-warm mt-0.5">Pilih barang untuk melihat informasi detail dan donatur penyedia</p>
            @endif
        </div>
        <span class="text-xs font-semibold text-warm bg-white px-3.5 py-2 rounded-xl border border-stone-200 self-start sm:self-auto">
            <strong class="text-ink">{{ $items->total() }}</strong> Barang Tersedia
        </span>
    </div>

    @if ($items->isEmpty())
        <div class="bg-white rounded-2xl border border-dashed border-stone-300 p-14 text-center">
            @if (filled($search ?? request('search')))
                <p class="font-display text-3xl text-ink">Barang tidak ditemukan.</p>
                <p class="text-sm text-warm max-w-md mx-auto mt-2">
                    Tidak ada barang aktif yang cocok dengan kata kunci <strong class="text-ink">"{{ $search ?? request('search') }}"</strong>.
                </p>
                <div class="mt-6">
                    <a href="{{ route('beneficiary.dashboard') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-forest text-paper text-sm font-semibold hover:bg-forest-soft transition duration-300 active:scale-95">
                        Reset Pencarian &amp; Lihat Semua Barang
                    </a>
                </div>
            @else
                <p class="font-display text-2xl text-ink">Saat ini belum ada barang donasi.</p>
                <p class="text-xs text-warm max-w-sm mx-auto mt-2">
                    Silakan kembali lagi nanti untuk melihat pembaruan donasi perlengkapan pendidikan dari donatur kami.
                </p>
            @endif
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($items as $i => $item)
                <article class="reveal bg-white rounded-xl border border-stone-200 hover:border-stone-300 transition-colors flex flex-col overflow-hidden group" style="--d:{{ ($i % 4) * 60 }}ms">
                    <!-- Thumbnail -->
                    <div class="relative aspect-[4/3] bg-cream overflow-hidden">
                        @if ($item->foto)
                            <img
                                src="{{ $item->foto_url }}"
                                alt="{{ $item->nama_barang }}"
                                loading="lazy"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                            >
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-stone-400 p-4 bg-cream text-center">
                                <span class="font-display text-xl italic text-stone-500">{{ $item->kategori }}</span>
                                <span class="text-[11px] mt-1">Tanpa Foto</span>
                            </div>
                        @endif

                        <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-md text-[10.5px] font-semibold bg-paper/90 text-warm backdrop-blur border border-stone-200">
                            {{ $item->kondisi }}
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="text-[10.5px] font-semibold text-ochre uppercase tracking-[.14em] mb-1.5">
                                {{ $item->kategori }}
                            </div>

                            <h3 class="font-display text-[1.45rem] leading-[1.15] text-ink group-hover:text-forest transition-colors line-clamp-2">
                                {{ $item->nama_barang }}
                            </h3>

                            <p class="text-xs text-warm mt-2 line-clamp-2 leading-relaxed">
                                {{ $item->deskripsi }}
                            </p>
                        </div>

                        <div class="mt-4 pt-4 border-t border-stone-200/80 flex items-center justify-between text-xs">
                            <span class="font-semibold text-ink">
                                {{ $item->jumlah }} Unit
                            </span>

                            <a href="{{ route('items.show', $item->id) }}"
                               class="group/l inline-flex items-center gap-1 font-semibold text-forest hover:text-ochre transition-colors">
                                Lihat Detail
                                <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/l:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        @if ($items->hasPages())
            <div class="mt-8 bg-white rounded-xl border border-stone-200 px-6 py-4">
                {{ $items->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
