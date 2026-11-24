<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="web_dashboard" name="shell-type"/>
    <title>Verifikasi Barang Posko Transit - PojokBerbagi</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Plus+Jakarta+Sans:wght@600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>

    <style>
        @layer base {
            html, body { margin:0; padding:0; }
            body { overscroll-behavior:none; }
            main > :first-child { margin-top:0 !important; }
            main > :last-child { margin-bottom:0 !important; }
        }
        ::-webkit-scrollbar { display:none; }
    </style>

    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-tertiary": "#ffffff",
                        "primary-container": "#245c46",
                        "primary-fixed": "#b5efd2",
                        "surface-dim": "#d7dbd6",
                        "on-tertiary-fixed-variant": "#6a3b00",
                        "tertiary-fixed-dim": "#ffb872",
                        "surface-container": "#ebefea",
                        "on-surface": "#181d1a",
                        "on-background": "#181d1a",
                        "on-primary-fixed-variant": "#16503b",
                        "surface-variant": "#dfe4df",
                        "surface-bright": "#f6faf5",
                        "on-error": "#ffffff",
                        "on-surface-variant": "#404944",
                        "surface-container-high": "#e5e9e4",
                        "outline-variant": "#c0c9c2",
                        "surface-tint": "#316852",
                        "on-secondary-container": "#5e6661",
                        "error": "#ba1a1a",
                        "tertiary-container": "#794605",
                        "on-secondary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "tertiary": "#5a3100",
                        "inverse-on-surface": "#edf2ed",
                        "on-secondary-fixed": "#151d19",
                        "surface-container-low": "#f0f5f0",
                        "secondary-container": "#dce5de",
                        "on-tertiary-fixed": "#2d1600",
                        "tertiary-fixed": "#ffdcbf",
                        "surface-container-highest": "#dfe4df",
                        "inverse-surface": "#2d322e",
                        "on-primary": "#ffffff",
                        "secondary-fixed": "#dce5de",
                        "background": "#f6faf5",
                        "on-primary-container": "#99d2b6",
                        "primary": "#044430",
                        "on-secondary-fixed-variant": "#404944",
                        "secondary-fixed-dim": "#c0c9c2",
                        "error-container": "#ffdad6",
                        "outline": "#707973",
                        "on-tertiary-container": "#ffb770",
                        "inverse-primary": "#99d3b7",
                        "secondary": "#58605b",
                        "on-primary-fixed": "#002115",
                        "primary-fixed-dim": "#99d3b7",
                        "on-error-container": "#93000a",
                        "surface": "#f6faf5"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "space-xs": "0.25rem",
                        "gutter": "1.5rem",
                        "space-lg": "1.5rem",
                        "space-md": "1rem",
                        "space-xl": "2.5rem",
                        "space-sm": "0.5rem",
                        "margin": "1.5rem"
                    },
                    fontFamily: {
                        "label-md": ["Inter"],
                        "label-sm": ["Inter"],
                        "label-lg": ["Inter"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "body-md": ["Inter"],
                        "body-sm": ["Inter"],
                        "title-md": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Inter"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "headline-sm": ["Plus Jakarta Sans"]
                    },
                    fontSize: {
                        "label-md": ["12px", { lineHeight: "16px", letterSpacing: "0.02em", fontWeight: "500" }],
                        "label-sm": ["11px", { lineHeight: "16px", letterSpacing: "0.04em", fontWeight: "600" }],
                        "label-lg": ["14px", { lineHeight: "20px", letterSpacing: "0em", fontWeight: "500" }],
                        "headline-lg-mobile": ["30px", { lineHeight: "38px", letterSpacing: "-0.02em", fontWeight: "700" }],
                        "body-md": ["15px", { lineHeight: "24px", letterSpacing: "0em", fontWeight: "400" }],
                        "body-sm": ["13px", { lineHeight: "20px", letterSpacing: "0em", fontWeight: "400" }],
                        "title-md": ["16px", { lineHeight: "24px", letterSpacing: "0em", fontWeight: "600" }],
                        "headline-md": ["28px", { lineHeight: "36px", letterSpacing: "-0.015em", fontWeight: "600" }],
                        "body-lg": ["18px", { lineHeight: "28px", letterSpacing: "0em", fontWeight: "400" }],
                        "headline-lg": ["40px", { lineHeight: "48px", letterSpacing: "-0.02em", fontWeight: "700" }],
                        "headline-sm": ["20px", { lineHeight: "28px", letterSpacing: "-0.01em", fontWeight: "600" }]
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-surface font-body-md text-body-md text-on-surface">

    <!-- Sidebar Navigation -->
    <aside class="fixed left-0 top-0 h-full w-64 bg-surface-container-low z-50 flex flex-col py-space-lg overflow-y-auto border-r border-outline-variant/20">
        <div class="px-6 mb-space-lg flex items-center gap-space-sm">
            <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-primary text-on-primary shadow-sm font-bold text-lg">P</span>
            <span class="font-headline-sm text-headline-sm text-primary tracking-tight">PojokBerbagi</span>
        </div>

        <nav class="flex-1 px-3 space-y-1">
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('home') }}">
                <span class="material-symbols-outlined mr-3 text-xl">home</span>Beranda Utama
            </a>
            <a aria-current="page" class="flex items-center px-3 py-2.5 transition-all bg-primary-container text-on-primary-container font-bold rounded-lg shadow-sm" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined mr-3 text-xl">fact_check</span>Verifikasi Barang
            </a>
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('permintaan.index') }}">
                <span class="material-symbols-outlined mr-3 text-xl">admin_panel_settings</span>Posko Transit
            </a>
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('donor.dashboard') }}">
                <span class="material-symbols-outlined mr-3 text-xl">dashboard</span>Dashboard Donatur
            </a>
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('beneficiary.dashboard') }}">
                <span class="material-symbols-outlined mr-3 text-xl">volunteer_activism</span>Katalog Penerima
            </a>
        </nav>

        <div class="px-4 pt-4 border-t border-outline-variant/20">
            <div class="flex items-center gap-3 p-2 rounded-xl bg-surface-container mb-3">
                <div class="w-9 h-9 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold text-sm">
                    {{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-on-surface truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                    <p class="text-xs text-primary font-medium capitalize">Posko Verifikator</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-lg text-error hover:bg-error-container/30 transition-colors text-sm font-semibold">
                    <span class="material-symbols-outlined text-lg">logout</span>Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="pl-64">
        <!-- Top bar -->
        <header class="fixed top-0 left-64 right-0 h-16 bg-surface/80 backdrop-blur-xl border-b border-outline-variant/20 shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-40 px-8 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-semibold text-on-surface-variant uppercase tracking-wider">Sistem Kurasi Posko Aktif</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('permintaan.index') }}" class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-surface-container-high hover:bg-surface-container text-on-surface flex items-center gap-1.5 transition-colors">
                    <span class="material-symbols-outlined text-sm">local_shipping</span>Lacak Posko Transit
                </a>
            </div>
        </header>

        <main class="relative w-full px-8 pt-20 pb-16 bg-surface">
            <!-- Flash Notification Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-center gap-3 shadow-sm animate-fade-in">
                    <span class="material-symbols-outlined text-emerald-600 text-2xl">check_circle</span>
                    <div class="text-sm font-medium">{{ session('success') }}</div>
                </div>
            @endif

            @if(session('warning'))
                <div class="mb-6 p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 flex items-center gap-3 shadow-sm">
                    <span class="material-symbols-outlined text-amber-600 text-2xl">warning</span>
                    <div class="text-sm font-medium">{{ session('warning') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-900 flex items-center gap-3 shadow-sm">
                    <span class="material-symbols-outlined text-red-600 text-2xl">error</span>
                    <div class="text-sm font-medium">{{ session('error') }}</div>
                </div>
            @endif

            <div class="flex flex-col w-full gap-space-lg">
                <!-- Page Title & Top Stats -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md pt-2">
                    <div>
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary font-semibold">Posko Transit • Kurasi Kualitas Barang</span>
                        <h1 class="font-headline-md text-headline-md text-on-surface mt-1">Verifikasi Barang Donasi</h1>
                    </div>
                    <div class="flex items-center gap-3 flex-wrap">
                        <div class="flex items-center gap-space-sm bg-surface-container-lowest px-4 py-2.5 rounded-xl shadow-sm border border-outline-variant/30">
                            <span class="material-symbols-outlined text-primary-container text-xl">pending_actions</span>
                            <div class="flex flex-col">
                                <span class="font-label-sm text-label-sm text-on-surface-variant">Antrean Transit</span>
                                <span class="font-title-md text-title-md text-on-surface tabular-nums font-bold">{{ $pendingItems->count() }} Barang</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-space-sm bg-surface-container-lowest px-4 py-2.5 rounded-xl shadow-sm border border-outline-variant/30">
                            <span class="material-symbols-outlined text-emerald-700 text-xl">verified</span>
                            <div class="flex flex-col">
                                <span class="font-label-sm text-label-sm text-on-surface-variant">Lolos Kurasi</span>
                                <span class="font-title-md text-title-md text-on-surface tabular-nums font-bold">{{ $approvedItems->count() }} Barang</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-space-sm bg-surface-container-lowest px-4 py-2.5 rounded-xl shadow-sm border border-outline-variant/30">
                            <span class="material-symbols-outlined text-error text-xl">cancel</span>
                            <div class="flex flex-col">
                                <span class="font-label-sm text-label-sm text-on-surface-variant">Ditolak</span>
                                <span class="font-title-md text-title-md text-on-surface tabular-nums font-bold">{{ $rejectedItems->count() }} Barang</span>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $firstItem = $pendingItems->first() ?? $approvedItems->first() ?? $rejectedItems->first();
                @endphp

                <!-- 2-Column Split: Queue list & Detailed Inspection -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg items-start">
                    
                    <!-- Left Column: Tabs & Item Queue (5 cols) -->
                    <div class="lg:col-span-5 flex flex-col gap-3 bg-surface-container-low rounded-2xl p-4 border border-outline-variant/30">
                        <!-- Tab Selector -->
                        <div class="flex items-center bg-surface-container p-1 rounded-xl">
                            <button id="tab-pending" class="tab-btn flex-1 py-2 px-3 text-center rounded-lg font-label-md text-label-md transition-all bg-surface-container-lowest text-primary font-bold shadow-sm" type="button" data-target="list-pending">
                                Menunggu ({{ $pendingItems->count() }})
                            </button>
                            <button id="tab-approved" class="tab-btn flex-1 py-2 px-3 text-center rounded-lg font-label-md text-label-md transition-all text-on-surface-variant hover:text-on-surface" type="button" data-target="list-approved">
                                Disetujui ({{ $approvedItems->count() }})
                            </button>
                            <button id="tab-rejected" class="tab-btn flex-1 py-2 px-3 text-center rounded-lg font-label-md text-label-md transition-all text-on-surface-variant hover:text-on-surface" type="button" data-target="list-rejected">
                                Ditolak ({{ $rejectedItems->count() }})
                            </button>
                        </div>

                        <!-- Queue Search Box -->
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-2.5 text-outline text-lg">search</span>
                            <input id="queue-search" type="text" placeholder="Cari nama barang atau donatur..." class="w-full pl-9 pr-3 py-2 rounded-xl bg-surface-container-lowest text-on-surface text-sm border border-outline-variant/20 focus:outline-none focus:ring-2 focus:ring-primary"/>
                        </div>

                        <!-- Tab 1: Menunggu Verifikasi Items -->
                        <div id="list-pending" class="queue-tab-content space-y-2.5 max-h-[620px] overflow-y-auto pr-1">
                            @forelse($pendingItems as $idx => $item)
                                <button class="queue-item w-full text-left flex items-start gap-3 p-3 rounded-xl transition-all border {{ $idx === 0 ? 'bg-surface-container-lowest border-primary shadow-sm' : 'bg-surface-container-lowest/70 border-transparent hover:bg-surface-container-lowest' }}"
                                        type="button"
                                        data-item-id="{{ $item->id }}"
                                        data-title="{{ $item->nama_barang }}"
                                        data-code="#PB-{{ date('Y') }}-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}"
                                        data-meta="Kategori: {{ $item->kategori }} • Kondisi: {{ $item->kondisi }} • Diajukan {{ $item->created_at->format('d M Y') }}"
                                        data-donor="{{ $item->donor->name ?? 'Donatur' }}"
                                        data-initials="{{ strtoupper(substr($item->donor->name ?? 'D', 0, 2)) }}"
                                        data-contact="{{ $item->donor->email ?? '-' }} • {{ $item->lokasi_posko ?? 'Posko Transit' }}"
                                        data-posko="{{ $item->lokasi_posko ?? 'Posko Belum Ditentukan' }}"
                                        data-jadwal="{{ $item->jadwal_penyerahan ? $item->jadwal_penyerahan->format('d M Y') : 'Belum Ditentukan' }}"
                                        data-jumlah="{{ $item->jumlah }}"
                                        data-deskripsi="{{ $item->deskripsi }}"
                                        data-foto="{{ $item->foto_url ?? 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=800&q=80' }}"
                                        data-status="Menunggu Verifikasi"
                                        data-status-class="bg-tertiary-fixed text-on-tertiary-fixed-variant"
                                        data-action-url="{{ route('admin.items.verify', $item->id) }}"
                                        data-can-verify="1">
                                    <img class="w-14 h-14 rounded-lg object-cover shrink-0 bg-surface-container"
                                         src="{{ $item->foto_url ?? 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=200&q=80' }}"
                                         alt="{{ $item->nama_barang }}"/>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between gap-2">
                                            <h3 class="font-label-lg text-label-lg text-on-surface font-semibold truncate">{{ $item->nama_barang }}</h3>
                                            <span class="shrink-0 px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 font-label-sm text-label-sm font-semibold">Menunggu</span>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant truncate mt-0.5">{{ $item->donor->name ?? 'Donatur' }} • {{ $item->kategori }}</p>
                                        <div class="flex items-center gap-2 mt-1.5">
                                            <span class="font-label-sm text-label-sm text-primary-container bg-primary-fixed/50 px-2 py-0.5 rounded-md font-medium">{{ $item->kondisi }}</span>
                                            <span class="font-label-sm text-label-sm text-outline">{{ $item->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </button>
                            @empty
                                <div class="p-8 text-center bg-surface-container-lowest rounded-xl">
                                    <span class="material-symbols-outlined text-4xl text-outline mb-2">task_alt</span>
                                    <p class="text-sm font-semibold text-on-surface">Tidak ada antrean tertunda</p>
                                    <p class="text-xs text-on-surface-variant mt-1">Semua donasi transit telah selesai diverifikasi.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Tab 2: Disetujui Items (Hidden by default) -->
                        <div id="list-approved" class="queue-tab-content space-y-2.5 max-h-[620px] overflow-y-auto pr-1 hidden">
                            @forelse($approvedItems as $item)
                                <button class="queue-item w-full text-left flex items-start gap-3 p-3 rounded-xl bg-surface-container-lowest/70 hover:bg-surface-container-lowest transition-all border border-transparent"
                                        type="button"
                                        data-item-id="{{ $item->id }}"
                                        data-title="{{ $item->nama_barang }}"
                                        data-code="#PB-{{ date('Y') }}-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}"
                                        data-meta="Kategori: {{ $item->kategori }} • Kondisi: {{ $item->kondisi }} • Disetujui {{ $item->updated_at->format('d M Y') }}"
                                        data-donor="{{ $item->donor->name ?? 'Donatur' }}"
                                        data-initials="{{ strtoupper(substr($item->donor->name ?? 'D', 0, 2)) }}"
                                        data-contact="{{ $item->donor->email ?? '-' }} • {{ $item->lokasi_posko ?? 'Posko Transit' }}"
                                        data-posko="{{ $item->lokasi_posko ?? 'Posko Belum Ditentukan' }}"
                                        data-jadwal="{{ $item->jadwal_penyerahan ? $item->jadwal_penyerahan->format('d M Y') : 'Belum Ditentukan' }}"
                                        data-jumlah="{{ $item->jumlah }}"
                                        data-deskripsi="{{ $item->deskripsi }}"
                                        data-foto="{{ $item->foto_url ?? 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=800&q=80' }}"
                                        data-status="Disetujui (Katalog)"
                                        data-status-class="bg-emerald-100 text-emerald-800"
                                        data-action-url="{{ route('admin.items.verify', $item->id) }}"
                                        data-can-verify="0">
                                    <img class="w-14 h-14 rounded-lg object-cover shrink-0 bg-surface-container"
                                         src="{{ $item->foto_url ?? 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=200&q=80' }}"
                                         alt="{{ $item->nama_barang }}"/>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between gap-2">
                                            <h3 class="font-label-lg text-label-lg text-on-surface font-semibold truncate">{{ $item->nama_barang }}</h3>
                                            <span class="shrink-0 px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 font-label-sm text-label-sm font-semibold">Tersedia</span>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant truncate mt-0.5">{{ $item->donor->name ?? 'Donatur' }} • {{ $item->kategori }}</p>
                                        <div class="flex items-center gap-2 mt-1.5">
                                            <span class="font-label-sm text-label-sm text-primary-container bg-primary-fixed/50 px-2 py-0.5 rounded-md font-medium">{{ $item->kondisi }}</span>
                                            <span class="font-label-sm text-label-sm text-outline">{{ $item->updated_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </button>
                            @empty
                                <div class="p-8 text-center bg-surface-container-lowest rounded-xl">
                                    <p class="text-sm font-semibold text-on-surface">Belum ada barang disetujui</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Tab 3: Ditolak Items (Hidden by default) -->
                        <div id="list-rejected" class="queue-tab-content space-y-2.5 max-h-[620px] overflow-y-auto pr-1 hidden">
                            @forelse($rejectedItems as $item)
                                <button class="queue-item w-full text-left flex items-start gap-3 p-3 rounded-xl bg-surface-container-lowest/70 hover:bg-surface-container-lowest transition-all border border-transparent"
                                        type="button"
                                        data-item-id="{{ $item->id }}"
                                        data-title="{{ $item->nama_barang }}"
                                        data-code="#PB-{{ date('Y') }}-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}"
                                        data-meta="Kategori: {{ $item->kategori }} • Kondisi: {{ $item->kondisi }} • Ditolak {{ $item->updated_at->format('d M Y') }}"
                                        data-donor="{{ $item->donor->name ?? 'Donatur' }}"
                                        data-initials="{{ strtoupper(substr($item->donor->name ?? 'D', 0, 2)) }}"
                                        data-contact="{{ $item->donor->email ?? '-' }} • {{ $item->lokasi_posko ?? 'Posko Transit' }}"
                                        data-posko="{{ $item->lokasi_posko ?? 'Posko Belum Ditentukan' }}"
                                        data-jadwal="{{ $item->jadwal_penyerahan ? $item->jadwal_penyerahan->format('d M Y') : 'Belum Ditentukan' }}"
                                        data-jumlah="{{ $item->jumlah }}"
                                        data-deskripsi="{{ $item->deskripsi }}"
                                        data-alasan="{{ $item->alasan_penolakan }}"
                                        data-foto="{{ $item->foto_url ?? 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=800&q=80' }}"
                                        data-status="Ditolak"
                                        data-status-class="bg-red-100 text-red-800"
                                        data-action-url="{{ route('admin.items.verify', $item->id) }}"
                                        data-can-verify="0">
                                    <img class="w-14 h-14 rounded-lg object-cover shrink-0 bg-surface-container"
                                         src="{{ $item->foto_url ?? 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=200&q=80' }}"
                                         alt="{{ $item->nama_barang }}"/>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between gap-2">
                                            <h3 class="font-label-lg text-label-lg text-on-surface font-semibold truncate">{{ $item->nama_barang }}</h3>
                                            <span class="shrink-0 px-2 py-0.5 rounded-full bg-red-100 text-red-800 font-label-sm text-label-sm font-semibold">Ditolak</span>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant truncate mt-0.5">{{ $item->donor->name ?? 'Donatur' }} • {{ $item->kategori }}</p>
                                        <div class="flex items-center gap-2 mt-1.5">
                                            <span class="font-label-sm text-label-sm text-red-700 bg-red-50 px-2 py-0.5 rounded-md font-medium">Catatan: {{ Str::limit($item->alasan_penolakan ?? 'Tidak lolos fisik', 25) }}</span>
                                        </div>
                                    </div>
                                </button>
                            @empty
                                <div class="p-8 text-center bg-surface-container-lowest rounded-xl">
                                    <p class="text-sm font-semibold text-on-surface">Belum ada barang ditolak</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Right Column: Item Inspection, Physical Checks & Actions (7 cols) -->
                    <div class="lg:col-span-7 flex flex-col gap-space-lg bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm border border-outline-variant/30">
                        @if($firstItem)
                            <!-- Verification Form Wrap -->
                            <form id="verify-form" action="{{ route('admin.items.verify', $firstItem->id) }}" method="POST" class="flex flex-col gap-space-lg">
                                @csrf

                                <!-- Item Status Header -->
                                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-space-md">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span id="detail-status-badge" class="px-2.5 py-0.5 rounded-full font-label-sm text-label-sm font-semibold {{ $firstItem->status === 'tersedia' ? 'bg-emerald-100 text-emerald-800' : ($firstItem->status === 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-amber-100 text-amber-800') }}">
                                                {{ $firstItem->status }}
                                            </span>
                                            <span class="font-label-sm text-label-sm text-outline tabular-nums" id="detail-code">#PB-{{ date('Y') }}-{{ str_pad($firstItem->id, 4, '0', STR_PAD_LEFT) }}</span>
                                        </div>
                                        <h2 class="font-headline-sm text-headline-sm text-on-surface mt-2 font-bold" id="detail-title">{{ $firstItem->nama_barang }}</h2>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1" id="detail-meta">Kategori: {{ $firstItem->kategori }} • Kondisi: {{ $firstItem->kondisi }} • Diajukan {{ $firstItem->created_at->format('d M Y') }}</p>
                                    </div>
                                    <a id="detail-public-link" href="{{ route('items.show', $firstItem->id) }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-primary font-semibold hover:underline">
                                        Lihat Halaman Publik <span class="material-symbols-outlined text-sm">open_in_new</span>
                                    </a>
                                </div>

                                <!-- Photo Gallery View -->
                                <div class="grid grid-cols-1 sm:grid-cols-12 gap-space-md">
                                    <div class="sm:col-span-12 rounded-xl overflow-hidden bg-surface-container aspect-[16/9] border border-outline-variant/30">
                                        <img class="w-full h-full object-cover transition-opacity duration-200" id="main-gallery-img"
                                             src="{{ $firstItem->foto_url ?? 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=800&q=80' }}"
                                             alt="{{ $firstItem->nama_barang }}"/>
                                    </div>
                                </div>

                                <!-- Description & Posko Schedule Banner -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div class="p-3.5 rounded-xl bg-surface-container-low border border-outline-variant/20">
                                        <span class="text-xs font-semibold text-primary uppercase tracking-wider block mb-1">Posko Transit & Jadwal</span>
                                        <p class="text-sm font-semibold text-on-surface" id="detail-posko">{{ $firstItem->lokasi_posko ?? 'Posko Transit Pusat' }}</p>
                                        <p class="text-xs text-on-surface-variant mt-0.5">Jadwal: <span id="detail-jadwal" class="font-semibold text-on-surface">{{ $firstItem->jadwal_penyerahan ? $firstItem->jadwal_penyerahan->format('d M Y') : 'Hari ini' }}</span></p>
                                    </div>
                                    <div class="p-3.5 rounded-xl bg-surface-container-low border border-outline-variant/20">
                                        <span class="text-xs font-semibold text-primary uppercase tracking-wider block mb-1">Jumlah & Unit</span>
                                        <p class="text-sm font-semibold text-on-surface" id="detail-jumlah">{{ $firstItem->jumlah }} Paket / Buah</p>
                                        <p class="text-xs text-on-surface-variant mt-0.5">Status verifikasi fisik posko</p>
                                    </div>
                                </div>

                                <!-- Donor Information Card -->
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-md bg-surface-container-low rounded-xl p-space-md border border-outline-variant/20">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-title-md text-title-md shrink-0 font-bold" id="donor-initials">
                                            {{ strtoupper(substr($firstItem->donor->name ?? 'D', 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-label-lg text-label-lg text-on-surface font-semibold" id="donor-name">{{ $firstItem->donor->name ?? 'Donatur' }}</p>
                                            <p class="font-body-sm text-body-sm text-on-surface-variant" id="donor-contact">{{ $firstItem->donor->email ?? '-' }} • {{ $firstItem->lokasi_posko ?? 'Posko Transit' }}</p>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 font-label-md text-label-md text-primary-container bg-primary-fixed/40 px-3 py-1 rounded-full self-start sm:self-center font-medium">
                                        <span class="material-symbols-outlined text-base">verified_user</span>
                                        Donatur Terverifikasi
                                    </span>
                                </div>

                                <!-- Physical Inspection Checklist -->
                                <div class="flex flex-col gap-3">
                                    <h3 class="font-title-md text-title-md text-on-surface font-semibold">Pemeriksaan Fisik Barang</h3>
                                    <div class="flex flex-col gap-2.5 bg-surface-container-low rounded-xl p-space-md border border-outline-variant/20">
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <input checked="" class="check-item w-4 h-4 accent-primary rounded cursor-pointer" type="checkbox"/>
                                            <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Kelengkapan halaman / fungsi fisik utama barang</span>
                                        </label>
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <input checked="" class="check-item w-4 h-4 accent-primary rounded cursor-pointer" type="checkbox"/>
                                            <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Kebersihan, bebas noda berat &amp; bebas jamur</span>
                                        </label>
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <input checked="" class="check-item w-4 h-4 accent-primary rounded cursor-pointer" type="checkbox"/>
                                            <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Layak pakai untuk sarana belajar siswa</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Rejection Reason Input -->
                                <div class="flex flex-col gap-2">
                                    <label class="font-label-lg text-label-lg text-on-surface font-semibold" for="rejection-reason">
                                        Catatan / Alasan Penolakan <span class="text-on-surface-variant font-normal">(Wajib diisi jika menolak)</span>
                                    </label>
                                    <textarea class="w-full bg-surface-container-low rounded-xl p-3 font-body-sm text-body-sm text-on-surface placeholder:text-outline border border-outline-variant/30 focus:outline-none focus:ring-2 focus:ring-primary transition-colors"
                                              id="rejection-reason"
                                              name="rejection_reason"
                                              placeholder="Tuliskan catatan kondisi barang jika perlu ditolak (misal: halaman robek banyak, lembap/berjamur, atau komponen elektronik rusak)..."
                                              rows="3">{{ old('rejection_reason', $firstItem->alasan_penolakan) }}</textarea>
                                    <p class="hidden font-label-sm text-label-sm text-error mt-0.5" id="reason-error">
                                        Mohon isi alasan penolakan sebelum menolak barang donasi.
                                    </p>
                                </div>

                                <!-- Action Buttons -->
                                <div id="action-buttons-wrap" class="flex flex-col sm:flex-row items-center justify-end gap-space-md pt-2 border-t border-outline-variant/20">
                                    <button class="w-full sm:w-auto px-5 py-2.5 rounded-lg bg-surface-container-lowest text-error font-semibold text-sm border border-error hover:bg-error-container/30 transition-all flex items-center justify-center gap-2"
                                            id="btn-reject"
                                            type="submit"
                                            name="action"
                                            value="reject">
                                        <span class="material-symbols-outlined text-lg">close</span>
                                        Tolak Barang
                                    </button>
                                    <button class="w-full sm:w-auto px-5 py-2.5 rounded-lg bg-primary text-on-primary font-semibold text-sm hover:bg-primary-container transition-all shadow-sm flex items-center justify-center gap-2"
                                            id="btn-approve"
                                            type="submit"
                                            name="action"
                                            value="approve">
                                        <span class="material-symbols-outlined text-lg">check_circle</span>
                                        Setujui &amp; Masuk Katalog
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="py-20 text-center flex flex-col items-center justify-center">
                                <span class="material-symbols-outlined text-6xl text-outline mb-3">inventory_2</span>
                                <h3 class="text-lg font-bold text-on-surface">Belum Ada Barang Terpilih</h3>
                                <p class="text-sm text-on-surface-variant max-w-sm mt-1">Pilih salah satu barang donasi pada antrean di sebelah kiri untuk melihat inspeksi fisik dan melakukan verifikasi.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Interactive Client Script -->
    <script>
        (function() {
            // Tab switching
            const tabPending = document.getElementById('tab-pending');
            const tabApproved = document.getElementById('tab-approved');
            const tabRejected = document.getElementById('tab-rejected');
            const tabBtns = [tabPending, tabApproved, tabRejected];

            const listPending = document.getElementById('list-pending');
            const listApproved = document.getElementById('list-approved');
            const listRejected = document.getElementById('list-rejected');
            const lists = [listPending, listApproved, listRejected];

            tabBtns.forEach(btn => {
                if (!btn) return;
                btn.addEventListener('click', () => {
                    tabBtns.forEach(b => {
                        b.classList.remove('bg-surface-container-lowest', 'text-primary', 'font-bold', 'shadow-sm');
                        b.classList.add('text-on-surface-variant');
                    });
                    btn.classList.add('bg-surface-container-lowest', 'text-primary', 'font-bold', 'shadow-sm');
                    btn.classList.remove('text-on-surface-variant');

                    const targetId = btn.getAttribute('data-target');
                    lists.forEach(l => {
                        if (l) l.classList.add('hidden');
                    });
                    const activeList = document.getElementById(targetId);
                    if (activeList) activeList.classList.remove('hidden');
                });
            });

            // Queue item selection
            const queueItems = document.querySelectorAll('.queue-item');
            const verifyForm = document.getElementById('verify-form');
            const detailTitle = document.getElementById('detail-title');
            const detailCode = document.getElementById('detail-code');
            const detailMeta = document.getElementById('detail-meta');
            const detailStatusBadge = document.getElementById('detail-status-badge');
            const detailPosko = document.getElementById('detail-posko');
            const detailJadwal = document.getElementById('detail-jadwal');
            const detailJumlah = document.getElementById('detail-jumlah');
            const donorName = document.getElementById('donor-name');
            const donorInitials = document.getElementById('donor-initials');
            const donorContact = document.getElementById('donor-contact');
            const mainImg = document.getElementById('main-gallery-img');
            const rejectionReason = document.getElementById('rejection-reason');
            const reasonError = document.getElementById('reason-error');
            const detailPublicLink = document.getElementById('detail-public-link');
            const actionButtonsWrap = document.getElementById('action-buttons-wrap');

            queueItems.forEach(item => {
                item.addEventListener('click', () => {
                    queueItems.forEach(i => {
                        i.classList.remove('bg-surface-container-lowest', 'border-primary', 'shadow-sm');
                        i.classList.add('bg-surface-container-lowest/70', 'border-transparent');
                    });
                    item.classList.add('bg-surface-container-lowest', 'border-primary', 'shadow-sm');
                    item.classList.remove('bg-surface-container-lowest/70', 'border-transparent');

                    // Read attributes
                    const actionUrl = item.getAttribute('data-action-url');
                    const title = item.getAttribute('data-title');
                    const code = item.getAttribute('data-code');
                    const meta = item.getAttribute('data-meta');
                    const donor = item.getAttribute('data-donor');
                    const initials = item.getAttribute('data-initials');
                    const contact = item.getAttribute('data-contact');
                    const posko = item.getAttribute('data-posko');
                    const jadwal = item.getAttribute('data-jadwal');
                    const jumlah = item.getAttribute('data-jumlah');
                    const foto = item.getAttribute('data-foto');
                    const status = item.getAttribute('data-status');
                    const statusClass = item.getAttribute('data-status-class');
                    const itemId = item.getAttribute('data-item-id');
                    const alasan = item.getAttribute('data-alasan') || '';
                    const canVerify = item.getAttribute('data-can-verify') === '1';

                    if (verifyForm && actionUrl) verifyForm.action = actionUrl;
                    if (detailTitle) detailTitle.textContent = title;
                    if (detailCode) detailCode.textContent = code;
                    if (detailMeta) detailMeta.textContent = meta;
                    if (donorName) donorName.textContent = donor;
                    if (donorInitials) donorInitials.textContent = initials;
                    if (donorContact) donorContact.textContent = contact;
                    if (detailPosko) detailPosko.textContent = posko;
                    if (detailJadwal) detailJadwal.textContent = jadwal;
                    if (detailJumlah) detailJumlah.textContent = jumlah + ' Paket / Buah';
                    if (mainImg) mainImg.src = foto;
                    if (rejectionReason) rejectionReason.value = alasan;
                    if (reasonError) reasonError.classList.add('hidden');
                    if (detailPublicLink) detailPublicLink.href = '/items/' + itemId;

                    if (detailStatusBadge) {
                        detailStatusBadge.textContent = status;
                        detailStatusBadge.className = 'px-2.5 py-0.5 rounded-full font-label-sm text-label-sm font-semibold ' + statusClass;
                    }

                    if (actionButtonsWrap) {
                        actionButtonsWrap.style.display = canVerify ? 'flex' : 'none';
                    }
                });
            });

            // Rejection client validation
            const btnReject = document.getElementById('btn-reject');
            if (btnReject) {
                btnReject.addEventListener('click', (e) => {
                    if (rejectionReason && !rejectionReason.value.trim()) {
                        e.preventDefault();
                        if (reasonError) reasonError.classList.remove('hidden');
                        rejectionReason.focus();
                    } else {
                        if (reasonError) reasonError.classList.add('hidden');
                    }
                });
            }

            // Quick live search filter
            const searchInput = document.getElementById('queue-search');
            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    const q = e.target.value.toLowerCase();
                    queueItems.forEach(item => {
                        const title = (item.getAttribute('data-title') || '').toLowerCase();
                        const donor = (item.getAttribute('data-donor') || '').toLowerCase();
                        if (title.includes(q) || donor.includes(q)) {
                            item.style.display = 'flex';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            }
        })();
    </script>
</body>
</html>
