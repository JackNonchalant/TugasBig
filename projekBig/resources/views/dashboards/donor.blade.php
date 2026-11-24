<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="web_dashboard" name="shell-type"/>
    <title>Dashboard Donatur - PojokBerbagi</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Plus+Jakarta+Sans:wght@600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <style>
        @layer base {
            html, body { margin: 0; padding: 0; }
            body { overscroll-behavior: none; }
            main > :first-child { margin-top: 0 !important; }
            main > :last-child { margin-bottom: 0 !important; }
        }
        ::-webkit-scrollbar { display: none; }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
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
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "space-xs": "0.25rem",
                        "gutter": "1.5rem",
                        "space-lg": "1.5rem",
                        "space-md": "1rem",
                        "space-xl": "2.5rem",
                        "space-sm": "0.5rem",
                        "margin": "1.5rem"
                    },
                    "fontFamily": {
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
                    "fontSize": {
                        "label-md": ["12px", {"lineHeight": "16px", "letterSpacing": "0.02em", "fontWeight": "500"}],
                        "label-sm": ["11px", {"lineHeight": "16px", "letterSpacing": "0.04em", "fontWeight": "600"}],
                        "label-lg": ["14px", {"lineHeight": "20px", "letterSpacing": "0em", "fontWeight": "500"}],
                        "headline-lg-mobile": ["30px", {"lineHeight": "38px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-md": ["15px", {"lineHeight": "24px", "letterSpacing": "0em", "fontWeight": "400"}],
                        "body-sm": ["13px", {"lineHeight": "20px", "letterSpacing": "0em", "fontWeight": "400"}],
                        "title-md": ["16px", {"lineHeight": "24px", "letterSpacing": "0em", "fontWeight": "600"}],
                        "headline-md": ["28px", {"lineHeight": "36px", "letterSpacing": "-0.015em", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "letterSpacing": "0em", "fontWeight": "400"}],
                        "headline-lg": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "headline-sm": ["20px", {"lineHeight": "28px", "letterSpacing": "-0.01em", "fontWeight": "600"}]
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-surface font-body-md text-body-md text-on-surface">

    <!-- Sidebar Navigation -->
    <aside class="fixed left-0 top-0 h-full w-64 bg-surface-container-low z-50 flex flex-col py-space-lg overflow-y-auto border-r border-outline-variant/30">
        <div class="px-6 mb-space-lg flex items-center gap-space-sm">
            <a href="{{ route('home') }}" class="flex items-center gap-space-sm">
                <img alt="PojokBerbagi Logo" class="h-8 w-auto object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAUwG0nfC5I5QCXnrPaGubX2M4S98gFIby55tDBjrRA2ADaCfpIJ50HqqriIwYnytogkFGnOyM1kcChMuVCw2-u0PUEjiRBass8Vg6ilwKoGYj_D5qOGc4DoCJFOF8IoiTvIR-Stzag67bZjWhw_kr_Wti7C4oOk4M7fTOBXGqpnWQ1fIrtNQ7FI8Zxc1rEfPK-HNmbQ40Dm7jrkBMFC2CFd5hdgVSgsNTm2KxbSQdu"/>
                <span class="font-headline-sm text-headline-sm text-primary tracking-tight">PojokBerbagi</span>
            </a>
        </div>

        <nav class="flex-1 px-3 space-y-1">
            <a aria-current="page" class="flex items-center px-3 py-2.5 transition-all bg-primary-container text-on-primary-container font-bold rounded-lg" data-path="dashboard-donatur" href="{{ route('donor.dashboard') }}">
                <span class="material-symbols-outlined mr-3 text-xl">dashboard</span>
                Dashboard Donatur
            </a>
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" data-path="posting-donasi" href="{{ route('items.create') }}">
                <span class="material-symbols-outlined mr-3 text-xl">add_box</span>
                Posting Donasi
            </a>
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" data-path="permintaan-saya" href="{{ route('permintaan.index') }}">
                <span class="material-symbols-outlined mr-3 text-xl">assignment</span>
                Lacak Status Posko
            </a>
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" data-path="katalog-donasi" href="{{ route('katalog.index') }}">
                <span class="material-symbols-outlined mr-3 text-xl">menu_book</span>
                Katalog Donasi
            </a>
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" data-path="notifikasi" href="{{ route('notifikasi.index') }}">
                <span class="material-symbols-outlined mr-3 text-xl">notifications</span>
                Notifikasi
            </a>
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" data-path="beranda" href="{{ route('home') }}">
                <span class="material-symbols-outlined mr-3 text-xl">home</span>
                Beranda Utama
            </a>
        </nav>

        <div class="px-4 pt-4 border-t border-outline-variant/30 mt-auto">
            <div class="flex items-center gap-3 px-2 py-2 mb-2">
                <div class="w-9 h-9 rounded-full bg-primary-container text-on-primary-container font-bold flex items-center justify-center text-sm shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="font-label-md text-label-md text-on-surface font-semibold truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-on-surface-variant capitalize">Donatur</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-3 py-2 rounded-lg font-label-lg text-label-lg text-error hover:bg-error-container/20 transition-all cursor-pointer">
                    <span class="material-symbols-outlined mr-3 text-xl">logout</span>
                    Keluar Akun
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="pl-64">
        <!-- Top Header -->
        <header class="fixed top-0 left-64 right-0 h-16 bg-surface/80 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-40 px-8 flex items-center justify-between gap-space-md border-b border-outline-variant/20">
            <div class="flex items-center gap-2 text-on-surface-variant font-label-md">
                <span>PojokBerbagi</span>
                <span>/</span>
                <span class="text-on-surface font-semibold">Dashboard Donatur</span>
            </div>
            <div class="flex items-center gap-space-md">
                <a href="{{ route('katalog.index') }}" class="font-label-md text-on-surface-variant hover:text-primary transition-colors flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-lg">storefront</span>
                    <span>Katalog</span>
                </a>
                <div class="w-px h-6 bg-outline-variant/40"></div>
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container font-bold text-xs flex items-center justify-center">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="font-label-lg text-label-lg text-on-surface font-semibold hidden sm:inline">{{ auth()->user()->name }}</span>
                </div>
            </div>
        </header>

        <!-- Main Body -->
        <main class="relative w-full px-8 pt-20 bg-surface min-h-screen">
            <div class="flex flex-col w-full gap-space-xl pb-12">
                <!-- Header Area -->
                <section class="flex flex-col md:flex-row md:items-end justify-between gap-space-md pt-4">
                    <div class="flex flex-col gap-1.5 min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary-container bg-primary-fixed/60 px-2.5 py-0.5 rounded-full font-bold">Dashboard Donatur</span>
                            <span class="font-label-md text-label-md text-on-surface-variant">•</span>
                            <span class="font-label-md text-label-md text-on-surface-variant">{{ date('F Y') }}</span>
                        </div>
                        <h1 class="font-headline-md text-headline-md text-on-surface tracking-tight">Selamat datang kembali, {{ auth()->user()->name }}</h1>
                        <p class="font-body-md text-body-md text-on-surface-variant">Pantau kontribusi dan status penyaluran barang pendidikan Anda secara transparan.</p>
                    </div>
                    <div class="flex items-center gap-space-sm shrink-0">
                        <a class="inline-flex items-center justify-center gap-2 bg-primary-container hover:bg-primary text-on-primary font-label-lg text-label-lg px-5 py-2.5 rounded-lg shadow-sm transition-all duration-200 hover:-translate-y-0.5" data-path="posting-donasi" href="{{ route('items.create') }}">
                            <span class="material-symbols-outlined text-lg">add</span>
                            <span>Tambah Donasi</span>
                        </a>
                    </div>
                </section>

                <!-- KPI Summary Row -->
                <section class="grid grid-cols-1 md:grid-cols-3 gap-space-lg">
                    <!-- KPI 1: Total Barang Didonasikan -->
                    <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-outline-variant/30 flex flex-col justify-between gap-4 transition-all duration-200 hover:shadow-md">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <span class="font-label-lg text-label-lg text-on-surface-variant">Total Barang Didonasikan</span>
                                <div class="flex items-baseline gap-2 mt-1">
                                    <span class="font-headline-lg text-headline-lg text-on-surface tabular-nums">{{ $totalPosted }}</span>
                                    <span class="font-title-md text-title-md text-on-surface-variant">Barang</span>
                                </div>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-surface-container flex items-center justify-center text-primary-container shrink-0">
                                <span class="material-symbols-outlined text-2xl">inventory_2</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-2">
                            <span class="font-body-sm text-body-sm text-on-surface-variant">{{ $totalKategori ?? 0 }} kategori pendidikan</span>
                            <!-- Sparkline Icon -->
                            <svg aria-hidden="true" class="w-20 h-6 text-primary-container" fill="none" viewbox="0 0 80 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 20L16 15L30 17L46 9L60 11L78 3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                <circle cx="78" cy="3" fill="currentColor" r="2.5"></circle>
                            </svg>
                        </div>
                    </div>

                    <!-- KPI 2: Menunggu Verifikasi -->
                    <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-outline-variant/30 flex flex-col justify-between gap-4 transition-all duration-200 hover:shadow-md">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <span class="font-label-lg text-label-lg text-on-surface-variant">Menunggu Verifikasi</span>
                                <div class="flex items-baseline gap-2 mt-1">
                                    <span class="font-headline-lg text-headline-lg text-on-surface tabular-nums">{{ $totalMenungguVerifikasi }}</span>
                                    <span class="font-title-md text-title-md text-on-surface-variant">Barang</span>
                                </div>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-tertiary-fixed/60 flex items-center justify-center text-on-tertiary-fixed-variant shrink-0">
                                <span class="material-symbols-outlined text-2xl">hourglass_top</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 pt-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-tertiary-fixed-dim shrink-0"></span>
                            <span class="font-body-sm text-body-sm text-on-tertiary-fixed-variant">Sedang diperiksa di Posko Transit</span>
                        </div>
                    </div>

                    <!-- KPI 3: Berhasil Disalurkan / Siap -->
                    @php
                        $persentaseTersedia = $totalPosted > 0 ? round(($totalTersedia / $totalPosted) * 100) : 0;
                    @endphp
                    <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-outline-variant/30 flex flex-col justify-between gap-4 transition-all duration-200 hover:shadow-md">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <span class="font-label-lg text-label-lg text-on-surface-variant">Siap di Katalog</span>
                                <div class="flex items-baseline gap-2 mt-1">
                                    <span class="font-headline-lg text-headline-lg text-on-surface tabular-nums">{{ $totalTersedia }}</span>
                                    <span class="font-title-md text-title-md text-on-surface-variant">Barang</span>
                                </div>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-primary-fixed/60 flex items-center justify-center text-primary-container shrink-0">
                                <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">verified</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-4 pt-2">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-primary-container shrink-0"></span>
                                <span class="font-body-sm text-body-sm text-primary-container font-medium">{{ $persentaseTersedia }}% lolos verifikasi</span>
                            </div>
                            <div class="w-24 h-2 bg-surface-container rounded-full overflow-hidden">
                                <div class="h-full bg-primary-container rounded-full transition-all duration-500" style="width: {{ $persentaseTersedia }}%;"></div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Recent Donations Table -->
                <section class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
                    <div class="px-6 py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-surface-container-lowest border-b border-outline-variant/20">
                        <div class="flex flex-col gap-0.5">
                            <h2 class="font-headline-sm text-headline-sm text-on-surface">Aktivitas Donasi Barang</h2>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Daftar barang pendidikan yang Anda daftarkan ke sistem PojokBerbagi.</p>
                        </div>
                        <a class="inline-flex items-center gap-1.5 font-label-lg text-label-lg text-primary-container hover:text-primary transition-colors" data-path="posting-donasi" href="{{ route('items.create') }}">
                            <span>+ Tambah Donasi Baru</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </a>
                    </div>

                    @if ($items->isEmpty())
                        <div class="p-12 text-center">
                            <div class="w-16 h-16 rounded-2xl bg-surface-container text-primary-container mx-auto flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-3xl">inventory_2</span>
                            </div>
                            <h3 class="font-title-md text-title-md text-on-surface">Belum Ada Donasi yang Diposting</h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant max-w-sm mx-auto mt-1 mb-6">
                                Mulai posting perlengkapan pendidikan pertama Anda untuk disalurkan ke adik-adik yang membutuhkan.
                            </p>
                            <a href="{{ route('items.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-lg text-label-lg shadow-sm hover:bg-primary transition-all">
                                <span class="material-symbols-outlined text-lg">add</span>
                                <span>Mulai Posting Donasi</span>
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-surface-container-low border-b border-outline-variant/20">
                                        <th class="py-3.5 px-6 font-label-md text-label-md uppercase tracking-wider text-on-surface-variant">Foto</th>
                                        <th class="py-3.5 px-4 font-label-md text-label-md uppercase tracking-wider text-on-surface-variant">Nama Barang</th>
                                        <th class="py-3.5 px-4 font-label-md text-label-md uppercase tracking-wider text-on-surface-variant">Kategori</th>
                                        <th class="py-3.5 px-4 font-label-md text-label-md uppercase tracking-wider text-on-surface-variant">Tanggal Posting</th>
                                        <th class="py-3.5 px-4 font-label-md text-label-md uppercase tracking-wider text-on-surface-variant">Status</th>
                                        <th class="py-3.5 px-6 font-label-md text-label-md uppercase tracking-wider text-on-surface-variant text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-surface-container-lowest divide-y divide-outline-variant/20">
                                    @foreach ($items as $item)
                                        <tr class="hover:bg-surface-container-low/60 transition-colors">
                                            <td class="py-4 px-6">
                                                @if ($item->foto)
                                                    <img alt="{{ $item->nama_barang }}" class="w-12 h-12 rounded-lg object-cover bg-surface-container shrink-0 border border-outline-variant/30" src="{{ $item->foto_url }}"/>
                                                @else
                                                    <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-primary-container shrink-0 border border-outline-variant/30">
                                                        <span class="material-symbols-outlined text-xl">menu_book</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="py-4 px-4">
                                                <a href="{{ route('items.show', $item->id) }}" class="font-title-md text-title-md text-on-surface hover:text-primary transition-colors block">
                                                    {{ $item->nama_barang }}
                                                </a>
                                                <div class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
                                                    Kondisi: <span class="font-medium text-on-surface">{{ $item->kondisi }}</span> • {{ $item->jumlah }} Unit
                                                </div>
                                                @if ($item->lokasi_posko)
                                                    <div class="text-xs text-primary-container font-medium mt-0.5 flex items-center gap-1">
                                                        <span class="material-symbols-outlined text-xs">location_on</span>
                                                        <span>Posko: {{ $item->lokasi_posko }}</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="py-4 px-4">
                                                <span class="font-body-md text-body-md text-on-surface-variant">{{ $item->kategori }}</span>
                                            </td>
                                            <td class="py-4 px-4">
                                                <span class="font-body-md text-body-md text-on-surface-variant tabular-nums">{{ $item->created_at->format('d M Y') }}</span>
                                                @if ($item->jadwal_penyerahan)
                                                    <div class="text-xs text-tertiary-container font-semibold mt-0.5 flex items-center gap-1">
                                                        <span class="material-symbols-outlined text-xs">event</span>
                                                        <span>Jadwal: {{ $item->jadwal_penyerahan->format('d M Y') }}</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="py-4 px-4">
                                                @if ($item->status === 'Menunggu Verifikasi Transit')
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-tertiary-fixed/50 text-on-tertiary-fixed-variant font-label-md text-label-md">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-tertiary-fixed-dim animate-pulse"></span>
                                                        Menunggu Verifikasi Transit
                                                    </span>
                                                @elseif ($item->status === 'tersedia')
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary-container text-on-secondary-fixed-variant font-label-md text-label-md">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-primary-container"></span>
                                                        Tersedia di Katalog
                                                    </span>
                                                @elseif ($item->status === 'disalurkan')
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-primary-fixed/70 text-on-primary-fixed-variant font-label-md text-label-md">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-primary-container"></span>
                                                        Disalurkan
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-md text-label-md">
                                                        {{ $item->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-6 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-surface-container hover:bg-primary-fixed/60 text-on-surface hover:text-primary-container font-label-lg text-label-lg transition-colors cursor-pointer" onclick="openDetailModal('{{ addslashes($item->nama_barang) }}', '{{ addslashes($item->status) }}', '{{ $item->created_at->format('d M Y') }}', '{{ addslashes($item->kategori) }}', '{{ addslashes($item->kondisi) }}', '{{ $item->jumlah }}', '{{ route('items.show', $item->id) }}')" type="button">
                                                        <span>Pratinjau</span>
                                                    </button>
                                                    <a href="{{ route('items.show', $item->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary-container hover:bg-primary text-on-primary font-label-lg text-label-lg transition-colors">
                                                        <span>Detail</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($items->hasPages())
                            <div class="p-4 border-t border-outline-variant/20 bg-surface-container-lowest">
                                {{ $items->links() }}
                            </div>
                        @endif
                    @endif
                </section>

                <!-- Lightweight Detail Modal -->
                <div class="fixed inset-0 z-50 hidden items-center justify-center bg-on-surface/30 backdrop-blur-sm p-4" id="detailModal">
                    <div class="bg-surface-container-lowest rounded-xl shadow-xl max-w-md w-full p-6 flex flex-col gap-4 border border-outline-variant/30">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary-container font-bold">Detail Donasi</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface" id="modalTitle">Nama Barang</h3>
                            </div>
                            <button class="p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container transition-colors cursor-pointer" onclick="closeDetailModal()" type="button">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        <div class="bg-surface-container-low rounded-lg p-4 flex flex-col gap-2.5">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-on-surface-variant font-medium">Status Saat Ini:</span>
                                <span class="font-label-md text-label-md text-primary-container font-semibold" id="modalStatus">Status</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-on-surface-variant font-medium">Kategori:</span>
                                <span class="text-on-surface font-semibold" id="modalCategory">-</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-on-surface-variant font-medium">Kondisi &amp; Jumlah:</span>
                                <span class="text-on-surface font-semibold" id="modalDetail">-</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-on-surface-variant font-medium">Tanggal Dibuat:</span>
                                <span class="text-on-surface tabular-nums" id="modalDate">Tanggal</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-2">
                            <a id="modalDetailLink" href="#" class="inline-flex items-center gap-1.5 text-primary-container hover:text-primary font-label-lg font-semibold transition-colors">
                                <span>Buka Halaman Lengkap</span>
                                <span class="material-symbols-outlined text-sm">open_in_new</span>
                            </a>
                            <button class="px-4 py-2 rounded-lg bg-surface-container text-on-surface font-label-lg text-label-lg hover:bg-surface-container-high transition-colors cursor-pointer" onclick="closeDetailModal()" type="button">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function openDetailModal(title, status, date, category, condition, quantity, detailUrl) {
                    document.getElementById('modalTitle').textContent = title;
                    document.getElementById('modalStatus').textContent = status;
                    document.getElementById('modalDate').textContent = date;
                    document.getElementById('modalCategory').textContent = category || '-';
                    document.getElementById('modalDetail').textContent = (condition || '') + (quantity ? ' • ' + quantity + ' Unit' : '');
                    document.getElementById('modalDetailLink').href = detailUrl || '#';

                    const modal = document.getElementById('detailModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }

                function closeDetailModal() {
                    const modal = document.getElementById('detailModal');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            </script>
        </main>
    </div>
</body>
</html>
