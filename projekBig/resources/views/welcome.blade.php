<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="web_standard" name="shell-type"/>
    <title>PojokBerbagi - Platform Donasi Pendidikan Transparan</title>
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
                        "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.02em", "fontWeight": "500" }],
                        "label-sm": ["11px", { "lineHeight": "16px", "letterSpacing": "0.04em", "fontWeight": "600" }],
                        "label-lg": ["14px", { "lineHeight": "20px", "letterSpacing": "0em", "fontWeight": "500" }],
                        "headline-lg-mobile": ["30px", { "lineHeight": "38px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-md": ["15px", { "lineHeight": "24px", "letterSpacing": "0em", "fontWeight": "400" }],
                        "body-sm": ["13px", { "lineHeight": "20px", "letterSpacing": "0em", "fontWeight": "400" }],
                        "title-md": ["16px", { "lineHeight": "24px", "letterSpacing": "0em", "fontWeight": "600" }],
                        "headline-md": ["28px", { "lineHeight": "36px", "letterSpacing": "-0.015em", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "letterSpacing": "0em", "fontWeight": "400" }],
                        "headline-lg": ["40px", { "lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "headline-sm": ["20px", { "lineHeight": "28px", "letterSpacing": "-0.01em", "fontWeight": "600" }]
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-surface font-body-md text-body-md text-on-surface">

    <!-- Header Navigation -->
    <header class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
        <div class="h-16 max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between gap-space-md">
            <!-- Brand Logo -->
            <a class="flex items-center gap-space-sm shrink-0" data-path="beranda" href="{{ route('home') }}">
                <img alt="PojokBerbagi Logo" class="h-8 w-auto object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAUwG0nfC5I5QCXnrPaGubX2M4S98gFIby55tDBjrRA2ADaCfpIJ50HqqriIwYnytogkFGnOyM1kcChMuVCw2-u0PUEjiRBass8Vg6ilwKoGYj_D5qOGc4DoCJFOF8IoiTvIR-Stzag67bZjWhw_kr_Wti7C4oOk4M7fTOBXGqpnWQ1fIrtNQ7FI8Zxc1rEfPK-HNmbQ40Dm7jrkBMFC2CFd5hdgVSgsNTm2KxbSQdu"/>
                <span class="font-headline-sm text-headline-sm text-primary tracking-tight">PojokBerbagi</span>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-space-lg" data-active-classes="bg-primary-container text-on-primary-container font-bold rounded-lg">
                <a aria-current="page" class="px-3 py-1.5 transition-colors bg-primary-container text-on-primary-container font-bold rounded-lg" data-path="beranda" href="{{ route('home') }}">Beranda</a>
                <a class="px-3 py-1.5 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="katalog-donasi" href="{{ route('katalog.index') }}">Katalog Donasi</a>
                <a class="px-3 py-1.5 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="cara-kerja" href="#cara-kerja">Cara Kerja</a>
                <a class="px-3 py-1.5 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="tentang-kami" href="#tentang-kami">Tentang Kami</a>
            </nav>

            <!-- Auth Buttons / User Profile -->
            <div class="flex items-center gap-space-sm">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg font-label-lg text-label-lg bg-secondary-container text-primary font-semibold hover:bg-primary-container hover:text-on-primary-container transition-colors">
                        @if (auth()->user()->isDonor())
                            Dashboard Donatur
                        @elseif (auth()->user()->isAdmin())
                            Dashboard Admin
                        @else
                            Katalog Donasi
                        @endif
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-3 py-2 rounded-lg font-label-lg text-label-lg text-error hover:bg-error-container hover:text-on-error-container transition-colors">
                            Keluar
                        </button>
                    </form>
                    <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary font-bold flex items-center justify-center text-xs ml-1 shadow-sm" title="{{ auth()->user()->name }} ({{ auth()->user()->role }})">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @else
                    <a class="px-4 py-2 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-colors" data-path="masuk" href="{{ route('login') }}">Masuk</a>
                    <a class="px-4 py-2 rounded-lg font-label-lg text-label-lg bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container transition-colors" data-path="daftar" href="{{ route('register') }}">Daftar</a>
                    <img alt="Profile" class="w-8 h-8 rounded-full object-cover ml-1" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB1NV6neHR4lx9CpRGjB9r_Kxnrpdvw2LVYcgKvMWaAW0WpvchClmsIuee1oQmpfRujP0npaQy7y3tZWW9cFKbcSJjOozOkj8MTRoMX8-nqYfl19Se1S4NbMNtEy2-Y2T9wWufKgD1f0qd-jh1i__VYcPmDTYM-DicV2JK7L-QHdFW4IikKvwV5huMMGCrdNTRd4ThexnseI0RNO4nWC4HXkyvY0bj1zLUY9AkrwID3"/>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="w-full pt-16 bg-surface">
        <div class="flex flex-col w-full">

            <!-- 1. Hero Section: Split Editorial Layout -->
            <section class="w-full py-12 lg:py-20">
                <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <!-- Left: Editorial Copy & Actions -->
                    <div class="lg:col-span-6 flex flex-col items-start">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-secondary-container text-primary font-label-md text-label-md mb-6">
                            <span class="w-2 h-2 rounded-full bg-primary-container"></span>
                            Platform Donasi Pendidikan Transparan
                        </span>
                        <h1 class="font-headline-lg text-headline-lg text-on-surface mb-6">
                            Barang Layak, Kesempatan Belajar Lebih Luas.
                        </h1>
                        <p class="font-body-lg text-body-lg text-on-surface-variant mb-8 max-w-xl">
                            Salurkan perlengkapan pendidikan yang masih layak pakai kepada mereka yang membutuhkan. Satu barang sederhana bisa menjadi awal perubahan besar.
                        </p>
                        <div class="flex flex-wrap items-center gap-4">
                            <a class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-primary-container text-on-primary font-label-lg text-label-lg hover:bg-primary transition-colors shadow-sm" data-path="katalog-donasi" href="{{ route('katalog.index') }}">
                                <span>Jelajahi Donasi</span>
                                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                            </a>
                            @auth
                                @if (auth()->user()->isDonor())
                                    <a class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-surface-container-lowest text-on-surface font-label-lg text-label-lg hover:bg-surface-container transition-colors shadow-sm" data-path="posting-donasi" href="{{ route('items.create') }}">
                                        <span>Posting Donasi</span>
                                    </a>
                                @else
                                    <a class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-surface-container-lowest text-on-surface font-label-lg text-label-lg hover:bg-surface-container transition-colors shadow-sm" data-path="dashboard" href="{{ route('dashboard') }}">
                                        <span>Ke Dashboard</span>
                                    </a>
                                @endif
                            @else
                                <a class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-surface-container-lowest text-on-surface font-label-lg text-label-lg hover:bg-surface-container transition-colors shadow-sm" data-path="daftar" href="{{ route('register') }}">
                                    <span>Mulai Berdonasi</span>
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Right: Authentic Photograph -->
                    <div class="lg:col-span-6">
                        <div class="relative rounded-xl overflow-hidden bg-surface-container-lowest shadow-md">
                            <img alt="Perlengkapan pendidikan tertata rapi di atas meja kayu" class="w-full h-[360px] lg:h-[460px] object-cover" data-alt="Authentic editorial photograph of neatly arranged educational supplies, stacked hardcover textbooks, notebooks, wooden pencils, rulers, and a canvas backpack on a warm natural oak wooden desk. Soft morning sunlight streams from a side window, casting gentle shadows. Clean, warm, inviting minimalist aesthetic with muted sage green and warm off-white tones." src="https://lh3.googleusercontent.com/aida-public/AB6AXuB856aZeL6APqNEnxFCVpVXWpusTMH3NtKQyJHdUSUHNr3FO_X8UGXDE_kIMDA4QFJj7PU7aQx_6L97XFH7t5Es0WUprN-478PgXrZvqYB0Z2apLcIbzveaMbbOt6BkrNmYqvHM0Qh0CS76U0QR4J7kCVLoTLwAZkXZdKtJzkiQaT3bibHjXiJA-BmQrfCN-wBk-6i4Jmdm7AEINDwPmtyVjRd2uEKiJzOGbK6e9eTb"/>
                            <div class="p-4 bg-surface-container-lowest flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-primary-container">verified</span>
                                    <span class="font-body-sm text-body-sm text-on-surface-variant">Setiap barang melalui kurasi kelayakan di Posko Transit</span>
                                </div>
                                <span class="font-label-sm text-label-sm text-primary uppercase tracking-wider">Terverifikasi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 2. Impact Statistics Bar -->
            <section class="w-full py-6">
                <div class="max-w-7xl mx-auto px-6 lg:px-12">
                    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-6 lg:p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg bg-secondary-container flex items-center justify-center text-primary shrink-0">
                                <span class="material-symbols-outlined">inventory_2</span>
                            </div>
                            <div class="min-w-0">
                                <p class="font-headline-md text-headline-md text-on-surface tabular-nums" data-counter="12480">12.480+</p>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Total Barang Tersalurkan</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg bg-secondary-container flex items-center justify-center text-primary shrink-0">
                                <span class="material-symbols-outlined">school</span>
                            </div>
                            <div class="min-w-0">
                                <p class="font-headline-md text-headline-md text-on-surface tabular-nums" data-counter="3850">3.850+</p>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Penerima Manfaat</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg bg-secondary-container flex items-center justify-center text-primary shrink-0">
                                <span class="material-symbols-outlined">volunteer_activism</span>
                            </div>
                            <div class="min-w-0">
                                <p class="font-headline-md text-headline-md text-on-surface tabular-nums" data-counter="1920">1.920+</p>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Donatur Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 3. Featured Donation Catalog ("Katalog Donasi Terbaru") -->
            <section class="w-full py-12 lg:py-16">
                <div class="max-w-7xl mx-auto px-6 lg:px-12">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                        <div>
                            <span class="font-label-sm text-label-sm text-primary uppercase tracking-wider">Katalog Pilihan</span>
                            <h2 class="font-headline-md text-headline-md text-on-surface mt-1">Katalog Donasi Terbaru</h2>
                        </div>
                        <a class="inline-flex items-center gap-1.5 font-label-lg text-label-lg text-primary-container hover:text-primary transition-colors" data-path="katalog-donasi" href="{{ route('katalog.index') }}">
                            <span>Lihat Semua Katalog</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @if ($recentItems->isNotEmpty())
                            @foreach ($recentItems as $item)
                                <article class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                                    <div class="relative h-48 w-full bg-surface-container">
                                        @if ($item->foto)
                                            <img alt="{{ $item->nama_barang }}" class="w-full h-full object-cover" src="{{ $item->foto_url }}"/>
                                        @else
                                            <img alt="{{ $item->nama_barang }}" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDG2T0ZLwTq5GAZkLFOB2UIGZZaxeK3283B8N8Oa8iBiDddFHHKDcOh7AeTZb02wd7lol9Ef2LhXEtKKy6GZAXZGqfFI3QRBSEFfcf_wT83u2fmQS_eA2TbD8c9sJA9T4S87VKVx8FLOJ_5gs1E1KAZ8iSGpJwVGcss_iXHfeUaw5luYMZx2_bkVzjRwqXfztlOyc7Ka18GJ1gWOQnC2nhyUGFp0xS-J9eCm-XUgOXI"/>
                                        @endif
                                        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-secondary-container text-primary font-label-sm text-label-sm">
                                            {{ $item->kategori }}
                                        </span>
                                    </div>
                                    <div class="p-5 flex flex-col flex-1 justify-between gap-4">
                                        <div>
                                            <div class="flex items-center justify-between gap-2 mb-2">
                                                <span class="inline-flex items-center gap-1 text-primary font-label-sm text-label-sm">
                                                    <span class="w-1.5 h-1.5 rounded-full {{ $item->status === 'Menunggu Verifikasi Transit' ? 'bg-tertiary-container' : 'bg-primary-container' }}"></span>
                                                    {{ $item->status === 'Menunggu Verifikasi Transit' ? 'Verifikasi Transit' : 'Tersedia' }}
                                                </span>
                                                <span class="font-label-sm text-label-sm text-on-surface-variant">{{ $item->kondisi }}</span>
                                            </div>
                                            <h3 class="font-title-md text-title-md text-on-surface line-clamp-2 mb-2">{{ $item->nama_barang }}</h3>
                                            <p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1.5">
                                                <span class="material-symbols-outlined text-[16px]">location_on</span>
                                                <span class="truncate">{{ $item->lokasi_posko ?? 'Posko Transit Bandung' }}</span>
                                            </p>
                                        </div>
                                        <a class="w-full inline-flex items-center justify-center py-2.5 px-4 rounded-lg bg-surface-container text-on-surface font-label-lg text-label-lg hover:bg-secondary-container hover:text-primary transition-colors" data-path="detail-donasi" href="{{ route('items.show', $item->id) }}">
                                            Detail
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <!-- Card 1: Buku Matematika Kelas 10 -->
                            <article class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                                <div class="relative h-48 w-full bg-surface-container">
                                    <img alt="Buku Matematika Kelas 10" class="w-full h-full object-cover" data-alt="Clean product photograph of a high school Mathematics Grade 10 textbook (Buku Matematika Kelas 10) lying flat on a light neutral surface, neat condition, crisp pages, soft natural daylight, minimalist editorial style." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDG2T0ZLwTq5GAZkLFOB2UIGZZaxeK3283B8N8Oa8iBiDddFHHKDcOh7AeTZb02wd7lol9Ef2LhXEtKKy6GZAXZGqfFI3QRBSEFfcf_wT83u2fmQS_eA2TbD8c9sJA9T4S87VKVx8FLOJ_5gs1E1KAZ8iSGpJwVGcss_iXHfeUaw5luYMZx2_bkVzjRwqXfztlOyc7Ka18GJ1gWOQnC2nhyUGFp0xS-J9eCm-XUgOXI"/>
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-secondary-container text-primary font-label-sm text-label-sm">
                                        Buku Pelajaran
                                    </span>
                                </div>
                                <div class="p-5 flex flex-col flex-1 justify-between gap-4">
                                    <div>
                                        <div class="flex items-center justify-between gap-2 mb-2">
                                            <span class="inline-flex items-center gap-1 text-primary font-label-sm text-label-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-primary-container"></span>
                                                Tersedia
                                            </span>
                                            <span class="font-label-sm text-label-sm text-on-surface-variant">Sangat Baik</span>
                                        </div>
                                        <h3 class="font-title-md text-title-md text-on-surface line-clamp-2 mb-2">Buku Matematika Kelas 10</h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1.5">
                                            <span class="material-symbols-outlined text-[16px]">location_on</span>
                                            <span class="truncate">Posko Jakarta Selatan</span>
                                        </p>
                                    </div>
                                    <a class="w-full inline-flex items-center justify-center py-2.5 px-4 rounded-lg bg-surface-container text-on-surface font-label-lg text-label-lg hover:bg-secondary-container hover:text-primary transition-colors" data-path="detail-donasi" href="{{ route('katalog.index') }}">
                                        Detail
                                    </a>
                                </div>
                            </article>
                            <!-- Card 2: Paket Alat Tulis Sekolah -->
                            <article class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                                <div class="relative h-48 w-full bg-surface-container">
                                    <img alt="Paket Alat Tulis Sekolah" class="w-full h-full object-cover" data-alt="Clean product photograph of a complete school stationery set including notebooks, ballpoint pens, wooden pencils, eraser, and ruler neatly arranged on a warm off-white surface, soft natural studio lighting, minimalist editorial aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDUM6p_0_YOc2HL9fA1XKzbFH94HuV9K4da_T0sIUuM0dbS5IaVqLVMbifczFlpbbXlPZVbA-UumuLQ9Kbsp9vI2Mxa51gzn7XRUVn33W8kwROCGYRI4lqjFOmCfFk-3GPMnUCs3JPTxh0bQ94UdzKu7np_3U-h56UkywXto9L84OfjsYZoJPYtXZsZ8CT1K14aSFBn7SHXZEM80trhSX6faIu4UBhtuT_sQEALJkzG"/>
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-secondary-container text-primary font-label-sm text-label-sm">
                                        Alat Tulis
                                    </span>
                                </div>
                                <div class="p-5 flex flex-col flex-1 justify-between gap-4">
                                    <div>
                                        <div class="flex items-center justify-between gap-2 mb-2">
                                            <span class="inline-flex items-center gap-1 text-primary font-label-sm text-label-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-primary-container"></span>
                                                Tersedia
                                            </span>
                                            <span class="font-label-sm text-label-sm text-on-surface-variant">Baru / Segel</span>
                                        </div>
                                        <h3 class="font-title-md text-title-md text-on-surface line-clamp-2 mb-2">Paket Alat Tulis Sekolah</h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1.5">
                                            <span class="material-symbols-outlined text-[16px]">location_on</span>
                                            <span class="truncate">Posko Bandung</span>
                                        </p>
                                    </div>
                                    <a class="w-full inline-flex items-center justify-center py-2.5 px-4 rounded-lg bg-surface-container text-on-surface font-label-lg text-label-lg hover:bg-secondary-container hover:text-primary transition-colors" data-path="detail-donasi" href="{{ route('katalog.index') }}">
                                        Detail
                                    </a>
                                </div>
                            </article>
                            <!-- Card 3: Seragam Putih Abu-Abu -->
                            <article class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                                <div class="relative h-48 w-full bg-surface-container">
                                    <img alt="Seragam Putih Abu-Abu" class="w-full h-full object-cover" data-alt="Clean product photograph of a neatly folded Indonesian senior high school uniform (Seragam Putih Abu-Abu) on a warm neutral surface, crisp white shirt and grey trousers, soft daylight, minimalist editorial look." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBV0BpimVdDUZsO9_KAwG8-cozrbopb6ys2uGJXiFhIukg3ipGKXCh7NpX_6vKHG1IPx1PcCrwfMrVVb3ANm4QmF6U3Z_VdRh0HgeKKVVj5kRpCxb_TlUGzAYUXrU56LE7odTIB01gVOBAaSIxon_f2AXDPkqSZ43CHFqFl02_BAXGmx-tBzd-QOn9QUoPtNuD43cQOeyBJKNFlf0z3mItv6dWBitFPs0QUb9nyRBwD"/>
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-secondary-container text-primary font-label-sm text-label-sm">
                                        Seragam
                                    </span>
                                </div>
                                <div class="p-5 flex flex-col flex-1 justify-between gap-4">
                                    <div>
                                        <div class="flex items-center justify-between gap-2 mb-2">
                                            <span class="inline-flex items-center gap-1 text-primary font-label-sm text-label-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-primary-container"></span>
                                                Tersedia
                                            </span>
                                            <span class="font-label-sm text-label-sm text-on-surface-variant">Layak Pakai</span>
                                        </div>
                                        <h3 class="font-title-md text-title-md text-on-surface line-clamp-2 mb-2">Seragam Putih Abu-Abu</h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1.5">
                                            <span class="material-symbols-outlined text-[16px]">location_on</span>
                                            <span class="truncate">Posko Yogyakarta</span>
                                        </p>
                                    </div>
                                    <a class="w-full inline-flex items-center justify-center py-2.5 px-4 rounded-lg bg-surface-container text-on-surface font-label-lg text-label-lg hover:bg-secondary-container hover:text-primary transition-colors" data-path="detail-donasi" href="{{ route('katalog.index') }}">
                                        Detail
                                    </a>
                                </div>
                            </article>
                            <!-- Card 4: Buku Cerita Anak -->
                            <article class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                                <div class="relative h-48 w-full bg-surface-container">
                                    <img alt="Buku Cerita Anak" class="w-full h-full object-cover" data-alt="Clean product photograph of a small stack of illustrated Indonesian children's storybooks (Buku Cerita Anak) on a warm off-white table, gentle natural morning light, warm and inviting minimalist editorial style." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBRfeUG1mAIEFBZfjom2hGUfROJRjRw-0xiNvIwcYjgpFpYRgtE_kOSK17O6R0-hJOcPvGb4ynWHB6ONr9yYbJRO_Z3eZnGJh85FeXw3LTcEBayxX81yYTjFf420nc6Foi4wLKKNK8w3wSnWPfyTsP_OPid2gn6O_Q02fY7XNa-c7HjbOERll03BLo6YfyOQ0lRgH9IRu33Cu77HOVS8I6rLBmnZK9J9zzinNEATLOf"/>
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-secondary-container text-primary font-label-sm text-label-sm">
                                        Buku Bacaan
                                    </span>
                                </div>
                                <div class="p-5 flex flex-col flex-1 justify-between gap-4">
                                    <div>
                                        <div class="flex items-center justify-between gap-2 mb-2">
                                            <span class="inline-flex items-center gap-1 text-primary font-label-sm text-label-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-primary-container"></span>
                                                Tersedia
                                            </span>
                                            <span class="font-label-sm text-label-sm text-on-surface-variant">Sangat Baik</span>
                                        </div>
                                        <h3 class="font-title-md text-title-md text-on-surface line-clamp-2 mb-2">Buku Cerita Anak</h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1.5">
                                            <span class="material-symbols-outlined text-[16px]">location_on</span>
                                            <span class="truncate">Posko Surabaya</span>
                                        </p>
                                    </div>
                                    <a class="w-full inline-flex items-center justify-center py-2.5 px-4 rounded-lg bg-surface-container text-on-surface font-label-lg text-label-lg hover:bg-secondary-container hover:text-primary transition-colors" data-path="detail-donasi" href="{{ route('katalog.index') }}">
                                        Detail
                                    </a>
                                </div>
                            </article>
                        @endif
                    </div>
                </div>
            </section>

            <!-- 4. How It Works ("Cara Kerja PojokBerbagi") -->
            <section id="cara-kerja" class="w-full py-12 lg:py-20 bg-surface-container-low">
                <div class="max-w-7xl mx-auto px-6 lg:px-12">
                    <div class="max-w-2xl mb-10">
                        <span class="font-label-sm text-label-sm text-primary uppercase tracking-wider">Alur Transparan</span>
                        <h2 class="font-headline-md text-headline-md text-on-surface mt-1">Cara Kerja PojokBerbagi</h2>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-2">
                            Lima langkah terstruktur untuk memastikan setiap barang pendidikan sampai ke tangan yang tepat.
                        </p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                        <!-- Step 1 -->
                        <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm flex flex-col justify-between gap-4">
                            <div class="flex items-center justify-between">
                                <span class="w-8 h-8 rounded-full bg-secondary-container text-primary font-label-lg text-label-lg flex items-center justify-center font-bold">1</span>
                                <span class="material-symbols-outlined text-on-surface-variant">upload_file</span>
                            </div>
                            <div>
                                <h3 class="font-title-md text-title-md text-on-surface mb-1">Donatur mengunggah barang</h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Foto dan deskripsi kondisi barang diunggah melalui akun donatur.</p>
                            </div>
                        </div>
                        <!-- Step 2 -->
                        <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm flex flex-col justify-between gap-4">
                            <div class="flex items-center justify-between">
                                <span class="w-8 h-8 rounded-full bg-secondary-container text-primary font-label-lg text-label-lg flex items-center justify-center font-bold">2</span>
                                <span class="material-symbols-outlined text-on-surface-variant">fact_check</span>
                            </div>
                            <div>
                                <h3 class="font-title-md text-title-md text-on-surface mb-1">Tim Posko Transit memverifikasi barang</h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Kurasi kelayakan fungsi dan kebersihan dilakukan di posko terdekat.</p>
                            </div>
                        </div>
                        <!-- Step 3 -->
                        <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm flex flex-col justify-between gap-4">
                            <div class="flex items-center justify-between">
                                <span class="w-8 h-8 rounded-full bg-secondary-container text-primary font-label-lg text-label-lg flex items-center justify-center font-bold">3</span>
                                <span class="material-symbols-outlined text-on-surface-variant">storefront</span>
                            </div>
                            <div>
                                <h3 class="font-title-md text-title-md text-on-surface mb-1">Barang masuk katalog</h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Barang terverifikasi tampil di katalog publik dengan status tersedia.</p>
                            </div>
                        </div>
                        <!-- Step 4 -->
                        <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm flex flex-col justify-between gap-4">
                            <div class="flex items-center justify-between">
                                <span class="w-8 h-8 rounded-full bg-secondary-container text-primary font-label-lg text-label-lg flex items-center justify-center font-bold">4</span>
                                <span class="material-symbols-outlined text-on-surface-variant">assignment_turned_in</span>
                            </div>
                            <div>
                                <h3 class="font-title-md text-title-md text-on-surface mb-1">Penerima mengajukan klaim</h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Pelajar atau komunitas belajar mengajukan klaim sesuai kebutuhan.</p>
                            </div>
                        </div>
                        <!-- Step 5 -->
                        <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm flex flex-col justify-between gap-4">
                            <div class="flex items-center justify-between">
                                <span class="w-8 h-8 rounded-full bg-secondary-container text-primary font-label-lg text-label-lg flex items-center justify-center font-bold">5</span>
                                <span class="material-symbols-outlined text-on-surface-variant">handshake</span>
                            </div>
                            <div>
                                <h3 class="font-title-md text-title-md text-on-surface mb-1">Barang diserahkan secara langsung</h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Penyerahan dilakukan di Posko Transit dengan pencatatan transparan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer id="tentang-kami" class="w-full bg-surface-container-low py-space-xl border-t border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 md:grid-cols-4 gap-space-lg">
            <div>
                <div class="flex items-center gap-space-sm mb-space-sm">
                    <img alt="PojokBerbagi Logo" class="h-7 w-auto object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAUwG0nfC5I5QCXnrPaGubX2M4S98gFIby55tDBjrRA2ADaCfpIJ50HqqriIwYnytogkFGnOyM1kcChMuVCw2-u0PUEjiRBass8Vg6ilwKoGYj_D5qOGc4DoCJFOF8IoiTvIR-Stzag67bZjWhw_kr_Wti7C4oOk4M7fTOBXGqpnWQ1fIrtNQ7FI8Zxc1rEfPK-HNmbQ40Dm7jrkBMFC2CFd5hdgVSgsNTm2KxbSQdu"/>
                    <span class="font-title-md text-title-md text-primary">PojokBerbagi</span>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Platform donasi barang edukasi transparan untuk pemerataan akses belajar di Indonesia.</p>
            </div>
            <div>
                <h4 class="font-label-lg text-label-lg text-on-surface mb-space-sm font-bold">Navigasi</h4>
                <ul class="space-y-2 font-body-sm text-body-sm text-on-surface-variant">
                    <li><a class="hover:text-on-surface transition-colors" data-path="beranda" href="{{ route('home') }}">Beranda</a></li>
                    <li><a class="hover:text-on-surface transition-colors" data-path="katalog-donasi" href="{{ route('katalog.index') }}">Katalog Donasi</a></li>
                    <li><a class="hover:text-on-surface transition-colors" data-path="cara-kerja" href="#cara-kerja">Cara Kerja</a></li>
                    <li><a class="hover:text-on-surface transition-colors" data-path="tentang-kami" href="#tentang-kami">Tentang Kami</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-label-lg text-label-lg text-on-surface mb-space-sm font-bold">Peran Pengguna</h4>
                <ul class="space-y-2 font-body-sm text-body-sm text-on-surface-variant">
                    @auth
                        @if (auth()->user()->isDonor())
                            <li><a class="hover:text-on-surface transition-colors" data-path="dashboard-donatur" href="{{ route('donor.dashboard') }}">Dashboard Donatur</a></li>
                            <li><a class="hover:text-on-surface transition-colors" data-path="posting-donasi" href="{{ route('items.create') }}">Posting Barang Donasi</a></li>
                        @elseif (auth()->user()->isAdmin())
                            <li><a class="hover:text-on-surface transition-colors" data-path="dashboard-admin" href="{{ route('admin.dashboard') }}">Portal Posko Transit (Admin)</a></li>
                        @else
                            <li><a class="hover:text-on-surface transition-colors" data-path="dashboard-penerima" href="{{ route('beneficiary.dashboard') }}">Dashboard Penerima Manfaat</a></li>
                        @endif
                    @else
                        <li><a class="hover:text-on-surface transition-colors" data-path="dashboard-donatur" href="{{ route('login') }}">Dashboard Donatur</a></li>
                        <li><a class="hover:text-on-surface transition-colors" data-path="dashboard-penerima" href="{{ route('login') }}">Dashboard Penerima Manfaat</a></li>
                        <li><a class="hover:text-on-surface transition-colors" data-path="dashboard-admin" href="{{ route('login') }}">Portal Posko Transit</a></li>
                    @endauth
                </ul>
            </div>
            <div>
                <h4 class="font-label-lg text-label-lg text-on-surface mb-space-sm font-bold">Kontak &amp; Transparansi</h4>
                <p class="font-body-sm text-body-sm text-on-surface-variant">halo@pojokberbagi.id</p>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Bandung &amp; Jakarta, Indonesia</p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 lg:px-12 mt-space-lg pt-space-md text-center font-body-sm text-body-sm text-on-surface-variant">
            &copy; {{ date('Y') }} PojokBerbagi. Seluruh hak cipta dilindungi.
        </div>
    </footer>
</body>
</html>
