<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="web_dashboard" name="shell-type"/>
    <title>Posting Donasi Baru - PojokBerbagi</title>
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
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" data-path="dashboard-donatur" href="{{ route('donor.dashboard') }}">
                <span class="material-symbols-outlined mr-3 text-xl">dashboard</span>
                Dashboard Donatur
            </a>
            <a aria-current="page" class="flex items-center px-3 py-2.5 transition-all bg-primary-container text-on-primary-container font-bold rounded-lg" data-path="posting-donasi" href="{{ route('items.create') }}">
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
                <a href="{{ route('donor.dashboard') }}" class="hover:text-primary transition-colors">Dashboard Donatur</a>
                <span>/</span>
                <span class="text-on-surface font-semibold">Posting Donasi Baru</span>
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

        <!-- Main Body Form -->
        <main class="relative w-full px-8 pt-20 bg-surface min-h-screen">
            <div class="flex flex-col w-full pb-16">
                <!-- Page Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pt-6 pb-8">
                    <div class="max-w-2xl">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="font-label-sm text-label-sm uppercase tracking-widest text-primary font-bold px-2.5 py-1 rounded-full bg-primary-fixed text-on-primary-fixed">Formulir Donasi</span>
                            <span class="text-on-surface-variant/50 text-xs">•</span>
                            <span class="font-label-md text-label-md text-on-surface-variant">Langkah 1 dari 1</span>
                        </div>
                        <h1 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface tracking-tight">Posting Barang Donasi Pendidikan</h1>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-2">Bagikan perlengkapan belajar layak pakai Anda. Setiap barang akan melalui kurasi singkat di posko transit sebelum disalurkan kepada penerima manfaat.</p>
                    </div>
                    <div class="flex items-center gap-3 bg-surface-container-low px-4 py-3 rounded-xl border border-outline-variant/30 shadow-sm">
                        <span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                        <div class="min-w-0">
                            <p class="font-label-lg text-label-lg text-on-surface font-semibold">Kurasi Posko Transit</p>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Jaminan kualitas untuk penerima</p>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="p-4 rounded-xl bg-error-container text-on-error-container mb-6 border border-error/30 text-sm">
                        <div class="font-semibold mb-1 flex items-center gap-2">
                            <span class="material-symbols-outlined text-error text-xl">error</span>
                            Terdapat isian yang perlu diperiksa kembali:
                        </div>
                        <ul class="list-disc list-inside space-y-0.5 text-xs ml-6">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Two-Column Editorial Form Layout -->
                <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start" id="donationForm">
                    @csrf

                    <!-- Left / Main Column -->
                    <div class="lg:col-span-8 flex flex-col gap-8">
                        <!-- Section 1: Detail Barang -->
                        <section class="bg-surface-container-lowest rounded-xl p-6 md:p-8 shadow-sm border border-outline-variant/30">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-primary-fixed text-on-primary-fixed flex items-center justify-center font-headline-sm text-sm font-bold">01</span>
                                    <h2 class="font-headline-sm text-headline-sm text-on-surface">Informasi Barang</h2>
                                </div>
                                <span class="font-label-sm text-label-sm text-on-surface-variant">* Wajib diisi</span>
                            </div>
                            <div class="flex flex-col gap-6">
                                <!-- Nama Barang * -->
                                <div class="flex flex-col gap-2">
                                    <label class="font-label-lg text-label-lg text-on-surface font-medium" for="namaBarang">
                                        Nama Barang <span class="text-error">*</span>
                                    </label>
                                    <input class="w-full px-4 py-3 rounded-lg bg-surface-container-low text-on-surface placeholder:text-on-surface-variant/60 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-surface-container transition-colors font-body-md text-body-md border border-outline-variant/30 @error('nama_barang') border-error @enderror" id="namaBarang" name="nama_barang" placeholder="Contoh: Buku Matematika Kelas 10 Kurikulum Merdeka" required="" type="text" value="{{ old('nama_barang') }}"/>
                                    @error('nama_barang')
                                        <p class="text-xs text-error mt-0.5">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Kategori Barang * -->
                                <div class="flex flex-col gap-2">
                                    <label class="font-label-lg text-label-lg text-on-surface font-medium" for="kategoriBarang">
                                        Kategori Barang <span class="text-error">*</span>
                                    </label>
                                    <div class="relative">
                                        <select class="w-full appearance-none px-4 py-3 pr-10 rounded-lg bg-surface-container-low text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:bg-surface-container transition-colors font-body-md text-body-md cursor-pointer border border-outline-variant/30 @error('kategori') border-error @enderror" id="kategoriBarang" name="kategori" required="">
                                            <option disabled="" {{ old('kategori') ? '' : 'selected' }} value="">Pilih kategori barang edukasi</option>
                                            @foreach ($kategoriList as $kat)
                                                <option value="{{ $kat }}" {{ old('kategori') === $kat ? 'selected' : '' }}>
                                                    {{ $kat }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
                                    </div>
                                    @error('kategori')
                                        <p class="text-xs text-error mt-0.5">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Jumlah Barang * & Kondisi Barang * Side-by-Side -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div class="flex flex-col gap-2">
                                        <label class="font-label-lg text-label-lg text-on-surface font-medium" for="jumlahBarang">
                                            Jumlah Barang <span class="text-error">*</span>
                                        </label>
                                        <div class="relative flex items-center">
                                            <input class="w-full px-4 py-3 rounded-lg bg-surface-container-low text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:bg-surface-container transition-colors font-body-md text-body-md border border-outline-variant/30 @error('jumlah') border-error @enderror" id="jumlahBarang" min="1" max="10000" name="jumlah" required="" type="number" value="{{ old('jumlah', 1) }}"/>
                                            <span class="absolute right-4 font-label-md text-label-md text-on-surface-variant pointer-events-none">Unit / Pcs</span>
                                        </div>
                                        @error('jumlah')
                                            <p class="text-xs text-error mt-0.5">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label class="font-label-lg text-label-lg text-on-surface font-medium" for="kondisiBarang">
                                            Kondisi Barang <span class="text-error">*</span>
                                        </label>
                                        <div class="relative">
                                            <select class="w-full appearance-none px-4 py-3 pr-10 rounded-lg bg-surface-container-low text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:bg-surface-container transition-colors font-body-md text-body-md cursor-pointer border border-outline-variant/30 @error('kondisi') border-error @enderror" id="kondisiBarang" name="kondisi" required="">
                                                <option disabled="" value="">Pilih kondisi</option>
                                                @foreach ($kondisiList as $kon)
                                                    <option value="{{ $kon }}" {{ old('kondisi', 'Sangat Baik') === $kon ? 'selected' : '' }}>
                                                        {{ $kon }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
                                        </div>
                                        @error('kondisi')
                                            <p class="text-xs text-error mt-0.5">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Deskripsi * -->
                                <div class="flex flex-col gap-2">
                                    <label class="font-label-lg text-label-lg text-on-surface font-medium" for="deskripsiBarang">
                                        Deskripsi Barang <span class="text-error">*</span>
                                    </label>
                                    <textarea class="w-full px-4 py-3 rounded-lg bg-surface-container-low text-on-surface placeholder:text-on-surface-variant/60 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-surface-container transition-colors font-body-md text-body-md resize-y border border-outline-variant/30 @error('deskripsi') border-error @enderror" id="deskripsiBarang" name="deskripsi" placeholder="Jelaskan kondisi detail, edisi terbitan, ukuran seragam, atau kelengkapan halaman..." required="" rows="4">{{ old('deskripsi') }}</textarea>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">Deskripsi yang jelas membantu calon penerima memilih barang sesuai kebutuhan belajarnya.</p>
                                    @error('deskripsi')
                                        <p class="text-xs text-error mt-0.5">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </section>

                        <!-- Section 2: Upload Foto Barang -->
                        <section class="bg-surface-container-lowest rounded-xl p-6 md:p-8 shadow-sm border border-outline-variant/30">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-primary-fixed text-on-primary-fixed flex items-center justify-center font-headline-sm text-sm font-bold">02</span>
                                    <h2 class="font-headline-sm text-headline-sm text-on-surface">Upload Foto Barang</h2>
                                </div>
                                <span class="font-label-md text-label-md text-on-surface-variant" id="photoCountLabel">Maksimal 5MB (JPG/PNG/WEBP)</span>
                            </div>

                            <!-- Dashed Dropzone -->
                            <div class="relative rounded-xl bg-surface-container-low/70 hover:bg-surface-container-low transition-colors p-8 text-center cursor-pointer group border-2 border-dashed border-outline-variant/60 hover:border-primary" onclick="document.getElementById('fileInput').click()">
                                <input accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden" id="fileInput" name="foto" type="file" onchange="handleFileSelect(event)"/>
                                <div class="w-12 h-12 rounded-full bg-surface-container-lowest shadow-sm flex items-center justify-center mx-auto mb-3 text-primary group-hover:scale-105 transition-transform">
                                    <span class="material-symbols-outlined text-2xl">cloud_upload</span>
                                </div>
                                <p class="font-title-md text-title-md text-on-surface">Unggah Foto Barang Donasi</p>
                                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Seret dan lepas foto ke sini, atau klik untuk memilih file dari komputer</p>
                            </div>

                            <!-- Preview Thumbnail Container -->
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-6 hidden" id="photoPreviewGrid">
                                <div class="relative group rounded-xl overflow-hidden bg-surface-container-high aspect-[4/3] shadow-sm border border-outline-variant/30" id="previewThumbCard">
                                    <img alt="Pratinjau Foto Donasi" id="previewImageElement" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="#"/>
                                    <div class="absolute inset-0 bg-gradient-to-t from-on-surface/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <button aria-label="Hapus foto" class="absolute top-2.5 right-2.5 w-7 h-7 rounded-full bg-surface-container-lowest/90 text-on-surface hover:bg-error hover:text-on-error flex items-center justify-center shadow-sm transition-colors cursor-pointer" onclick="removeSelectedPhoto()" type="button">
                                        <span class="material-symbols-outlined text-base">close</span>
                                    </button>
                                    <span class="absolute bottom-2.5 left-2.5 px-2 py-0.5 rounded bg-surface-container-lowest/90 font-label-sm text-label-sm text-on-surface" id="previewFileName">Foto Utama</span>
                                </div>
                            </div>

                            @error('foto')
                                <p class="text-xs text-error mt-2">{{ $message }}</p>
                            @enderror
                        </section>

                        <!-- Section 3: Logistik & Penyerahan -->
                        <section class="bg-surface-container-lowest rounded-xl p-6 md:p-8 shadow-sm border border-outline-variant/30">
                            <div class="flex items-center gap-3 mb-6">
                                <span class="w-8 h-8 rounded-lg bg-primary-fixed text-on-primary-fixed flex items-center justify-center font-headline-sm text-sm font-bold">03</span>
                                <h2 class="font-headline-sm text-headline-sm text-on-surface">Logistik &amp; Penyerahan</h2>
                            </div>
                            <div class="flex flex-col gap-6">
                                <!-- Lokasi Posko Transit * -->
                                <div class="flex flex-col gap-2">
                                    <label class="font-label-lg text-label-lg text-on-surface font-medium" for="lokasiPosko">
                                        Lokasi Posko Transit <span class="text-error">*</span>
                                    </label>
                                    <div class="relative">
                                        <select class="w-full appearance-none px-4 py-3 pr-10 rounded-lg bg-surface-container-low text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:bg-surface-container transition-colors font-body-md text-body-md cursor-pointer border border-outline-variant/30 @error('lokasi_posko') border-error @enderror" id="lokasiPosko" name="lokasi_posko" required="">
                                            <option disabled="" {{ old('lokasi_posko') ? '' : 'selected' }} value="">Pilih Posko Transit</option>
                                            @foreach ($poskoTransitList as $posko)
                                                <option value="{{ $posko }}" {{ old('lokasi_posko') === $posko ? 'selected' : '' }}>
                                                    {{ $posko }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">location_on</span>
                                    </div>
                                    @error('lokasi_posko')
                                        <p class="text-xs text-error mt-0.5">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Tanggal Penyerahan * -->
                                <div class="flex flex-col gap-2">
                                    <label class="font-label-lg text-label-lg text-on-surface font-medium" for="tanggalPenyerahan">
                                        Tanggal Penyerahan <span class="text-error">*</span>
                                    </label>
                                    <input class="w-full px-4 py-3 rounded-lg bg-surface-container-low text-on-surface focus:outline-none focus:ring-2 focus:ring-primary focus:bg-surface-container transition-colors font-body-md text-body-md border border-outline-variant/30 @error('jadwal_penyerahan') border-error @enderror" id="tanggalPenyerahan" min="{{ date('Y-m-d') }}" name="jadwal_penyerahan" required="" type="date" value="{{ old('jadwal_penyerahan', date('Y-m-d', strtotime('+1 day'))) }}"/>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">Pilih tanggal kesiapan Anda untuk mengantar atau menyerahkan barang ke posko transit.</p>
                                    @error('jadwal_penyerahan')
                                        <p class="text-xs text-error mt-0.5">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Right Column (Sticky Summary & Status Info) -->
                    <aside class="lg:col-span-4 lg:sticky lg:top-24 flex flex-col gap-6">
                        <!-- Live Summary Card -->
                        <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-outline-variant/30">
                            <div class="flex items-center justify-between mb-4">
                                <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-bold">Ringkasan Donasi</span>
                                <span class="px-2.5 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm">Draft Baru</span>
                            </div>
                            <div class="flex flex-col gap-3 py-4 bg-surface-container-low rounded-lg px-4 mb-5 border border-outline-variant/20">
                                <div class="flex justify-between items-start gap-2">
                                    <span class="font-body-sm text-body-sm text-on-surface-variant">Barang</span>
                                    <span class="font-label-lg text-label-lg text-on-surface font-semibold text-right truncate max-w-[180px]" id="summaryNama">Belum diisi</span>
                                </div>
                                <div class="flex justify-between items-center gap-2">
                                    <span class="font-body-sm text-body-sm text-on-surface-variant">Kategori</span>
                                    <span class="font-label-md text-label-md text-on-surface font-medium" id="summaryKategori">-</span>
                                </div>
                                <div class="flex justify-between items-center gap-2">
                                    <span class="font-body-sm text-body-sm text-on-surface-variant">Jumlah &amp; Kondisi</span>
                                    <span class="font-label-md text-label-md text-on-surface font-medium" id="summaryJumlahKondisi">1 Unit • Sangat Baik</span>
                                </div>
                                <div class="flex justify-between items-start gap-2">
                                    <span class="font-body-sm text-body-sm text-on-surface-variant">Posko Transit</span>
                                    <span class="font-label-md text-label-md text-on-surface text-right max-w-[180px] font-medium" id="summaryPosko">Belum dipilih</span>
                                </div>
                                <div class="flex justify-between items-center gap-2">
                                    <span class="font-body-sm text-body-sm text-on-surface-variant">Tanggal Serah</span>
                                    <span class="font-label-md text-label-md text-on-surface font-medium tabular-nums" id="summaryJadwal">-</span>
                                </div>
                            </div>

                            <!-- Verification Process Info Card -->
                            <div class="rounded-xl bg-tertiary-fixed/40 p-4 flex items-start gap-3 mb-6 border border-tertiary-fixed-dim/30">
                                <span class="material-symbols-outlined text-on-tertiary-fixed-variant text-xl mt-0.5 shrink-0" style="font-variation-settings: 'FILL' 1;">info</span>
                                <p class="font-body-sm text-body-sm text-on-tertiary-fixed leading-relaxed">
                                    Setelah dikirim, barang Anda akan berstatus <span class="font-semibold text-primary">'Menunggu Verifikasi Transit'</span> sebelum tayang di katalog.
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col gap-3">
                                <button class="w-full py-3.5 px-5 rounded-lg bg-primary-container hover:bg-primary text-on-primary font-label-lg text-label-lg font-semibold shadow-sm hover:shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer" type="submit">
                                    <span>Kirim Donasi</span>
                                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                                </button>
                                <a href="{{ route('donor.dashboard') }}" class="w-full py-3 px-5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg font-medium transition-colors flex items-center justify-center gap-2 text-center">
                                    <span class="material-symbols-outlined text-lg">close</span>
                                    <span>Batal</span>
                                </a>
                            </div>
                        </div>

                        <!-- Donator Badge Card -->
                        <div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm border border-outline-variant/30 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-primary-container text-on-primary-container font-bold flex items-center justify-center text-sm shrink-0">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="font-label-md text-label-md text-on-surface font-semibold truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-on-surface-variant truncate">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </aside>
                </form>
            </div>

            <!-- Client Script for Live Summary and Image Preview -->
            <script>
                const namaInput = document.getElementById('namaBarang');
                const kategoriSelect = document.getElementById('kategoriBarang');
                const jumlahInput = document.getElementById('jumlahBarang');
                const kondisiSelect = document.getElementById('kondisiBarang');
                const poskoSelect = document.getElementById('lokasiPosko');
                const jadwalInput = document.getElementById('tanggalPenyerahan');

                function updateSummary() {
                    document.getElementById('summaryNama').textContent = (namaInput && namaInput.value.trim()) || 'Belum diisi';
                    document.getElementById('summaryKategori').textContent = (kategoriSelect && kategoriSelect.value) || '-';
                    const jml = (jumlahInput && jumlahInput.value) || '1';
                    const knd = (kondisiSelect && kondisiSelect.value) || '-';
                    document.getElementById('summaryJumlahKondisi').textContent = `${jml} Unit • ${knd}`;
                    document.getElementById('summaryPosko').textContent = (poskoSelect && poskoSelect.value) || 'Belum dipilih';
                    document.getElementById('summaryJadwal').textContent = (jadwalInput && jadwalInput.value) || '-';
                }

                [namaInput, kategoriSelect, jumlahInput, kondisiSelect, poskoSelect, jadwalInput].forEach(el => {
                    if (el) {
                        el.addEventListener('input', updateSummary);
                        el.addEventListener('change', updateSummary);
                    }
                });

                // Initialize summary on page load
                updateSummary();

                // Handle file preview
                function handleFileSelect(event) {
                    const input = event.target;
                    const previewGrid = document.getElementById('photoPreviewGrid');
                    const previewImg = document.getElementById('previewImageElement');
                    const fileNameSpan = document.getElementById('previewFileName');
                    const countLabel = document.getElementById('photoCountLabel');

                    if (input.files && input.files[0]) {
                        const file = input.files[0];
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            previewImg.src = e.target.result;
                            fileNameSpan.textContent = file.name;
                            previewGrid.classList.remove('hidden');
                            countLabel.textContent = '1 foto dipilih (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
                        };

                        reader.readAsDataURL(file);
                    }
                }

                function removeSelectedPhoto() {
                    const input = document.getElementById('fileInput');
                    input.value = '';
                    const previewGrid = document.getElementById('photoPreviewGrid');
                    previewGrid.classList.add('hidden');
                    document.getElementById('photoCountLabel').textContent = 'Maksimal 5MB (JPG/PNG/WEBP)';
                }
            </script>
        </main>
    </div>
</body>
</html>
