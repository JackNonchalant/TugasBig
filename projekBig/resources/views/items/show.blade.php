@extends(auth()->check() && auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.app')
@section('page-title', 'Detail Barang Donasi')

@section('title', 'Detail Barang - ' . $item->nama_barang)

@section('content')
<div class="{{ auth()->check() && auth()->user()->isAdmin() ? 'max-w-5xl mx-auto' : 'max-w-5xl mx-auto px-5 sm:px-8 py-10' }}">
    <!-- Breadcrumb & Back Button -->
    <div class="flex items-center justify-between mb-6">
        <nav class="flex items-center gap-2 text-xs text-warm">
            @auth
                @if (auth()->user()->isDonor())
                    <a href="{{ route('donor.dashboard') }}" class="hover:text-forest transition-colors">Dashboard Donatur</a>
                @elseif (auth()->user()->isBeneficiary())
                    <a href="{{ route('beneficiary.dashboard') }}" class="hover:text-forest transition-colors">Katalog Donasi</a>
                @elseif (auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-forest transition-colors">Dashboard Admin</a>
                @endif
                <span>/</span>
            @endauth
            <span class="text-ink font-semibold truncate max-w-xs">{{ $item->nama_barang }}</span>
        </nav>

        @auth
            <a href="{{ url()->previous(route('dashboard')) }}" class="group inline-flex items-center gap-1.5 text-xs font-semibold text-warm hover:text-forest transition-colors">
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        @endauth
    </div>

    <!-- Main Detail Card -->
    <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden rise">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
            <!-- Left Column: Item Image -->
            <div class="bg-cream/70 flex items-center justify-center p-6 sm:p-10 border-b md:border-b-0 md:border-r border-stone-200">
                @if ($item->foto)
                    <div class="relative w-full aspect-square max-w-md rounded-xl overflow-hidden border border-stone-200 bg-white group">
                        <img
                            src="{{ $item->foto_url }}"
                            alt="{{ $item->nama_barang }}"
                            class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                        >
                    </div>
                @else
                    <div class="w-full aspect-square max-w-md rounded-xl bg-paper border border-dashed border-stone-300 flex flex-col items-center justify-center text-stone-400 p-6 text-center">
                        <span class="font-display text-2xl italic text-stone-500 mb-1">{{ $item->kategori }}</span>
                        <span class="text-xs text-warm">Tidak ada foto barang yang diunggah</span>
                    </div>
                @endif
            </div>

            <!-- Right Column: Item Information -->
            <div class="p-6 sm:p-10 flex flex-col justify-between">
                <div>
                    <!-- Badges Row -->
                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11px] font-semibold uppercase tracking-[.12em] bg-cream text-ochre border border-stone-200">
                            {{ $item->kategori }}
                        </span>

                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-paper text-warm border border-stone-200">
                            Kondisi: {{ $item->kondisi }}
                        </span>

                        @if ($item->status === 'Menunggu Verifikasi Transit')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-ochre animate-pulse"></span>
                                Menunggu Verifikasi Transit
                            </span>
                        @elseif ($item->status === 'tersedia')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-emerald-50 text-forest border border-forest/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-forest"></span>
                                Tersedia
                            </span>
                        @elseif ($item->status === 'diproses' || $item->status === 'Dalam Proses Penyaluran')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-sky-50 text-sky-900 border border-sky-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-sky-600 animate-pulse"></span>
                                {{ $item->status === 'diproses' ? 'Sedang Diproses' : $item->status }}
                            </span>
                        @elseif ($item->status === 'ditolak')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-red-50 text-red-800 border border-red-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                Ditolak
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-stone-100 text-ink border border-stone-200">
                                {{ ucfirst($item->status) }}
                            </span>
                        @endif
                    </div>

                    <!-- Item Name -->
                    <h1 class="font-display text-3xl sm:text-4xl leading-[1.08] tracking-tight text-ink mb-5">
                        {{ $item->nama_barang }}
                    </h1>

                    <!-- Key Details Grid -->
                    <div class="grid grid-cols-2 gap-4 p-4 rounded-xl bg-paper border border-stone-200 mb-6">
                        <div>
                            <div class="text-[11px] text-warm uppercase tracking-wider font-semibold">Jumlah Tersedia</div>
                            <div class="font-display text-2xl text-forest mt-0.5">
                                {{ $item->jumlah }} <span class="font-sans text-xs font-medium text-warm">Unit / Paket</span>
                            </div>
                        </div>
                        <div>
                            <div class="text-[11px] text-warm uppercase tracking-wider font-semibold">Tanggal Diposting</div>
                            <div class="text-sm font-semibold text-ink mt-1.5">
                                {{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }}
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h2 class="text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">Deskripsi Barang</h2>
                        <div class="text-sm text-warm leading-relaxed whitespace-pre-line bg-paper rounded-xl border border-stone-200 p-4">
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
                <div class="pt-6 border-t border-stone-200 space-y-4">
                    <div>
                        <div class="text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2.5">Informasi Donatur</div>
                        <div class="flex items-center gap-3 p-3.5 rounded-xl bg-paper border border-stone-200">
                            <div class="w-10 h-10 rounded-full bg-forest text-paper flex items-center justify-center font-bold text-sm shrink-0">
                                {{ $item->donor ? strtoupper(substr($item->donor->name, 0, 1)) : 'D' }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-semibold text-ink truncate">{{ $item->donor->name ?? 'Donatur PojokBerbagi' }}</div>
                                <div class="text-xs text-warm truncate">
                                    Terverifikasi sebagai Donatur &bull; {{ $item->donor->email ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (auth()->check() && auth()->user()->isAdmin() && $item->status === 'tersedia')
                        <a href="{{ route('admin.distributions.create', ['item_id' => $item->id]) }}"
                           class="group w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-forest text-paper text-sm font-semibold hover:bg-forest-soft transition duration-300 active:scale-95">
                            Salurkan Barang Ini
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
