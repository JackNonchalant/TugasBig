<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="web_dashboard" name="shell-type"/>
    <title>Dashboard Penerima Manfaat - PojokBerbagi</title>
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
            <a aria-current="page" class="flex items-center px-3 py-2.5 transition-all bg-primary-container text-on-primary-container font-bold rounded-lg" data-path="dashboard-penerima" href="{{ route('beneficiary.dashboard') }}">
                <span class="material-symbols-outlined mr-3 text-xl">volunteer_activism</span>
                Dashboard Penerima
            </a>
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" data-path="permintaan-saya" href="{{ route('permintaan.index') }}">
                <span class="material-symbols-outlined mr-3 text-xl">assignment</span>
                Permintaan Saya
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
                    <p class="text-xs text-on-surface-variant capitalize">Penerima Manfaat</p>
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
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors">PojokBerbagi</a>
                <span>/</span>
                <span class="text-on-surface font-semibold">Dashboard Penerima</span>
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
            <div class="flex flex-col w-full gap-10 pb-12">
                <!-- Welcome Section -->
                <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 pt-6">
                    <div class="flex flex-col gap-2 max-w-2xl">
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-1 rounded-full bg-primary-fixed text-on-primary-fixed font-label-sm text-label-sm uppercase tracking-wider font-bold">Penerima Manfaat Terverifikasi</span>
                            <span class="text-outline font-label-sm text-label-sm">•</span>
                            <span class="text-on-surface-variant font-label-sm text-label-sm">ID: PB-PEN-{{ str_pad(auth()->id(), 3, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <h1 class="font-headline-md text-headline-md text-on-surface tracking-tight">
                            Halo, {{ auth()->user()->name }}
                        </h1>
                        <p class="font-body-md text-body-md text-on-surface-variant">
                            Kelola permintaan perlengkapan belajar dan temukan barang pendidikan yang siap disalurkan langsung dari posko transit.
                        </p>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <a href="{{ route('katalog.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-lg text-label-lg shadow-sm hover:bg-primary transition-all">
                            <span class="material-symbols-outlined text-xl">explore</span>
                            <span>Jelajahi Katalog Lengkap</span>
                        </a>
                    </div>
                </section>

                <!-- KPI Summary Cards -->
                <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- KPI 1 -->
                    <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-outline-variant/30 flex flex-col justify-between gap-4 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div class="flex flex-col gap-1">
                                <span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Barang Siap Disalurkan</span>
                                <span class="font-headline-lg text-headline-lg text-on-surface tabular-nums">{{ $totalTersedia }} Barang</span>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-surface-container flex items-center justify-center text-primary-container">
                                <span class="material-symbols-outlined text-2xl">inventory_2</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-2">
                            <span class="font-body-sm text-body-sm text-on-surface-variant">Terverifikasi di Posko Transit</span>
                            <svg class="w-20 h-6 text-primary-container" fill="none" viewbox="0 0 80 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 20L16 15L30 17L46 9L62 11L78 3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- KPI 2 -->
                    <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-outline-variant/30 flex flex-col justify-between gap-4 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div class="flex flex-col gap-1">
                                <span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Posko Transit Aktif</span>
                                <span class="font-headline-lg text-headline-lg text-on-surface tabular-nums">3 Titik Posko</span>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed-variant">
                                <span class="material-symbols-outlined text-2xl">local_shipping</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 pt-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-tertiary-fixed-dim inline-block"></span>
                            <span class="font-body-sm text-body-sm text-on-tertiary-fixed-variant font-medium">Bandung &amp; Jakarta</span>
                        </div>
                    </div>

                    <!-- KPI 3 -->
                    <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-outline-variant/30 flex flex-col justify-between gap-4 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div class="flex flex-col gap-1">
                                <span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Standar Kualitas</span>
                                <span class="font-headline-lg text-headline-lg text-on-surface tabular-nums">100% Terkurasi</span>
                            </div>
                            <div class="w-11 h-11 rounded-xl bg-primary-fixed flex items-center justify-center text-on-primary-fixed">
                                <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 pt-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-primary-container inline-block"></span>
                            <span class="font-body-sm text-body-sm text-primary-container font-medium">Melewati cek fisik relawan</span>
                        </div>
                    </div>
                </section>

                <!-- Katalog Terbaru Section -->
                <section class="flex flex-col gap-6" id="katalog-terbaru">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex flex-col gap-1">
                            <h2 class="font-headline-sm text-headline-sm text-on-surface">Barang Pendidikan Tersedia di Katalog</h2>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Barang telah melalui kurasi dan verifikasi fisik di Posko Transit, siap diajukan untuk kebutuhan belajar.</p>
                        </div>
                        <a class="inline-flex items-center gap-1.5 font-label-lg text-label-lg text-primary-container hover:text-primary transition-colors font-semibold" href="{{ route('katalog.index') }}">
                            <span>Lihat Semua Katalog</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </a>
                    </div>

                    @if ($items->isEmpty())
                        <div class="bg-surface-container-lowest rounded-xl border border-outline-variant/30 p-12 text-center shadow-sm">
                            <div class="w-16 h-16 rounded-2xl bg-surface-container text-primary-container flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-3xl">menu_book</span>
                            </div>
                            <h3 class="font-title-md text-title-md text-on-surface">Belum Ada Barang yang Tersedia</h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant max-w-md mx-auto mt-1">
                                Saat ini belum ada barang pendidikan yang lolos verifikasi di katalog. Silakan periksa kembali secara berkala.
                            </p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach ($items as $item)
                                <article class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-outline-variant/30 hover:shadow-md transition-all flex flex-col group">
                                    <div class="relative h-48 w-full overflow-hidden bg-surface-container">
                                        @if ($item->foto)
                                            <img alt="{{ $item->nama_barang }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $item->foto_url }}"/>
                                        @else
                                            <div class="w-full h-full flex flex-col items-center justify-center text-on-surface-variant/50 p-4">
                                                <span class="material-symbols-outlined text-4xl mb-1 text-primary-container">menu_book</span>
                                                <span class="text-xs">PojokBerbagi</span>
                                            </div>
                                        @endif
                                        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-surface-bright/90 backdrop-blur-sm text-primary-container font-label-sm text-label-sm font-semibold shadow-xs">
                                            {{ $item->kategori }}
                                        </span>
                                        <span class="absolute top-3 right-3 px-2.5 py-1 rounded-full bg-primary-fixed text-on-primary-fixed font-label-sm text-label-sm font-medium">
                                            {{ $item->kondisi }}
                                        </span>
                                    </div>
                                    <div class="p-5 flex flex-col flex-1 justify-between gap-4">
                                        <div class="flex flex-col gap-2">
                                            <h3 class="font-title-md text-title-md text-on-surface line-clamp-2">
                                                <a href="{{ route('items.show', $item->id) }}" class="hover:text-primary transition-colors">
                                                    {{ $item->nama_barang }}
                                                </a>
                                            </h3>
                                            <div class="flex items-center gap-1.5 text-on-surface-variant font-body-sm text-body-sm">
                                                <span class="material-symbols-outlined text-base text-primary-container">location_on</span>
                                                <span class="truncate">{{ $item->lokasi_posko ?? 'Posko Transit Pusat' }}</span>
                                            </div>
                                            <div class="flex items-center gap-1.5 text-on-surface-variant font-body-sm text-body-sm">
                                                <span class="material-symbols-outlined text-base text-primary-container">inventory_2</span>
                                                <span>Tersedia: <strong>{{ $item->jumlah }} Unit</strong></span>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between pt-3 bg-surface-container-low/50 -mx-5 -mb-5 px-5 py-3.5 border-t border-outline-variant/20">
                                            <span class="font-label-sm text-label-sm text-primary-container flex items-center gap-1 font-semibold">
                                                <span class="material-symbols-outlined text-base">verified</span>
                                                Siap Diajukan
                                            </span>
                                            <div class="flex items-center gap-2">
                                                <button class="px-3 py-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md transition-colors cursor-pointer" onclick="openDetailModal('{{ addslashes($item->nama_barang) }}', '{{ addslashes($item->kategori) }}', '{{ addslashes($item->lokasi_posko ?? 'Posko Transit Pusat') }}', '{{ addslashes($item->deskripsi) }}', '{{ route('items.show', $item->id) }}')" type="button">
                                                    Pratinjau
                                                </button>
                                                <a href="{{ route('items.show', $item->id) }}" class="px-4 py-1.5 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md hover:bg-primary transition-colors">
                                                    Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        @if ($items->hasPages())
                            <div class="mt-4">
                                {{ $items->links() }}
                            </div>
                        @endif
                    @endif
                </section>

                <!-- Status Permintaan Terakhir -->
                <section class="flex flex-col gap-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="font-headline-sm text-headline-sm text-on-surface">Alur Transparansi Penyaluran</h2>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Setiap pengajuan disalurkan melalui verifikasi posko transit secara terencana.</p>
                        </div>
                    </div>
                    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-surface-container-low text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider border-b border-outline-variant/20">
                                        <th class="py-3.5 px-6">Tahap</th>
                                        <th class="py-3.5 px-6">Aktivitas</th>
                                        <th class="py-3.5 px-6">Pelaksana</th>
                                        <th class="py-3.5 px-6 text-right">Status Standar</th>
                                    </tr>
                                </thead>
                                <tbody class="font-body-md text-body-md text-on-surface divide-y divide-outline-variant/20">
                                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                                        <td class="py-4 px-6 font-label-lg text-label-lg text-on-surface-variant font-bold">Langkah 1</td>
                                        <td class="py-4 px-6 font-medium">Donatur Posting Barang &amp; Memilih Posko Transit</td>
                                        <td class="py-4 px-6 text-on-surface-variant">Donatur Terdaftar</td>
                                        <td class="py-4 px-6 text-right">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-tertiary-fixed/60 text-on-tertiary-fixed-variant font-label-sm text-label-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-tertiary-fixed-dim"></span>
                                                Menunggu Verifikasi Transit
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                                        <td class="py-4 px-6 font-label-lg text-label-lg text-on-surface-variant font-bold">Langkah 2</td>
                                        <td class="py-4 px-6 font-medium">Pemeriksaan Fisik dan Kelayakan Barang di Posko</td>
                                        <td class="py-4 px-6 text-on-surface-variant">Petugas Posko Transit</td>
                                        <td class="py-4 px-6 text-right">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary-container text-on-secondary-fixed-variant font-label-sm text-label-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-primary-container"></span>
                                                Tersedia di Katalog
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                                        <td class="py-4 px-6 font-label-lg text-label-lg text-on-surface-variant font-bold">Langkah 3</td>
                                        <td class="py-4 px-6 font-medium">Penerima Manfaat Memilih &amp; Mengajukan Barang Edukasi</td>
                                        <td class="py-4 px-6 text-on-surface-variant">Penerima Manfaat</td>
                                        <td class="py-4 px-6 text-right">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed font-label-sm text-label-sm font-semibold">
                                                <span class="w-1.5 h-1.5 rounded-full bg-primary-container"></span>
                                                Siap Disalurkan
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Interactive Detail Modal -->
                <div class="fixed inset-0 z-50 hidden items-center justify-center bg-on-surface/40 backdrop-blur-xs p-4" id="detail-modal">
                    <div class="bg-surface-container-lowest rounded-xl shadow-xl max-w-lg w-full p-6 flex flex-col gap-5 border border-outline-variant/30">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <span class="px-2.5 py-0.5 rounded-full bg-primary-fixed text-on-primary-fixed font-label-sm text-label-sm w-fit font-bold" id="modal-category">Kategori</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface" id="modal-title">Judul Barang</h3>
                            </div>
                            <button class="p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container-high transition-colors cursor-pointer" onclick="closeDetailModal()" type="button">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        <div class="flex items-center gap-2 text-on-surface-variant font-body-sm text-body-sm bg-surface-container-low px-3.5 py-2.5 rounded-lg border border-outline-variant/20">
                            <span class="material-symbols-outlined text-primary-container text-lg">location_on</span>
                            <span id="modal-location">Lokasi Posko</span>
                        </div>
                        <p class="font-body-md text-body-md text-on-surface-variant" id="modal-desc">Deskripsi barang.</p>
                        <div class="flex items-center justify-between pt-2">
                            <a id="modal-detail-link" href="#" class="inline-flex items-center gap-1.5 text-primary-container hover:text-primary font-label-lg font-semibold transition-colors">
                                <span>Lihat Halaman Penuh</span>
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
                function openDetailModal(title, category, location, desc, detailUrl) {
                    document.getElementById('modal-title').textContent = title;
                    document.getElementById('modal-category').textContent = category;
                    document.getElementById('modal-location').textContent = location;
                    document.getElementById('modal-desc').textContent = desc;
                    document.getElementById('modal-detail-link').href = detailUrl || '#';

                    const modal = document.getElementById('detail-modal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }

                function closeDetailModal() {
                    const modal = document.getElementById('detail-modal');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            </script>
        </main>
    </div>
</body>
</html>
