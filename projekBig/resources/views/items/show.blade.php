<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="web_standard" name="shell-type"/>
    <title>{{ $item->nama_barang }} - Detail Barang Donasi - PojokBerbagi</title>
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

    <!-- Top Fixed Header -->
    <header class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)] border-b border-outline-variant/20">
        <div class="h-16 max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between gap-space-md">
            <a class="flex items-center gap-space-sm shrink-0" data-path="beranda" href="{{ route('home') }}">
                <img alt="PojokBerbagi Logo" class="h-8 w-auto object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAUwG0nfC5I5QCXnrPaGubX2M4S98gFIby55tDBjrRA2ADaCfpIJ50HqqriIwYnytogkFGnOyM1kcChMuVCw2-u0PUEjiRBass8Vg6ilwKoGYj_D5qOGc4DoCJFOF8IoiTvIR-Stzag67bZjWhw_kr_Wti7C4oOk4M7fTOBXGqpnWQ1fIrtNQ7FI8Zxc1rEfPK-HNmbQ40Dm7jrkBMFC2CFd5hdgVSgsNTm2KxbSQdu"/>
                <span class="font-headline-sm text-headline-sm text-primary tracking-tight">PojokBerbagi</span>
            </a>

            <nav class="hidden md:flex items-center gap-space-lg">
                <a class="px-3 py-1.5 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="beranda" href="{{ route('home') }}">Beranda</a>
                <a class="px-3 py-1.5 transition-colors bg-primary-container text-on-primary-container font-bold rounded-lg" data-path="katalog-donasi" href="{{ route('katalog.index') }}">Katalog Donasi</a>
                <a class="px-3 py-1.5 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="cara-kerja" href="{{ route('home') }}#cara-kerja">Cara Kerja</a>
                <a class="px-3 py-1.5 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="tentang-kami" href="{{ route('home') }}#tentang-kami">Tentang Kami</a>
            </nav>

            <div class="flex items-center gap-space-sm">
                @auth
                    @if (auth()->user()->isDonor())
                        <a href="{{ route('donor.dashboard') }}" class="px-4 py-2 rounded-lg font-label-lg text-label-lg bg-primary text-on-primary hover:bg-primary-container transition-colors">
                            Dashboard Donatur
                        </a>
                    @elseif (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-lg font-label-lg text-label-lg bg-primary text-on-primary hover:bg-primary-container transition-colors">
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('beneficiary.dashboard') }}" class="px-4 py-2 rounded-lg font-label-lg text-label-lg bg-primary text-on-primary hover:bg-primary-container transition-colors">
                            Dashboard Penerima
                        </a>
                    @endif
                    <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container font-bold text-xs flex items-center justify-center ml-1">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @else
                    <a class="px-4 py-2 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-colors" data-path="masuk" href="{{ route('login') }}">Masuk</a>
                    <a class="px-4 py-2 rounded-lg font-label-lg text-label-lg bg-primary text-on-primary hover:bg-primary-container transition-colors" data-path="daftar" href="{{ route('register') }}">Daftar</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="w-full pt-16 bg-surface min-h-screen">
        <div class="flex flex-col w-full">
            <section class="w-full max-w-7xl mx-auto px-6 lg:px-12 py-8">
                <!-- Breadcrumb -->
                <nav aria-label="Breadcrumb" class="flex flex-wrap items-center gap-2 font-label-md text-label-md text-on-surface-variant mb-8">
                    <a class="hover:text-primary transition-colors" data-path="beranda" href="{{ route('home') }}">Beranda</a>
                    <span class="material-symbols-outlined text-base text-outline">chevron_right</span>
                    <a class="hover:text-primary transition-colors" data-path="katalog-donasi" href="{{ route('katalog.index') }}">Katalog Donasi</a>
                    <span class="material-symbols-outlined text-base text-outline">chevron_right</span>
                    <span class="text-on-surface font-semibold truncate max-w-md">{{ $item->nama_barang }}</span>
                </nav>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                    <!-- Left: Gallery Column -->
                    <div class="lg:col-span-6 flex flex-col gap-4">
                        <div class="relative w-full aspect-[4/3] rounded-xl overflow-hidden bg-surface-container-lowest shadow-sm border border-outline-variant/30">
                            @if ($item->foto)
                                <img class="w-full h-full object-cover transition-opacity duration-300" id="main-product-image" src="{{ $item->foto_url }}" alt="{{ $item->nama_barang }}"/>
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-primary-container bg-surface-container-low p-6 text-center">
                                    <span class="material-symbols-outlined text-6xl text-primary-container mb-2">menu_book</span>
                                    <span class="font-body-md text-on-surface-variant">Foto belum dilampirkan donatur</span>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4 bg-surface/90 backdrop-blur-md px-3 py-1.5 rounded-full flex items-center gap-1.5 shadow-sm border border-outline-variant/20">
                                <span class="material-symbols-outlined text-primary text-base" style="font-variation-settings: 'FILL' 1;">verified</span>
                                <span class="font-label-sm text-label-sm text-primary uppercase tracking-wider font-bold">Kondisi: {{ $item->kondisi }}</span>
                            </div>
                        </div>

                        <!-- Thumbnail Row -->
                        <div class="grid grid-cols-3 gap-4">
                            <button class="gallery-thumb group relative aspect-[4/3] rounded-lg overflow-hidden bg-surface-container-lowest shadow-sm ring-2 ring-primary transition-all border border-outline-variant/30" type="button">
                                @if ($item->foto)
                                    <img class="w-full h-full object-cover" src="{{ $item->foto_url }}" alt="Thumbnail Foto"/>
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-primary-container">
                                        <span class="material-symbols-outlined text-2xl">image</span>
                                    </div>
                                @endif
                            </button>
                        </div>
                    </div>

                    <!-- Right: Product Detail Column -->
                    <div class="lg:col-span-6 flex flex-col gap-6 bg-surface-container-lowest p-6 lg:p-8 rounded-xl shadow-sm border border-outline-variant/30">
                        <div class="flex flex-wrap items-center gap-2.5">
                            <span class="px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-md text-label-md font-medium">
                                {{ $item->kategori }}
                            </span>
                            @if ($item->status === 'Menunggu Verifikasi Transit')
                                <span class="px-3 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-md text-label-md inline-flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm">hourglass_top</span>
                                    {{ $item->status }}
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed font-label-md text-label-md inline-flex items-center gap-1.5 font-semibold">
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                                    Terverifikasi Posko Transit
                                </span>
                            @endif
                        </div>

                        <h1 class="font-headline-md text-headline-md text-on-surface tracking-tight">
                            {{ $item->nama_barang }}
                        </h1>

                        <!-- 2x2 Specs Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="bg-surface-container-low p-3.5 rounded-lg flex items-start gap-3 border border-outline-variant/20">
                                <span class="material-symbols-outlined text-primary text-xl mt-0.5">auto_awesome</span>
                                <div class="min-w-0">
                                    <p class="font-label-sm text-label-sm text-on-surface-variant uppercase font-medium">Kondisi</p>
                                    <p class="font-title-md text-title-md text-on-surface font-semibold">{{ $item->kondisi }}</p>
                                </div>
                            </div>
                            <div class="bg-surface-container-low p-3.5 rounded-lg flex items-start gap-3 border border-outline-variant/20">
                                <span class="material-symbols-outlined text-primary text-xl mt-0.5">inventory_2</span>
                                <div class="min-w-0">
                                    <p class="font-label-sm text-label-sm text-on-surface-variant uppercase font-medium">Jumlah Tersedia</p>
                                    <p class="font-title-md text-title-md text-on-surface font-semibold">{{ $item->jumlah }} Unit / Eksemplar</p>
                                </div>
                            </div>
                            <div class="bg-surface-container-low p-3.5 rounded-lg flex items-start gap-3 border border-outline-variant/20">
                                <span class="material-symbols-outlined text-primary text-xl mt-0.5">location_on</span>
                                <div class="min-w-0">
                                    <p class="font-label-sm text-label-sm text-on-surface-variant uppercase font-medium">Lokasi Posko Transit</p>
                                    <p class="font-title-md text-title-md text-on-surface truncate font-semibold">{{ $item->lokasi_posko ?? 'Posko Belum Ditentukan' }}</p>
                                </div>
                            </div>
                            <div class="bg-surface-container-low p-3.5 rounded-lg flex items-start gap-3 border border-outline-variant/20">
                                <span class="material-symbols-outlined text-primary text-xl mt-0.5">calendar_today</span>
                                <div class="min-w-0">
                                    <p class="font-label-sm text-label-sm text-on-surface-variant uppercase font-medium">Tanggal Donasi</p>
                                    <p class="font-title-md text-title-md text-on-surface font-semibold">{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</p>
                                    @if ($item->jadwal_penyerahan)
                                        <p class="text-xs text-primary font-medium mt-0.5">Jadwal Posko: {{ $item->jadwal_penyerahan->format('d M Y') }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Donor Identity Box -->
                            <div class="sm:col-span-2 bg-surface-container-low p-3.5 rounded-lg flex items-center justify-between gap-3 border border-outline-variant/20">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-9 h-9 rounded-full bg-primary-fixed text-on-primary-fixed flex items-center justify-center font-title-md text-title-md font-bold shrink-0">
                                        {{ $item->donor ? strtoupper(substr($item->donor->name, 0, 2)) : 'PB' }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-label-sm text-label-sm text-on-surface-variant uppercase font-medium">Donatur</p>
                                        <p class="font-title-md text-title-md text-on-surface truncate font-semibold">{{ $item->donor->name ?? 'Donatur PojokBerbagi' }} • Donatur Terverifikasi</p>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-primary text-xl shrink-0" style="font-variation-settings: 'FILL' 1;">verified</span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="flex flex-col gap-2">
                            <h2 class="font-title-md text-title-md text-on-surface font-semibold">Deskripsi Kondisi Barang</h2>
                            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed whitespace-pre-line">
                                {{ $item->deskripsi }}
                            </p>
                        </div>

                        <!-- Action Button Area -->
                        <div class="flex flex-col gap-3 pt-2 border-t border-outline-variant/20">
                            @auth
                                @if (auth()->user()->isBeneficiary() || auth()->user()->isAdmin())
                                    <a href="{{ route('items.claim', $item->id) }}" class="w-full py-3.5 px-6 rounded-lg bg-primary-container text-on-primary font-label-lg text-label-lg hover:bg-primary transition-colors flex items-center justify-center gap-2 shadow-sm font-semibold text-center cursor-pointer">
                                        <span class="material-symbols-outlined text-xl">volunteer_activism</span>
                                        <span>Ajukan Permintaan Barang</span>
                                    </a>
                                @elseif (auth()->user()->id === $item->user_id)
                                    <div class="p-3 bg-primary-fixed/40 rounded-lg text-center font-label-md text-primary font-semibold border border-primary-fixed-dim/40">
                                        Ini adalah barang donasi yang Anda daftarkan (Status: {{ $item->status }})
                                    </div>
                                @else
                                    <a href="{{ route('items.claim', $item->id) }}" class="w-full py-3.5 px-6 rounded-lg bg-primary-container text-on-primary font-label-lg text-label-lg hover:bg-primary transition-colors flex items-center justify-center gap-2 shadow-sm font-semibold text-center cursor-pointer">
                                        <span class="material-symbols-outlined text-xl">volunteer_activism</span>
                                        <span>Ajukan Permintaan Barang</span>
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="w-full py-3.5 px-6 rounded-lg bg-primary-container text-on-primary font-label-lg text-label-lg hover:bg-primary transition-colors flex items-center justify-center gap-2 shadow-sm font-semibold text-center cursor-pointer">
                                    <span class="material-symbols-outlined text-xl">login</span>
                                    <span>Masuk untuk Mengajukan Permintaan</span>
                                </a>
                            @endauth
                            <p class="font-body-sm text-body-sm text-on-surface-variant text-center">
                                Gratis biaya pengambilan di posko transit atau subsidi ongkir untuk penerima terverifikasi.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Recommendations / Related Items -->
            <section class="w-full bg-surface-container-low py-12 mt-4 border-t border-outline-variant/30">
                <div class="max-w-7xl mx-auto px-6 lg:px-12">
                    <div class="flex items-end justify-between gap-4 mb-8">
                        <div>
                            <p class="font-label-sm text-label-sm text-primary uppercase tracking-wider mb-1 font-bold">Rekomendasi Katalog</p>
                            <h2 class="font-headline-md text-headline-md text-on-surface tracking-tight">Barang Serupa Lainnya</h2>
                        </div>
                        <a class="font-label-lg text-label-lg text-primary hover:text-primary-container inline-flex items-center gap-1 transition-colors shrink-0 font-semibold" data-path="katalog-donasi" href="{{ route('katalog.index') }}">
                            <span>Lihat Semua</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @forelse ($relatedItems as $rel)
                            <a class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col border border-outline-variant/30" href="{{ route('items.show', $rel->id) }}">
                                <div class="aspect-[4/3] w-full overflow-hidden bg-surface-container">
                                    @if ($rel->foto)
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $rel->foto_url }}" alt="{{ $rel->nama_barang }}"/>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-primary-container">
                                            <span class="material-symbols-outlined text-4xl">menu_book</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-5 flex flex-col gap-2 flex-1">
                                    <span class="font-label-sm text-label-sm text-primary uppercase font-bold">{{ $rel->kategori }}</span>
                                    <h3 class="font-title-md text-title-md text-on-surface line-clamp-2 group-hover:text-primary transition-colors">
                                        {{ $rel->nama_barang }}
                                    </h3>
                                    <div class="mt-auto pt-3 flex items-center justify-between font-body-sm text-body-sm text-on-surface-variant border-t border-outline-variant/20">
                                        <span class="inline-flex items-center gap-1">
                                            <span class="material-symbols-outlined text-base text-primary">location_on</span>
                                            <span class="truncate max-w-[120px]">{{ $rel->lokasi_posko ?? 'Posko Transit' }}</span>
                                        </span>
                                        <span class="font-semibold text-on-surface">{{ $rel->jumlah }} Unit</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-4 text-center py-8 text-on-surface-variant font-body-sm">
                                Belum ada barang rekomendasi lainnya saat ini.
                            </div>
                        @endforelse
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
                    <li><a class="hover:text-on-surface transition-colors" data-path="cara-kerja" href="{{ route('home') }}#cara-kerja">Cara Kerja</a></li>
                    <li><a class="hover:text-on-surface transition-colors" data-path="tentang-kami" href="{{ route('home') }}#tentang-kami">Tentang Kami</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-label-lg text-label-lg text-on-surface mb-space-sm font-bold">Peran Pengguna</h4>
                <ul class="space-y-2 font-body-sm text-body-sm text-on-surface-variant">
                    @auth
                        @if (auth()->user()->isDonor())
                            <li><a class="hover:text-on-surface transition-colors" href="{{ route('donor.dashboard') }}">Dashboard Donatur</a></li>
                            <li><a class="hover:text-on-surface transition-colors" href="{{ route('items.create') }}">Posting Barang Donasi</a></li>
                        @elseif (auth()->user()->isAdmin())
                            <li><a class="hover:text-on-surface transition-colors" href="{{ route('admin.dashboard') }}">Portal Posko Transit (Admin)</a></li>
                        @else
                            <li><a class="hover:text-on-surface transition-colors" href="{{ route('beneficiary.dashboard') }}">Dashboard Penerima Manfaat</a></li>
                            <li><a class="hover:text-on-surface transition-colors" href="{{ route('permintaan.index') }}">Permintaan Saya</a></li>
                        @endif
                    @else
                        <li><a class="hover:text-on-surface transition-colors" href="{{ route('login') }}">Dashboard Donatur</a></li>
                        <li><a class="hover:text-on-surface transition-colors" href="{{ route('login') }}">Dashboard Penerima Manfaat</a></li>
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
