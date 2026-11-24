<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="web_dashboard" name="shell-type"/>
    <title>Manajemen Katalog Barang &amp; Posko Transit - PojokBerbagi</title>

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
                <span class="material-symbols-outlined mr-3 text-xl">admin_panel_settings</span>Posko Transit
            </a>
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('admin.verifikasi') }}">
                <span class="material-symbols-outlined mr-3 text-xl">fact_check</span>Verifikasi Barang
            </a>
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('permintaan.index') }}">
                <span class="material-symbols-outlined mr-3 text-xl">assignment</span>Lacak Permintaan
            </a>
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('notifikasi.index') }}">
                <span class="material-symbols-outlined mr-3 text-xl">notifications</span>Notifikasi
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
                    <p class="text-xs text-primary font-medium capitalize">Administrator Posko</p>
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
                <span class="text-xs font-semibold text-on-surface-variant uppercase tracking-wider">Portal Inventaris Terpusat</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.verifikasi') }}" class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-primary-container text-on-primary flex items-center gap-1.5 shadow-sm transition-all hover:bg-primary">
                    <span class="material-symbols-outlined text-sm">fact_check</span>Antrean Verifikasi ({{ $stats['total_menunggu_verifikasi'] }})
                </a>
                <a href="{{ route('notifikasi.index') }}" class="p-2 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-colors">
                    <span class="material-symbols-outlined text-xl">notifications</span>
                </a>
            </div>
        </header>

        <main class="relative w-full px-8 pt-20 pb-16 bg-surface">
            <div class="flex flex-col w-full">
                
                <!-- Top Breadcrumb & Metadata Strip -->
                <div class="flex flex-wrap items-center justify-between gap-space-sm mb-space-md">
                    <nav class="flex items-center gap-space-xs font-label-md text-label-md text-on-surface-variant">
                        <span class="flex items-center gap-1 hover:text-on-surface cursor-pointer transition-colors">
                            <span class="material-symbols-outlined text-base">domain</span>
                            <span>Posko Transit</span>
                        </span>
                        <span class="material-symbols-outlined text-xs">chevron_right</span>
                        <span class="hover:text-on-surface cursor-pointer transition-colors">Inventaris Edukasi</span>
                        <span class="material-symbols-outlined text-xs">chevron_right</span>
                        <span class="text-primary font-bold">Manajemen Katalog Barang</span>
                    </nav>
                    <div class="flex items-center gap-space-sm">
                        <div class="flex items-center gap-1.5 px-2.5 py-1 bg-surface-container rounded-full text-label-sm font-label-sm text-on-surface-variant">
                            <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
                            <span>Sinkronisasi Posko Real-time</span>
                            <span class="text-outline-variant">•</span>
                            <span class="font-mono text-primary font-bold">{{ date('H:i') }} WIB</span>
                        </div>
                    </div>
                </div>

                <!-- Hero Header & Quick Action Buttons -->
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg mb-space-xl">
                    <div class="max-w-2xl">
                        <h1 class="font-headline-md text-headline-md text-on-surface tracking-tight font-bold">Manajemen Katalog Barang</h1>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-1">
                            Kelola ketersediaan inventaris, kurasi status publikasi, dan perbarui data barang donasi terverifikasi yang siap disalurkan ke penerima manfaat.
                        </p>
                    </div>
                    <div class="flex flex-wrap items-center gap-space-sm">
                        <button class="inline-flex items-center gap-2 px-3.5 py-2.5 bg-surface-container-lowest hover:bg-surface-container text-on-surface font-label-lg text-label-lg rounded-lg shadow-sm border border-outline-variant/30 transition-all cursor-pointer" onclick="document.getElementById('barcodeModal').classList.remove('hidden')" type="button">
                            <span class="material-symbols-outlined text-lg text-primary">qr_code_scanner</span>
                            <span>Pindai Barcode / QR</span>
                        </button>
                        <a href="{{ route('admin.verifikasi') }}" class="inline-flex items-center gap-2 px-3.5 py-2.5 bg-surface-container-lowest hover:bg-surface-container text-on-surface font-label-lg text-label-lg rounded-lg shadow-sm border border-outline-variant/30 transition-all cursor-pointer">
                            <span class="material-symbols-outlined text-lg text-primary">fact_check</span>
                            <span>Kurasi Antrean Transit</span>
                        </a>
                        <button class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-container hover:bg-primary text-on-primary font-label-lg text-label-lg rounded-lg shadow-sm transition-all cursor-pointer" onclick="document.getElementById('addModal').classList.remove('hidden')" type="button">
                            <span class="material-symbols-outlined text-lg">add_box</span>
                            <span>+ Tambah Barang Manual</span>
                        </button>
                    </div>
                </div>

                <!-- 4 Stat Summary Cards Bento Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-md mb-space-xl">
                    <!-- Stat 1: Total -->
                    <div class="p-space-lg bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 flex flex-col justify-between relative overflow-hidden group">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-semibold">Total di Katalog</span>
                                <div class="font-headline-md text-headline-md font-bold text-on-surface mt-1">{{ $totalKatalog }} <span class="font-body-md text-body-md font-normal text-on-surface-variant">Barang</span></div>
                            </div>
                            <div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-xl">inventory_2</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-4 pt-3 border-t border-surface-container">
                            <span class="font-label-md text-label-md text-on-surface-variant">Dari Seluruh Kategori</span>
                            <span class="font-label-sm text-label-sm font-semibold text-primary">100% Tercatat</span>
                        </div>
                    </div>

                    <!-- Stat 2: Ready to Claim -->
                    <div class="p-space-lg bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 flex flex-col justify-between relative overflow-hidden group">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-semibold">Siap Diklaim</span>
                                <div class="font-headline-md text-headline-md font-bold text-primary mt-1">{{ $totalSiapKlaim }} <span class="font-body-md text-body-md font-normal text-on-surface-variant">Barang</span></div>
                            </div>
                            <div class="w-10 h-10 rounded-lg bg-primary-fixed flex items-center justify-center text-on-primary-fixed-variant">
                                <span class="material-symbols-outlined text-xl">verified</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-4 pt-3 border-t border-surface-container">
                            <span class="inline-flex items-center gap-1 font-label-md text-label-md text-on-surface-variant">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Live di portal siswa
                            </span>
                            <span class="font-label-sm text-label-sm font-bold text-primary">{{ $totalKatalog > 0 ? round(($totalSiapKlaim / $totalKatalog) * 100, 1) : 0 }}%</span>
                        </div>
                    </div>

                    <!-- Stat 3: Low Stock -->
                    <div class="p-space-lg bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 flex flex-col justify-between relative overflow-hidden group">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-semibold">Stok Menipis</span>
                                <div class="font-headline-md text-headline-md font-bold text-tertiary-container mt-1">{{ $totalStokMenipis }} <span class="font-body-md text-body-md font-normal text-on-surface-variant">Varian</span></div>
                            </div>
                            <div class="w-10 h-10 rounded-lg bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed-variant">
                                <span class="material-symbols-outlined text-xl">warning</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-4 pt-3 border-t border-surface-container">
                            <span class="font-label-md text-label-md text-on-surface-variant">Tersisa ≤ 2 unit di posko</span>
                            <span class="font-label-sm text-label-sm font-bold text-tertiary-container">Perlu Restok</span>
                        </div>
                    </div>

                    <!-- Stat 4: Archived/Dispatched -->
                    <div class="p-space-lg bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 flex flex-col justify-between relative overflow-hidden group">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-semibold">Tutup Buku / Arsip</span>
                                <div class="font-headline-md text-headline-md font-bold text-secondary mt-1">{{ $totalTersalurkan }} <span class="font-body-md text-body-md font-normal text-on-surface-variant">Arsip</span></div>
                            </div>
                            <div class="w-10 h-10 rounded-lg bg-secondary-container flex items-center justify-center text-on-secondary-container">
                                <span class="material-symbols-outlined text-xl">archive</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-4 pt-3 border-t border-surface-container">
                            <span class="font-label-md text-label-md text-on-surface-variant">Ditolak / Selesai Tersalur</span>
                            <span class="font-label-sm text-label-sm font-medium text-secondary">Tutup Buku</span>
                        </div>
                    </div>
                </div>

                <!-- Filter & Search Toolbar Container -->
                <div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm border border-outline-variant/30 mb-space-md">
                    <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-space-md">
                        <!-- Search Input -->
                        <div class="relative flex-1 min-w-[260px]">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-xl">search</span>
                            <input class="w-full pl-10 pr-4 py-2 bg-surface-container-low focus:bg-surface-container-lowest rounded-lg font-body-sm text-body-sm text-on-surface placeholder:text-on-surface-variant outline-none border border-outline-variant/20 transition-all" id="searchInput" placeholder="Cari nama barang, kode SKU (#PB-..), atau donatur..." type="text"/>
                        </div>

                        <!-- Filters Row -->
                        <div class="flex flex-wrap items-center gap-space-sm">
                            <!-- Filter Kategori -->
                            <div class="relative">
                                <select class="appearance-none pl-3 pr-8 py-2 bg-surface-container-low hover:bg-surface-container font-label-md text-label-md text-on-surface rounded-lg cursor-pointer outline-none border border-outline-variant/20 transition-colors" id="filterCategory">
                                    <option value="all">Semua Kategori</option>
                                    <option value="buku">Buku Pelajaran</option>
                                    <option value="seragam">Seragam Sekolah</option>
                                    <option value="alat">Alat Tulis</option>
                                    <option value="perangkat">Perangkat Belajar</option>
                                    <option value="tas">Tas Sekolah</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-base text-on-surface-variant">expand_more</span>
                            </div>

                            <!-- Filter Status -->
                            <div class="relative">
                                <select class="appearance-none pl-3 pr-8 py-2 bg-surface-container-low hover:bg-surface-container font-label-md text-label-md text-on-surface rounded-lg cursor-pointer outline-none border border-outline-variant/20 transition-colors" id="filterStatus">
                                    <option value="all">Semua Status</option>
                                    <option value="tersedia">Tersedia</option>
                                    <option value="menunggu">Menunggu Verifikasi</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-base text-on-surface-variant">expand_more</span>
                            </div>

                            <!-- Filter Posko Transit -->
                            <div class="relative">
                                <select class="appearance-none pl-3 pr-8 py-2 bg-surface-container-low hover:bg-surface-container font-label-md text-label-md text-on-surface rounded-lg cursor-pointer outline-none border border-outline-variant/20 transition-colors" id="filterPosko">
                                    <option value="all">Semua Posko Transit</option>
                                    @foreach($poskoTransitList as $posko)
                                        <option value="{{ strtolower($posko) }}">{{ Str::limit($posko, 28) }}</option>
                                    @endforeach
                                </select>
                                <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-base text-on-surface-variant">expand_more</span>
                            </div>

                            <!-- Reset Button -->
                            <button class="p-2 text-on-surface-variant hover:text-error hover:bg-error-container/20 rounded-lg transition-colors cursor-pointer" id="btnResetFilter" title="Reset Semua Filter" type="button">
                                <span class="material-symbols-outlined text-xl">filter_alt_off</span>
                            </button>
                        </div>
                    </div>

                    <!-- Active Filter Tags Display -->
                    <div class="flex items-center gap-2 mt-3 pt-3 border-t border-surface-container text-label-sm font-label-sm text-on-surface-variant">
                        <span class="font-medium">Status Inventaris:</span>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-secondary-container text-on-secondary-fixed text-label-sm">
                            Seluruh Titik Posko Transit
                        </span>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-primary-fixed text-on-primary-fixed-variant text-label-sm font-medium">
                            Terkurasi Posko
                        </span>
                        <span class="text-on-surface-variant ml-auto font-mono text-label-sm">Menampilkan {{ $items->count() }} barang</span>
                    </div>
                </div>

                <!-- Bulk Actions Floating Bar -->
                <div class="hidden items-center justify-between px-space-md py-2.5 mb-space-sm bg-primary text-on-primary rounded-xl shadow-md transition-all" id="bulkActionBar">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary-fixed">check_circle</span>
                        <span class="font-label-lg text-label-lg font-medium">
                            <span class="font-bold" id="selectedCount">0</span> barang dipilih
                        </span>
                    </div>
                    <div class="flex items-center gap-space-xs">
                        <button class="px-3 py-1.5 rounded-lg bg-on-primary/10 hover:bg-on-primary/20 text-on-primary font-label-md text-label-md transition-colors cursor-pointer" type="button">
                            Ubah Status
                        </button>
                        <button class="px-3 py-1.5 rounded-lg bg-on-primary/10 hover:bg-on-primary/20 text-on-primary font-label-md text-label-md transition-colors flex items-center gap-1 cursor-pointer" type="button">
                            <span class="material-symbols-outlined text-sm">print</span>
                            Cetak Label
                        </button>
                        <button class="p-1.5 text-on-primary/80 hover:text-on-primary rounded-lg transition-colors ml-2 cursor-pointer" onclick="deselectAll()" title="Batal Pilih" type="button">
                            <span class="material-symbols-outlined text-base">close</span>
                        </button>
                    </div>
                </div>

                <!-- Comprehensive Data Table Container -->
                <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden mb-space-md">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse" id="inventoryTable">
                            <thead>
                                <tr class="bg-surface-container-low text-on-surface-variant font-label-sm text-label-sm tracking-wider uppercase border-b border-surface-container">
                                    <th class="py-3 px-4 w-10">
                                        <input class="w-4 h-4 rounded text-primary focus:ring-primary accent-primary cursor-pointer" id="selectAllCheckbox" onchange="toggleSelectAll(this)" type="checkbox"/>
                                    </th>
                                    <th class="py-3 px-4">Barang &amp; SKU</th>
                                    <th class="py-3 px-4">Lokasi Posko Transit</th>
                                    <th class="py-3 px-4">Kondisi Fisik</th>
                                    <th class="py-3 px-4 text-center">Stok Unit</th>
                                    <th class="py-3 px-4">Tgl Masuk</th>
                                    <th class="py-3 px-4">Status Publikasi</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-surface-container font-body-sm text-body-sm text-on-surface">
                                @forelse($items as $idx => $item)
                                    @php
                                        $sku = 'PB-' . strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $item->kategori), 0, 2)) . '-' . str_pad($item->id, 4, '0', STR_PAD_LEFT);
                                    @endphp
                                    <tr class="table-row-item hover:bg-surface-container-low/60 transition-colors group"
                                        data-title="{{ strtolower($item->nama_barang) }}"
                                        data-sku="{{ strtolower($sku) }}"
                                        data-donor="{{ strtolower($item->donor->name ?? '') }}"
                                        data-category="{{ strtolower($item->kategori) }}"
                                        data-status="{{ strtolower($item->status) }}"
                                        data-posko="{{ strtolower($item->lokasi_posko ?? '') }}">
                                        <td class="py-3.5 px-4">
                                            <input class="row-checkbox w-4 h-4 rounded text-primary focus:ring-primary accent-primary cursor-pointer" onchange="updateBulkBar()" type="checkbox"/>
                                        </td>
                                        <td class="py-3.5 px-4">
                                            <div class="flex items-center gap-3">
                                                <img class="w-12 h-12 rounded-lg object-cover bg-surface-container flex-shrink-0 border border-outline-variant/30"
                                                     src="{{ $item->foto_url ?? 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=200&q=80' }}"
                                                     alt="{{ $item->nama_barang }}"/>
                                                <div class="min-w-0">
                                                    <a href="{{ route('items.show', $item->id) }}" class="font-title-md text-title-md font-semibold text-on-surface truncate group-hover:text-primary transition-colors block max-w-sm">
                                                        {{ $item->nama_barang }}
                                                    </a>
                                                    <div class="flex items-center gap-2 mt-0.5">
                                                        <span class="font-mono text-label-sm text-on-surface-variant bg-surface-container px-1.5 py-0.5 rounded font-semibold">{{ $sku }}</span>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-label-sm bg-primary-fixed text-on-primary-fixed-variant font-medium">{{ $item->kategori }}</span>
                                                        <span class="text-xs text-on-surface-variant truncate">Donatur: {{ $item->donor->name ?? 'Anonim' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3.5 px-4 whitespace-nowrap">
                                            <div class="font-medium text-on-surface">{{ $item->lokasi_posko ?? 'Posko Belum Ditentukan' }}</div>
                                            <div class="text-xs font-mono text-on-surface-variant flex items-center gap-1">
                                                <span class="material-symbols-outlined text-xs">shelves</span>
                                                <span>Jadwal: {{ $item->jadwal_penyerahan ? $item->jadwal_penyerahan->format('d M Y') : 'Hari ini' }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3.5 px-4 whitespace-nowrap">
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-label-sm font-label-sm bg-surface-container text-on-surface-variant font-medium">
                                                <span class="material-symbols-outlined text-xs text-emerald-600">check_circle</span>
                                                {{ $item->kondisi }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                            <div class="font-bold text-on-surface text-base">{{ $item->jumlah }} <span class="text-xs font-normal text-on-surface-variant">Unit</span></div>
                                            <div class="w-16 h-1.5 bg-surface-container rounded-full mx-auto mt-1 overflow-hidden">
                                                <div class="h-full {{ $item->jumlah > 2 ? 'bg-emerald-600' : 'bg-amber-500' }} rounded-full" style="width: {{ min(100, $item->jumlah * 20) }}%"></div>
                                            </div>
                                        </td>
                                        <td class="py-3.5 px-4 whitespace-nowrap text-on-surface-variant font-mono text-label-md">
                                            {{ $item->created_at->format('d M Y') }}
                                        </td>
                                        <td class="py-3.5 px-4 whitespace-nowrap">
                                            @if($item->status === 'tersedia')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-label-sm font-semibold bg-emerald-100 text-emerald-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                                    Tersedia
                                                </span>
                                            @elseif($item->status === 'ditolak')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-label-sm font-semibold bg-red-100 text-red-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                                    Ditolak
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-label-sm font-semibold bg-amber-100 text-amber-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                                    Menunggu Verifikasi
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                            <div class="flex items-center justify-end gap-1">
                                                <button class="p-1.5 text-on-surface-variant hover:text-primary hover:bg-surface-container rounded-lg transition-colors cursor-pointer"
                                                        onclick="openDetail('{{ $sku }}', '{{ addslashes($item->nama_barang) }}', '{{ addslashes($item->lokasi_posko ?? '') }}', 'Rak B-01', '{{ $item->jumlah }} Unit', '{{ $item->status }}')"
                                                        title="Lihat &amp; Edit"
                                                        type="button">
                                                    <span class="material-symbols-outlined text-lg">edit_note</span>
                                                </button>
                                                <button class="p-1.5 text-on-surface-variant hover:text-primary hover:bg-surface-container rounded-lg transition-colors cursor-pointer"
                                                        onclick="showStockDialog('{{ $sku }}', {{ $item->jumlah }})"
                                                        title="Ubah Stok"
                                                        type="button">
                                                    <span class="material-symbols-outlined text-lg">swap_vert</span>
                                                </button>
                                                <div class="relative inline-block text-left">
                                                    <button class="p-1.5 text-on-surface-variant hover:text-on-surface hover:bg-surface-container rounded-lg transition-colors cursor-pointer"
                                                            onclick="toggleMenu('menu-{{ $item->id }}')"
                                                            type="button">
                                                        <span class="material-symbols-outlined text-lg">more_vert</span>
                                                    </button>
                                                    <div class="hidden absolute right-0 mt-1 w-44 bg-surface-container-lowest rounded-xl shadow-lg border border-surface-container py-1 z-30 font-label-md text-label-md" id="menu-{{ $item->id }}">
                                                        <a class="flex items-center gap-2 px-3 py-2 text-on-surface hover:bg-surface-container-low" href="{{ route('items.show', $item->id) }}" target="_blank">
                                                            <span class="material-symbols-outlined text-base">visibility</span> Lihat di Publik
                                                        </a>
                                                        <a class="flex items-center gap-2 px-3 py-2 text-on-surface hover:bg-surface-container-low" href="{{ route('admin.verifikasi') }}">
                                                            <span class="material-symbols-outlined text-base">fact_check</span> Kurasi Posko
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="py-12 text-center bg-surface-container-lowest">
                                            <span class="material-symbols-outlined text-4xl text-outline mb-2">inventory_2</span>
                                            <p class="text-sm font-semibold text-on-surface">Belum ada barang terdaftar di katalog posko</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination & Summary Footer -->
                    <div class="flex flex-col sm:flex-row items-center justify-between px-space-md py-3.5 bg-surface-container-low text-on-surface-variant font-label-md text-label-md gap-4 border-t border-surface-container">
                        <div class="flex items-center gap-2">
                            <span>Menampilkan <strong class="text-on-surface font-semibold">{{ $items->count() }}</strong> dari <strong class="text-on-surface font-semibold">{{ $items->total() }}</strong> barang terdaftar</span>
                        </div>
                        <div>
                            {{ $items->links() }}
                        </div>
                    </div>
                </div>

                <!-- Operational Notes / Posko Transit Live Info Card -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-space-md mb-space-xl">
                    <div class="p-space-md bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-primary-fixed flex items-center justify-center text-primary flex-shrink-0">
                            <span class="material-symbols-outlined text-lg">fact_check</span>
                        </div>
                        <div>
                            <h2 class="font-title-md text-title-md font-semibold text-on-surface">Prosedur QC Posko</h2>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
                                Barang wajib melewati verifikasi fisik, sanitasi/laundry, dan pelabelan QR sebelum diaktifkan ke status "Tersedia" di portal penerima.
                            </p>
                        </div>
                    </div>

                    <div class="p-space-md bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-tertiary-fixed flex items-center justify-center text-tertiary-container flex-shrink-0">
                            <span class="material-symbols-outlined text-lg">local_shipping</span>
                        </div>
                        <div>
                            <h2 class="font-title-md text-title-md font-semibold text-on-surface">Jadwal Pick-up Ekspedisi</h2>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
                                Penjemputan paket donasi terjadwal setiap hari kerja pukul 10:00 &amp; 15:30 WIB oleh armada kurir mitra PojokBerbagi.
                            </p>
                        </div>
                    </div>

                    <div class="p-space-md bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-secondary-container flex items-center justify-center text-secondary flex-shrink-0">
                            <span class="material-symbols-outlined text-lg">print</span>
                        </div>
                        <div>
                            <h2 class="font-title-md text-title-md font-semibold text-on-surface">Format Label Thermal</h2>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
                                Gunakan ukuran standar 100mm × 150mm pada printer thermal posko untuk cetak QR SKU dan alamat tujuan penerima manfaat.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Slide-over Drawer / Edit Modal Preview -->
                <div class="hidden fixed inset-0 z-50 overflow-hidden bg-black/40 backdrop-blur-xs flex justify-end" id="detailDrawer">
                    <div class="w-full max-w-lg bg-surface-container-lowest h-full shadow-2xl flex flex-col p-6 overflow-y-auto">
                        <div class="flex items-center justify-between pb-4 border-b border-surface-container">
                            <div>
                                <span class="font-mono text-label-sm text-primary font-bold" id="drawerSku">#PB-BK-0891</span>
                                <h2 class="font-title-md text-title-md font-bold text-on-surface" id="drawerTitle">Buku Matematika Wajib Kelas 10</h2>
                            </div>
                            <button class="p-2 text-on-surface-variant hover:text-on-surface rounded-lg cursor-pointer" onclick="closeDrawer()" type="button">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        <div class="py-4 space-y-4 flex-1">
                            <div>
                                <label class="block font-label-md text-label-md font-medium text-on-surface mb-1">Status Publikasi</label>
                                <select class="w-full p-2.5 bg-surface-container-low rounded-lg font-body-sm text-body-sm text-on-surface outline-none border border-outline-variant/30" id="drawerStatusSelect">
                                    <option value="tersedia">Tersedia (Bisa Diklaim)</option>
                                    <option value="Menunggu Verifikasi Transit">Menunggu Verifikasi Transit</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-label-md text-label-md font-medium text-on-surface mb-1">Posko Transit</label>
                                    <input class="w-full p-2.5 bg-surface-container-low rounded-lg font-body-sm text-body-sm text-on-surface outline-none border border-outline-variant/30" id="drawerPoskoInput" type="text" value="Posko Transit Pusat"/>
                                </div>
                                <div>
                                    <label class="block font-label-md text-label-md font-medium text-on-surface mb-1">Nomor Rak / Box</label>
                                    <input class="w-full p-2.5 bg-surface-container-low rounded-lg font-body-sm text-body-sm text-on-surface outline-none border border-outline-variant/30" id="drawerRakInput" type="text" value="Rak B-02"/>
                                </div>
                            </div>
                            <div>
                                <label class="block font-label-md text-label-md font-medium text-on-surface mb-1">Catatan Fisik Petugas Posko</label>
                                <textarea class="w-full p-2.5 bg-surface-container-low rounded-lg font-body-sm text-body-sm text-on-surface outline-none border border-outline-variant/30" placeholder="Kondisi halaman lengkap, sedikit lipatan di ujung cover, siap pakai..." rows="3"></textarea>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-surface-container flex items-center justify-end gap-2">
                            <button class="px-4 py-2 rounded-lg bg-surface-container text-on-surface font-label-lg text-label-lg cursor-pointer" onclick="closeDrawer()" type="button">
                                Batal
                            </button>
                            <button class="px-5 py-2 rounded-lg bg-primary text-on-primary font-label-lg text-label-lg shadow-sm hover:bg-primary-container transition-all cursor-pointer" onclick="saveDrawer()" type="button">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Quick Stock Adjustment Dialog Modal -->
                <div class="hidden fixed inset-0 z-50 overflow-hidden bg-black/40 backdrop-blur-xs flex items-center justify-center p-4" id="stockModal">
                    <div class="bg-surface-container-lowest rounded-xl max-w-sm w-full p-6 shadow-xl border border-outline-variant/30">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="font-title-md text-title-md font-bold text-on-surface">Ubah Ketersediaan Stok</h2>
                            <button class="text-on-surface-variant hover:text-on-surface cursor-pointer" onclick="document.getElementById('stockModal').classList.add('hidden')" type="button">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
                            Perbarui jumlah unit fisik yang siap dikirim di posko untuk item SKU: <strong class="font-mono text-primary font-bold" id="stockSkuLabel">#PB-BK-0891</strong>
                        </p>
                        <div class="flex items-center justify-center gap-4 my-6">
                            <button class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-on-surface font-bold text-xl hover:bg-surface-container-high transition-colors cursor-pointer" onclick="changeStockInput(-1)" type="button">-</button>
                            <input class="w-20 text-center font-headline-sm text-headline-sm font-bold bg-surface-container-low rounded-lg py-1.5 text-on-surface outline-none border border-outline-variant/30" id="stockNumberInput" min="0" type="number" value="5"/>
                            <button class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-on-surface font-bold text-xl hover:bg-surface-container-high transition-colors cursor-pointer" onclick="changeStockInput(1)" type="button">+</button>
                        </div>
                        <div class="flex items-center justify-end gap-2">
                            <button class="px-3.5 py-2 rounded-lg bg-surface-container text-on-surface font-label-md text-label-md cursor-pointer" onclick="document.getElementById('stockModal').classList.add('hidden')" type="button">Batal</button>
                            <button class="px-4 py-2 rounded-lg bg-primary text-on-primary font-label-md text-label-md font-semibold cursor-pointer" onclick="confirmStockChange()" type="button">Terapkan Stok</button>
                        </div>
                    </div>
                </div>

                <!-- Barcode Scanner Modal Simulation -->
                <div class="hidden fixed inset-0 z-50 overflow-hidden bg-black/40 backdrop-blur-xs flex items-center justify-center p-4" id="barcodeModal">
                    <div class="bg-surface-container-lowest rounded-xl max-w-md w-full p-6 shadow-xl text-center border border-outline-variant/30">
                        <div class="w-12 h-12 rounded-full bg-primary-fixed mx-auto mb-3 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-2xl">qr_code_scanner</span>
                        </div>
                        <h2 class="font-headline-sm text-headline-sm text-on-surface font-bold">Pindai QR / Barcode Posko</h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1 mb-5">
                            Arahkan kamera ke label QR thermal pada kardus atau buku untuk membuka rincian data inventaris secara instan.
                        </p>
                        <div class="relative w-full h-48 bg-black/90 rounded-xl overflow-hidden flex items-center justify-center mb-4">
                            <div class="border-2 border-primary border-dashed w-36 h-36 rounded-lg flex items-center justify-center text-on-primary/60 text-xs">
                                Area Pindai QR
                            </div>
                            <div class="absolute w-full h-0.5 bg-emerald-400 top-1/2 -translate-y-1/2 animate-pulse shadow-[0_0_8px_#34d399]"></div>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <input class="flex-1 p-2 text-label-md bg-surface-container-low rounded-lg outline-none text-on-surface font-mono border border-outline-variant/30" placeholder="Atau ketik SKU: PB-..." type="text"/>
                            <button class="px-4 py-2 rounded-lg bg-primary text-on-primary font-label-md text-label-md font-semibold cursor-pointer" onclick="document.getElementById('barcodeModal').classList.add('hidden')" type="button">Cari</button>
                        </div>
                        <button class="mt-3 text-label-sm text-on-surface-variant hover:text-on-surface cursor-pointer" onclick="document.getElementById('barcodeModal').classList.add('hidden')" type="button">
                            Tutup Jendela
                        </button>
                    </div>
                </div>

                <!-- Manual Add Item Modal -->
                <div class="hidden fixed inset-0 z-50 overflow-hidden bg-black/40 backdrop-blur-xs flex items-center justify-center p-4" id="addModal">
                    <div class="bg-surface-container-lowest rounded-xl max-w-lg w-full p-6 shadow-2xl border border-outline-variant/30">
                        <div class="flex items-center justify-between pb-3 border-b border-surface-container mb-4">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-xl">add_box</span>
                                <h2 class="font-title-md text-title-md font-bold text-on-surface">Tambah Barang Donasi Manual</h2>
                            </div>
                            <button class="text-on-surface-variant hover:text-on-surface cursor-pointer" onclick="document.getElementById('addModal').classList.add('hidden')" type="button">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data" class="space-y-3 font-body-sm text-body-sm">
                            @csrf
                            <div>
                                <label class="block font-label-md text-label-md font-medium text-on-surface mb-1">Nama Barang Donasi</label>
                                <input class="w-full p-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none border border-outline-variant/30" name="nama_barang" placeholder="Contoh: Kamus Bahasa Inggris Oxford" required="" type="text"/>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-label-md text-label-md font-medium text-on-surface mb-1">Kategori</label>
                                    <select class="w-full p-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none border border-outline-variant/30" name="kategori" required="">
                                        <option value="Buku Pelajaran &amp; Referensi">Buku Pelajaran &amp; Referensi</option>
                                        <option value="Seragam &amp; Sepatu Sekolah">Seragam &amp; Sepatu Sekolah</option>
                                        <option value="Buku &amp; Alat Tulis">Buku &amp; Alat Tulis</option>
                                        <option value="Perangkat Elektronik &amp; Belajar">Perangkat Elektronik &amp; Belajar</option>
                                        <option value="Tas &amp; Perlengkapan Belajar">Tas &amp; Perlengkapan Belajar</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block font-label-md text-label-md font-medium text-on-surface mb-1">Kondisi</label>
                                    <select class="w-full p-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none border border-outline-variant/30" name="kondisi" required="">
                                        <option value="Baru">Baru</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Layak Pakai">Layak Pakai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-label-md text-label-md font-medium text-on-surface mb-1">Posko Transit</label>
                                    <select class="w-full p-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none border border-outline-variant/30" name="lokasi_posko" required="">
                                        @foreach($poskoTransitList as $posko)
                                            <option value="{{ $posko }}">{{ Str::limit($posko, 30) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block font-label-md text-label-md font-medium text-on-surface mb-1">Jumlah Unit Fisik</label>
                                    <input class="w-full p-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none border border-outline-variant/30" min="1" name="jumlah" type="number" value="1" required=""/>
                                </div>
                            </div>
                            <div>
                                <label class="block font-label-md text-label-md font-medium text-on-surface mb-1">Deskripsi Singkat</label>
                                <textarea class="w-full p-2.5 bg-surface-container-low rounded-lg text-on-surface outline-none border border-outline-variant/30" name="deskripsi" placeholder="Tuliskan keterangan kondisi barang..." rows="2" required="">Barang inventaris tercatat posko transit.</textarea>
                            </div>
                            <input type="hidden" name="jadwal_penyerahan" value="{{ date('Y-m-d') }}"/>
                            <div class="flex items-center justify-end gap-2 pt-4 border-t border-surface-container">
                                <button class="px-4 py-2 rounded-lg bg-surface-container text-on-surface font-label-md text-label-md cursor-pointer" onclick="document.getElementById('addModal').classList.add('hidden')" type="button">Batal</button>
                                <button class="px-4 py-2 rounded-lg bg-primary text-on-primary font-label-md text-label-md font-semibold cursor-pointer hover:bg-primary-container" type="submit">Simpan ke Katalog</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Client-Side Scripts for Table Filtering & Modals -->
    <script>
        // Selection and Bulk Actions Toggle
        function toggleSelectAll(master) {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(cb => cb.checked = master.checked);
            updateBulkBar();
        }

        function updateBulkBar() {
            const checked = document.querySelectorAll('.row-checkbox:checked');
            const bar = document.getElementById('bulkActionBar');
            const count = document.getElementById('selectedCount');
            const master = document.getElementById('selectAllCheckbox');

            if (checked.length > 0) {
                bar.classList.remove('hidden');
                bar.classList.add('flex');
                if (count) count.textContent = checked.length;
            } else {
                bar.classList.add('hidden');
                bar.classList.remove('flex');
                if (master) master.checked = false;
            }
        }

        function deselectAll() {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(cb => cb.checked = false);
            const master = document.getElementById('selectAllCheckbox');
            if (master) master.checked = false;
            updateBulkBar();
        }

        // Row Dropdown Toggle
        function toggleMenu(id) {
            const menus = document.querySelectorAll('[id^="menu-"]');
            menus.forEach(m => {
                if (m.id === id) {
                    m.classList.toggle('hidden');
                } else {
                    m.classList.add('hidden');
                }
            });
        }

        // Close menus on clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.relative')) {
                document.querySelectorAll('[id^="menu-"]').forEach(m => m.classList.add('hidden'));
            }
        });

        // Drawer Edit Preview
        function openDetail(sku, title, posko, rak, stok, status) {
            document.getElementById('drawerSku').textContent = '#' + sku;
            document.getElementById('drawerTitle').textContent = title;
            document.getElementById('drawerPoskoInput').value = posko;
            document.getElementById('drawerRakInput').value = rak;
            document.getElementById('drawerStatusSelect').value = status;
            document.getElementById('detailDrawer').classList.remove('hidden');
        }

        function closeDrawer() {
            document.getElementById('detailDrawer').classList.add('hidden');
        }

        function saveDrawer() {
            closeDrawer();
        }

        // Quick Stock Dialog
        let currentStockSku = '';
        function showStockDialog(sku, count) {
            currentStockSku = sku;
            document.getElementById('stockSkuLabel').textContent = '#' + sku;
            document.getElementById('stockNumberInput').value = count;
            document.getElementById('stockModal').classList.remove('hidden');
        }

        function changeStockInput(delta) {
            const inp = document.getElementById('stockNumberInput');
            let val = parseInt(inp.value) || 0;
            val = Math.max(0, val + delta);
            inp.value = val;
        }

        function confirmStockChange() {
            document.getElementById('stockModal').classList.add('hidden');
        }

        // Search & Filter functionality
        const searchInput = document.getElementById('searchInput');
        const filterCategory = document.getElementById('filterCategory');
        const filterStatus = document.getElementById('filterStatus');
        const filterPosko = document.getElementById('filterPosko');
        const tableRows = document.querySelectorAll('.table-row-item');

        function applyTableFilters() {
            const q = (searchInput?.value || '').toLowerCase();
            const cat = filterCategory?.value || 'all';
            const stat = filterStatus?.value || 'all';
            const pos = filterPosko?.value || 'all';

            tableRows.forEach(row => {
                const title = row.getAttribute('data-title') || '';
                const sku = row.getAttribute('data-sku') || '';
                const donor = row.getAttribute('data-donor') || '';
                const category = row.getAttribute('data-category') || '';
                const status = row.getAttribute('data-status') || '';
                const posko = row.getAttribute('data-posko') || '';

                const matchesQuery = !q || title.includes(q) || sku.includes(q) || donor.includes(q);
                const matchesCat = cat === 'all' || category.includes(cat);
                const matchesStat = stat === 'all' || status.includes(stat);
                const matchesPosko = pos === 'all' || posko.includes(pos);

                if (matchesQuery && matchesCat && matchesStat && matchesPosko) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        [searchInput, filterCategory, filterStatus, filterPosko].forEach(el => {
            if (el) {
                el.addEventListener('input', applyTableFilters);
                el.addEventListener('change', applyTableFilters);
            }
        });

        // Reset Filters
        document.getElementById('btnResetFilter')?.addEventListener('click', function() {
            if (searchInput) searchInput.value = '';
            if (filterCategory) filterCategory.value = 'all';
            if (filterStatus) filterStatus.value = 'all';
            if (filterPosko) filterPosko.value = 'all';
            applyTableFilters();
        });
    </script>
</body>
</html>
