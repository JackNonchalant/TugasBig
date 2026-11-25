@extends('layouts.app')

@section('title', 'Dashboard Donatur')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Welcome Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white p-8 sm:p-10 shadow-lg shadow-emerald-500/15 mb-8">
        <div class="relative z-10 max-w-2xl">
            <span class="inline-block px-3 py-1 rounded-full bg-white/20 text-white text-xs font-semibold backdrop-blur mb-3">
                Ruang Donatur PojokBerbagi
            </span>
            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight">Halo, {{ auth()->user()->name }}!</h1>
            <p class="text-emerald-100 text-sm sm:text-base mt-2 leading-relaxed">
                Terima kasih atas kepedulian Anda. Setiap barang pendidikan yang Anda donasikan membuka jalan harapan belajar bagi anak-anak bangsa.
            </p>
            <div class="mt-6 flex flex-wrap items-center gap-4">
                <a
                    href="{{ route('items.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white text-emerald-700 font-bold text-sm shadow-md hover:bg-emerald-50 transition-all cursor-pointer"
                >
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Posting Barang Donasi Baru
                </a>
            </div>
        </div>

        <!-- Decorative Illustration Background -->
        <div class="absolute -right-12 -bottom-12 w-64 h-64 rounded-full bg-white/10 pointer-events-none"></div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Donasi</div>
                <div class="text-3xl font-bold text-slate-900 mt-1">{{ $totalPosted }}</div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-slate-50 text-slate-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
        </div>
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <div class="text-xs font-semibold text-amber-600 uppercase tracking-wider">Verifikasi Transit</div>
                <div class="text-3xl font-bold text-amber-600 mt-1">{{ $totalMenungguVerifikasi }}</div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <div class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Tersedia / Siap</div>
                <div class="text-3xl font-bold text-emerald-600 mt-1">{{ $totalTersedia }}</div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Table of Donor's Items -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Daftar Barang Donasi Saya</h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola postingan barang donasi yang telah Anda daftarkan</p>
            </div>
            <a href="{{ route('items.create') }}" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 flex items-center gap-1">
                + Tambah Donasi
            </a>
        </div>

        @if ($items->isEmpty())
            <div class="p-12 text-center">
                <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-500 mx-auto flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-800">Belum Ada Donasi yang Diposting</h3>
                <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1 mb-6">
                    Mulai posting perlengkapan pendidikan pertama Anda untuk disalurkan ke adik-adik yang membutuhkan.
                </p>
                <a href="{{ route('items.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 text-white font-semibold text-xs shadow-md hover:bg-emerald-700 transition-all">
                    Mulai Posting Donasi
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-[11px] font-bold tracking-wider border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4">Barang</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Kondisi</th>
                            <th class="px-6 py-4">Jumlah</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($items as $item)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($item->foto)
                                            <img src="{{ $item->foto_url }}" alt="{{ $item->nama_barang }}" class="w-10 h-10 rounded-lg object-cover border border-slate-200">
                                        @else
                                            <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <a href="{{ route('items.show', $item->id) }}" class="font-bold text-slate-900 hover:text-emerald-600 transition-colors">
                                                {{ $item->nama_barang }}
                                            </a>
                                            <div class="text-[11px] text-slate-400">
                                                {{ $item->created_at->format('d M Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-xs">{{ $item->kategori }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                        {{ $item->kondisi }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-900">{{ $item->jumlah }}</td>
                                <td class="px-6 py-4">
                                    @if ($item->status === 'Menunggu Verifikasi Transit')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Menunggu Verifikasi Transit
                                        </span>
                                    @elseif ($item->status === 'tersedia')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a
                                        href="{{ route('items.show', $item->id) }}"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-emerald-600 hover:bg-emerald-50 transition-colors"
                                    >
                                        Detail
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($items->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $items->links() }}
                </div>
            @endif
        @endif
    </div>
</body>
</html>
