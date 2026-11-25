@extends(auth()->check() && auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.app')
@section('page-title', 'Detail Barang Donasi')

@section('title', 'Detail Barang - ' . $item->nama_barang)

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Breadcrumb & Back Button -->
    <div class="flex items-center justify-between mb-6">
        <nav class="flex items-center gap-2 text-xs text-slate-500">
            @auth
                @if (auth()->user()->isDonor())
                    <a href="{{ route('donor.dashboard') }}" class="hover:text-emerald-600 transition-colors">Dashboard Donatur</a>
                @elseif (auth()->user()->isBeneficiary())
                    <a href="{{ route('beneficiary.dashboard') }}" class="hover:text-emerald-600 transition-colors">Katalog Donasi</a>
                @elseif (auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition-colors">Dashboard Admin</a>
                @endif
                <span>/</span>
            @endauth
            <span class="text-slate-800 font-semibold truncate max-w-xs">{{ $item->nama_barang }}</span>
        </nav>

        @auth
            <a href="{{ url()->previous(route('dashboard')) }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-emerald-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        @endauth
    </div>

    <!-- Main Detail Card -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
            <!-- Left Column: Item Image -->
            <div class="bg-slate-100 flex items-center justify-center p-6 sm:p-10 border-b md:border-b-0 md:border-r border-slate-200">
                @if ($item->foto)
                    <div class="relative w-full aspect-square max-w-md rounded-2xl overflow-hidden shadow-sm bg-white">
                        <img
                            src="{{ $item->foto_url }}"
                            alt="{{ $item->nama_barang }}"
                            class="w-full h-full object-cover"
                        >
                    </div>
                @else
                    <div class="w-full aspect-square max-w-md rounded-2xl bg-gradient-to-br from-slate-50 to-slate-200 border-2 border-dashed border-slate-300 flex flex-col items-center justify-center text-slate-400 p-6 text-center">
                        <svg class="w-16 h-16 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs font-medium text-slate-500">Tidak ada foto barang yang diunggah</span>
                        <span class="text-[11px] text-slate-400 mt-1">Donatur tidak melampirkan foto</span>
                    </div>
                @endif
            </div>

            <!-- Right Column: Item Information -->
            <div class="p-6 sm:p-10 flex flex-col justify-between">
                <div>
                    <!-- Badges Row -->
                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        <!-- Kategori Badge -->
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            {{ $item->kategori }}
                        </span>

                        <!-- Kondisi Badge -->
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                            Kondisi: {{ $item->kondisi }}
                        </span>

                        <!-- Status Badge -->
                        @if ($item->status === 'Menunggu Verifikasi Transit')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-300">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                Menunggu Verifikasi Transit
                            </span>
                        @elseif ($item->status === 'tersedia')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-teal-50 text-teal-700 border border-teal-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-teal-500 animate-pulse"></span>
                                Tersedia
                            </span>
                        @elseif ($item->status === 'diproses')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-sky-50 text-sky-700 border border-sky-200">
                                Sedang Diproses
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                {{ $item->status }}
                            </span>
                        @endif
                    </div>

                    <!-- Item Name -->
                    <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-slate-900 mb-4 leading-tight">
                        {{ $item->nama_barang }}
                    </h1>

                    <!-- Key Details Grid -->
                    <div class="grid grid-cols-2 gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-200/80 mb-6">
                        <div>
                            <div class="text-xs text-slate-500 font-medium">Jumlah Tersedia</div>
                            <div class="text-lg font-bold text-slate-900 mt-0.5">
                                {{ $item->jumlah }} <span class="text-xs font-normal text-slate-500">Unit / Paket</span>
                            </div>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500 font-medium">Tanggal Diposting</div>
                            <div class="text-sm font-semibold text-slate-800 mt-1">
                                {{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }}
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h2 class="text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">Deskripsi Barang</h2>
                        <div class="text-sm text-slate-600 leading-relaxed whitespace-pre-line bg-white rounded-xl border border-slate-100 p-4">
                            {{ $item->deskripsi }}
                        </div>
                    </div>

                    <!-- Informasi Posko Transit & Jadwal Penyerahan -->
                    <div class="mb-6 p-4 rounded-2xl bg-amber-50/70 border border-amber-200">
                        <div class="text-xs font-bold text-amber-900 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Informasi Posko Transit & Jadwal Penyerahan
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                            <div class="bg-white p-3 rounded-xl border border-amber-100">
                                <span class="text-slate-500 block mb-0.5">Titik Lokasi Posko Transit:</span>
                                <span class="font-bold text-slate-800">{{ $item->lokasi_posko ?? 'Posko Belum Ditentukan' }}</span>
                            </div>
                            <div class="bg-white p-3 rounded-xl border border-amber-100">
                                <span class="text-slate-500 block mb-0.5">Jadwal Tanggal Penyerahan:</span>
                                <span class="font-bold text-slate-800">
                                    {{ $item->jadwal_penyerahan ? $item->jadwal_penyerahan->format('d M Y') : 'Belum Ditentukan' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Donor Information Box -->
                <div class="pt-6 border-t border-slate-100">
                    <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Informasi Donatur</div>
                    <div class="flex items-center gap-3 p-3.5 rounded-2xl bg-slate-50 border border-slate-200">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-400 text-white flex items-center justify-center font-bold text-sm">
                            {{ $item->donor ? strtoupper(substr($item->donor->name, 0, 1)) : 'D' }}
                        </div>
                        <div class="flex-1">
                            <div class="text-sm font-bold text-slate-900">{{ $item->donor->name ?? 'Donatur PojokBerbagi' }}</div>
                            <div class="text-xs text-slate-500 flex items-center gap-2">
                                <span>Terverifikasi sebagai Donatur</span>
                                <span>&bull;</span>
                                <span>{{ $item->donor->email ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
