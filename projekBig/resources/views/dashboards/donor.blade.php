@extends('layouts.app')

@section('title', 'Dashboard Donatur')

@section('content')
<div class="max-w-7xl mx-auto px-5 sm:px-8 py-10 space-y-8">
    <!-- Welcome Editorial Header -->
    <div class="rounded-2xl bg-forest text-paper p-7 sm:p-10 border border-forest-soft rise">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
            <div class="max-w-2xl">
                <p class="flex items-center gap-3 text-[11px] font-semibold uppercase tracking-[.18em] text-[#f0a974] mb-3">
                    <span class="h-px w-8 bg-[#f0a974]"></span>
                    Ruang Donatur PojokBerbagi
                </p>
                <h1 class="font-display text-4xl sm:text-5xl leading-[1.03] tracking-tight">
                    Halo, <em class="text-[#f0a974]">{{ auth()->user()->name }}.</em>
                </h1>
                <p class="text-paper/75 text-sm sm:text-[15px] mt-3 leading-relaxed">
                    Terima kasih atas kepedulian Anda. Setiap barang pendidikan yang Anda donasikan diperiksa Tim Posko Transit sebelum disalurkan kepada siswa yang membutuhkan.
                </p>
            </div>
            <div class="shrink-0">
                <a href="{{ route('items.create') }}"
                   class="group inline-flex items-center gap-2.5 px-6 py-3.5 rounded-xl bg-paper text-forest font-semibold text-sm hover:bg-white transition duration-300 active:scale-95">
                    Posting Barang Donasi
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Metric Strip -->
    <div class="bg-white rounded-2xl border border-stone-200 grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-stone-200 rise" style="--d:80ms">
        <div class="p-6 sm:p-7">
            <div class="text-[11px] font-semibold text-warm uppercase tracking-[.14em]">Total Donasi</div>
            <div class="font-display text-4xl text-ink mt-2 leading-none">{{ $totalPosted }}</div>
            <div class="text-xs text-warm mt-1.5">Semua postingan barang Anda</div>
        </div>
        <div class="p-6 sm:p-7">
            <div class="text-[11px] font-semibold text-ochre uppercase tracking-[.14em]">Verifikasi Transit</div>
            <div class="font-display text-4xl text-ochre mt-2 leading-none">{{ $totalMenungguVerifikasi }}</div>
            <div class="text-xs text-warm mt-1.5">Menunggu pengecekan kelayakan</div>
        </div>
        <div class="p-6 sm:p-7">
            <div class="text-[11px] font-semibold text-forest uppercase tracking-[.14em]">Tersedia / Siap</div>
            <div class="font-display text-4xl text-forest mt-2 leading-none">{{ $totalTersedia }}</div>
            <div class="text-xs text-warm mt-1.5">Sudah tampil di katalog</div>
        </div>
    </div>

    <!-- Table of Donor's Items -->
    <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden reveal">
        <div class="p-6 border-b border-stone-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-display text-2xl text-ink">Daftar Barang Donasi Saya</h2>
                <p class="text-xs text-warm mt-0.5">Kelola dan pantau status seluruh barang donasi yang telah Anda daftarkan</p>
            </div>
            <a href="{{ route('items.create') }}" class="group inline-flex items-center gap-1.5 text-xs font-semibold text-forest hover:text-ochre transition-colors">
                + Tambah Donasi
                <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
            </a>
        </div>

        @if ($items->isEmpty())
            <div class="p-14 text-center">
                <p class="font-display text-2xl text-ink">Belum ada donasi yang diposting.</p>
                <p class="text-xs text-warm max-w-sm mx-auto mt-2 mb-6 leading-relaxed">
                    Mulai posting perlengkapan pendidikan pertama Anda untuk disalurkan kepada siswa yang membutuhkan.
                </p>
                <a href="{{ route('items.create') }}" class="group inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-forest text-paper font-semibold text-xs hover:bg-forest-soft transition duration-300 active:scale-95">
                    Mulai Posting Donasi
                    <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-warm">
                    <thead class="bg-paper text-warm uppercase text-[11px] font-semibold tracking-[.12em] border-b border-stone-200">
                        <tr>
                            <th class="px-6 py-4">Barang</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Kondisi</th>
                            <th class="px-6 py-4">Jumlah</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-200/80">
                        @foreach ($items as $item)
                            <tr class="hover:bg-paper/70 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($item->foto)
                                            <img src="{{ $item->foto_url }}" alt="{{ $item->nama_barang }}" class="w-10 h-10 rounded-lg object-cover border border-stone-200">
                                        @else
                                            <div class="w-10 h-10 rounded-lg bg-cream flex items-center justify-center text-stone-400 border border-stone-200 shrink-0">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <a href="{{ route('items.show', $item->id) }}" class="font-semibold text-ink hover:text-forest transition-colors">
                                                {{ $item->nama_barang }}
                                            </a>
                                            <div class="text-[11px] text-stone-400">
                                                {{ $item->created_at->format('d M Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-xs">{{ $item->kategori }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-2.5 py-0.5 rounded-md text-xs font-medium bg-paper border border-stone-200 text-ink">
                                        {{ $item->kondisi }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-semibold text-ink">{{ $item->jumlah }}</td>
                                <td class="px-6 py-4">
                                    @if ($item->status === 'Menunggu Verifikasi Transit')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-ochre animate-pulse"></span>
                                            Menunggu Verifikasi
                                        </span>
                                    @elseif ($item->status === 'tersedia')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-emerald-50 text-forest border border-forest/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-forest"></span>
                                            Tersedia
                                        </span>
                                    @elseif ($item->status === 'ditolak')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-red-50 text-red-800 border border-red-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                            Ditolak
                                        </span>
                                    @else
                                        <span class="inline-block px-2.5 py-0.5 rounded-md text-xs font-semibold bg-stone-100 text-ink border border-stone-200">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('items.show', $item->id) }}"
                                       class="group inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-forest hover:bg-cream transition-colors">
                                        Detail
                                        <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($items->hasPages())
                <div class="p-4 border-t border-stone-200">
                    {{ $items->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
