@extends('layouts.app')

@section('title', 'Katalog Donasi - Penerima Manfaat')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Welcome Header -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-8 sm:p-10 shadow-lg shadow-blue-500/15 mb-8">
        <div class="relative z-10 max-w-2xl">
            <span class="inline-block px-3 py-1 rounded-full bg-white/20 text-white text-xs font-semibold backdrop-blur mb-3">
                Katalog Penerima Manfaat
            </span>
            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight">Katalog Barang Donasi Pendidikan</h1>
            <p class="text-blue-100 text-sm sm:text-base mt-2 leading-relaxed">
                Temukan buku pelajaran, alat tulis, seragam, dan perlengkapan sekolah yang disalurkan dengan penuh cinta oleh para donatur.
            </p>
        </div>
        <div class="absolute -right-12 -bottom-12 w-64 h-64 rounded-full bg-white/10 pointer-events-none"></div>
    </div>

    <!-- Items Grid Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Barang Pendidikan Tersedia</h2>
            <p class="text-xs text-slate-500 mt-0.5">Pilih barang untuk melihat informasi detail dan donatur penyedia</p>
        </div>
        <span class="text-xs font-semibold text-slate-500 bg-white px-3 py-1.5 rounded-xl border border-slate-200">
            {{ $items->total() }} Barang Tersedia
        </span>
    </div>

    @if ($items->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center">
            <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-500 mx-auto flex items-center justify-center mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <h3 class="text-base font-bold text-slate-800">Saat Ini Belum Ada Barang Donasi</h3>
            <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1">
                Silakan kembali lagi nanti untuk melihat pembaruan donasi barang pendidikan dari donatur kami.
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($items as $item)
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all flex flex-col overflow-hidden group">
                    <!-- Thumbnail -->
                    <div class="relative aspect-video bg-slate-100 overflow-hidden">
                        @if ($item->foto)
                            <img
                                src="{{ $item->foto_url }}"
                                alt="{{ $item->nama_barang }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            >
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 p-4 bg-slate-50">
                                <svg class="w-10 h-10 text-slate-300 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-[11px]">Tanpa Foto</span>
                            </div>
                        @endif

                        <!-- Kondisi Badge -->
                        <span class="absolute top-2.5 right-2.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-white/90 text-slate-800 backdrop-blur shadow-sm border border-slate-200/50">
                            {{ $item->kondisi }}
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <!-- Kategori -->
                            <div class="text-[11px] font-semibold text-emerald-600 uppercase tracking-wider mb-1">
                                {{ $item->kategori }}
                            </div>

                            <!-- Nama Barang -->
                            <h3 class="font-bold text-slate-900 group-hover:text-emerald-600 transition-colors line-clamp-1 text-base">
                                {{ $item->nama_barang }}
                            </h3>

                            <!-- Deskripsi Singkat -->
                            <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">
                                {{ $item->deskripsi }}
                            </p>
                        </div>

                        <!-- Footer -->
                        <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="font-bold text-slate-800">
                                {{ $item->jumlah }} Unit
                            </span>

                            <a
                                href="{{ route('items.show', $item->id) }}"
                                class="inline-flex items-center gap-1 font-semibold text-emerald-600 hover:text-emerald-700 transition-colors"
                            >
                                Lihat Detail
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($items->hasPages())
            <div class="mt-8">
                {{ $items->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
