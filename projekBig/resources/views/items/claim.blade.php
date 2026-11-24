<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="web_dashboard" name="shell-type"/>
    <title>Ajukan Permintaan Barang - {{ $item->nama_barang }} - PojokBerbagi</title>
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
            @auth
                @if(auth()->user()->isDonor())
                    <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('donor.dashboard') }}">
                        <span class="material-symbols-outlined mr-3 text-xl">dashboard</span>
                        Dashboard Donatur
                    </a>
                    <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('items.create') }}">
                        <span class="material-symbols-outlined mr-3 text-xl">add_box</span>
                        Posting Donasi
                    </a>
                @elseif(auth()->user()->isAdmin())
                    <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('admin.dashboard') }}">
                        <span class="material-symbols-outlined mr-3 text-xl">admin_panel_settings</span>
                        Dashboard Admin
                    </a>
                @else
                    <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('beneficiary.dashboard') }}">
                        <span class="material-symbols-outlined mr-3 text-xl">volunteer_activism</span>
                        Dashboard Penerima
                    </a>
                @endif
            @endauth

            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('permintaan.index') }}">
                <span class="material-symbols-outlined mr-3 text-xl">assignment</span>
                Permintaan Saya
            </a>
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('katalog.index') }}">
                <span class="material-symbols-outlined mr-3 text-xl">menu_book</span>
                Katalog Donasi
            </a>
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('home') }}">
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
                    <p class="text-xs text-on-surface-variant capitalize">{{ auth()->user()->role }}</p>
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
                <a href="{{ route('items.show', $item->id) }}" class="hover:text-primary transition-colors truncate max-w-xs">{{ $item->nama_barang }}</a>
                <span>/</span>
                <span class="text-on-surface font-semibold">Ajukan Permintaan</span>
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
            <div class="flex flex-col w-full pb-16">
                <div class="max-w-6xl w-full mx-auto py-6">
                    <!-- Breadcrumb & Overline -->
                    <div class="flex items-center gap-2 font-label-md text-label-md text-on-surface-variant mb-3">
                        <a class="hover:text-primary transition-colors" href="{{ route('beneficiary.dashboard') }}">Dashboard Penerima</a>
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                        <a class="hover:text-primary transition-colors" href="{{ route('katalog.index') }}">Katalog Barang</a>
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                        <span class="text-primary font-semibold">Ajukan Permintaan</span>
                    </div>

                    <!-- Page Title -->
                    <div class="mb-8">
                        <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Formulir Pengajuan Permintaan Barang</h1>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-2 max-w-2xl">
                            Lengkapi data kebutuhan dan dokumen pendukung untuk mengajukan klaim barang donasi pendidikan.
                        </p>
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

                    <!-- Two-Column Asymmetric Layout (7/5 Split) -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                        <!-- Left Column: Form (7 cols) -->
                        <div class="lg:col-span-7 bg-surface-container-lowest rounded-xl p-6 sm:p-8 shadow-sm border border-outline-variant/30">
                            <form action="{{ route('items.claim.submit', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="claimForm">
                                @csrf

                                <!-- Nama Barang (Read-only) -->
                                <div>
                                    <label class="block font-label-lg text-label-lg text-on-surface mb-2" for="namaBarang">
                                        Nama Barang
                                    </label>
                                    <div class="relative flex items-center">
                                        <span class="material-symbols-outlined absolute left-3.5 text-primary text-xl">menu_book</span>
                                        <input class="w-full bg-surface-container-low text-on-surface font-body-md text-body-md rounded-lg pl-11 pr-4 py-3 cursor-not-allowed focus:outline-none border border-outline-variant/30" id="namaBarang" readonly="" type="text" value="{{ $item->nama_barang }}"/>
                                        <span class="material-symbols-outlined absolute right-3.5 text-on-surface-variant text-lg" title="Terkunci sesuai pilihan">lock</span>
                                    </div>
                                </div>

                                <!-- Jumlah yang Dibutuhkan -->
                                <div>
                                    <label class="block font-label-lg text-label-lg text-on-surface mb-2" for="jumlahDibutuhkan">
                                        Jumlah yang Dibutuhkan <span class="text-error">*</span>
                                    </label>
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center bg-surface-container-low rounded-lg p-1 w-40 justify-between border border-outline-variant/30">
                                            <button aria-label="Kurangi jumlah" class="w-9 h-9 rounded-md bg-surface-container-lowest text-on-surface hover:bg-surface-container-high flex items-center justify-center transition-colors shadow-sm cursor-pointer" id="btnMinus" type="button">
                                                <span class="material-symbols-outlined text-lg">remove</span>
                                            </button>
                                            <input class="w-14 text-center bg-transparent font-title-md text-title-md text-on-surface focus:outline-none [appearance:textfield] [&amp;::-webkit-outer-spin-button]:appearance-none [&amp;::-webkit-inner-spin-button]:appearance-none" id="jumlahDibutuhkan" max="{{ max(1, $item->jumlah) }}" min="1" name="jumlah" required="" type="number" value="{{ old('jumlah', 1) }}"/>
                                            <button aria-label="Tambah jumlah" class="w-9 h-9 rounded-md bg-surface-container-lowest text-on-surface hover:bg-surface-container-high flex items-center justify-center transition-colors shadow-sm cursor-pointer" id="btnPlus" type="button">
                                                <span class="material-symbols-outlined text-lg">add</span>
                                            </button>
                                        </div>
                                        <span class="font-body-sm text-body-sm text-on-surface-variant">Unit / Eksemplar</span>
                                    </div>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-2 flex items-center gap-1.5" id="jumlahHelper">
                                        <span class="material-symbols-outlined text-base text-primary">info</span>
                                        Maksimal {{ $item->jumlah }} unit tersedia
                                    </p>
                                </div>

                                <!-- Alasan Kebutuhan -->
                                <div>
                                    <label class="block font-label-lg text-label-lg text-on-surface mb-2" for="alasanKebutuhan">
                                        Alasan Kebutuhan <span class="text-error">*</span>
                                    </label>
                                    <textarea class="w-full bg-surface-container-low text-on-surface font-body-md text-body-md rounded-lg px-4 py-3 focus:outline-none focus:bg-surface-container transition-colors resize-none border border-outline-variant/30" id="alasanKebutuhan" name="alasan_kebutuhan" placeholder="Jelaskan secara singkat peruntukan barang ini untuk mendukung kegiatan belajar..." required="" rows="3">{{ old('alasan_kebutuhan') }}</textarea>
                                </div>

                                <!-- Upload Dokumen Persyaratan -->
                                <div>
                                    <label class="block font-label-lg text-label-lg text-on-surface mb-2">
                                        Upload Dokumen Persyaratan <span class="text-on-surface-variant text-xs font-normal">(SKTM / Surat Sekolah / Surat Panti)</span>
                                    </label>
                                    <div class="bg-surface-container-low hover:bg-surface-container transition-colors rounded-xl p-6 text-center cursor-pointer border border-dashed border-outline-variant/60 hover:border-primary" id="dropzone" onclick="document.getElementById('fileInput').click()">
                                        <input accept=".pdf,.jpg,.jpeg,.png" class="hidden" id="fileInput" name="dokumen" type="file" onchange="handleFileChange(event)"/>
                                        <div class="w-12 h-12 rounded-full bg-primary-fixed text-on-primary-fixed flex items-center justify-center mx-auto mb-3">
                                            <span class="material-symbols-outlined text-2xl">upload_file</span>
                                        </div>
                                        <p class="font-body-md text-body-md text-on-surface font-medium">
                                            Unggah Dokumen Pendukung (PDF/JPG/PNG, maks. 5MB)
                                        </p>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
                                            Seret dan lepas file di sini, atau <span class="text-primary font-semibold underline">pilih dari perangkat</span>
                                        </p>
                                    </div>
                                    <!-- Uploaded File Chip -->
                                    <div class="mt-3 hidden" id="fileChipContainer">
                                        <div class="inline-flex items-center gap-2.5 bg-primary-fixed/60 text-on-primary-fixed px-3.5 py-2 rounded-lg">
                                            <span class="material-symbols-outlined text-lg text-primary">description</span>
                                            <span class="font-label-lg text-label-lg font-medium" id="fileNameText">-</span>
                                            <button aria-label="Hapus file" class="ml-1 text-on-primary-fixed-variant hover:text-error transition-colors flex items-center cursor-pointer" onclick="clearFile()" type="button">
                                                <span class="material-symbols-outlined text-lg">close</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Catatan Tambahan -->
                                <div>
                                    <label class="block font-label-lg text-label-lg text-on-surface mb-2" for="catatanTambahan">
                                        Catatan Tambahan <span class="font-body-sm text-body-sm text-on-surface-variant font-normal">(Opsional)</span>
                                    </label>
                                    <textarea class="w-full bg-surface-container-low text-on-surface font-body-md text-body-md rounded-lg px-4 py-3 focus:outline-none focus:bg-surface-container transition-colors resize-none border border-outline-variant/30" id="catatanTambahan" name="catatan_tambahan" placeholder="Contoh: Jadwal pengambilan yang diharapkan atau kontak perwakilan..." rows="2">{{ old('catatan_tambahan') }}</textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="pt-2 flex items-center justify-end gap-4 border-t border-outline-variant/20">
                                    <a class="px-5 py-3 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high transition-colors" href="{{ route('items.show', $item->id) }}">
                                        Batal
                                    </a>
                                    <button class="bg-primary-container hover:bg-primary text-on-primary font-label-lg text-label-lg px-6 py-3 rounded-lg shadow-sm transition-all flex items-center gap-2 cursor-pointer" id="submitBtn" type="submit">
                                        <span class="material-symbols-outlined text-xl">send</span>
                                        <span>Kirim Permintaan</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Right Column: Selected Item Summary Card (5 cols) -->
                        <div class="lg:col-span-5 lg:sticky lg:top-24 space-y-6">
                            <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-outline-variant/30">
                                <!-- Thumbnail Photo -->
                                <div class="relative h-52 w-full bg-surface-container">
                                    @if ($item->foto)
                                        <img class="w-full h-full object-cover" src="{{ $item->foto_url }}" alt="{{ $item->nama_barang }}"/>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-primary-container">
                                            <span class="material-symbols-outlined text-5xl">menu_book</span>
                                        </div>
                                    @endif
                                    <div class="absolute top-3 left-3 bg-surface-container-lowest/90 backdrop-blur-sm text-primary px-3 py-1 rounded-full font-label-sm text-label-sm flex items-center gap-1.5 shadow-sm font-semibold">
                                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">verified</span>
                                        <span>Terverifikasi Posko</span>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="p-6 space-y-5">
                                    <div>
                                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-bold">Ringkasan Barang Pilihan</span>
                                        <h2 class="font-headline-sm text-headline-sm text-on-surface mt-1">
                                            {{ $item->nama_barang }}
                                        </h2>
                                    </div>

                                    <!-- Metadata List -->
                                    <div class="space-y-3 bg-surface-container-low rounded-xl p-4 border border-outline-variant/20">
                                        <div class="flex items-start gap-3">
                                            <span class="material-symbols-outlined text-primary text-xl mt-0.5">location_on</span>
                                            <div>
                                                <p class="font-label-md text-label-md text-on-surface-variant">Lokasi Posko</p>
                                                <p class="font-body-md text-body-md text-on-surface font-medium">{{ $item->lokasi_posko ?? 'Posko Transit Pusat, Bandung' }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-3">
                                            <span class="material-symbols-outlined text-primary text-xl mt-0.5">inventory_2</span>
                                            <div>
                                                <p class="font-label-md text-label-md text-on-surface-variant">Stok Tersedia</p>
                                                <p class="font-body-md text-body-md text-on-surface font-medium tabular-nums">{{ $item->jumlah }} Unit / Eksemplar</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-3">
                                            <span class="material-symbols-outlined text-primary text-xl mt-0.5">category</span>
                                            <div>
                                                <p class="font-label-md text-label-md text-on-surface-variant">Kategori &amp; Kondisi</p>
                                                <p class="font-body-md text-body-md text-on-surface font-medium">{{ $item->kategori }} • {{ $item->kondisi }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Info Note -->
                                    <div class="bg-tertiary-fixed/50 text-on-tertiary-fixed-variant rounded-xl p-4 flex items-start gap-3 border border-tertiary-fixed-dim/30">
                                        <span class="material-symbols-outlined text-xl shrink-0 mt-0.5">schedule</span>
                                        <p class="font-body-sm text-body-sm leading-relaxed">
                                            Setelah dikirim, permohonan akan mendapatkan nomor registrasi unik dan berstatus <strong class="font-semibold">'Menunggu Verifikasi Permohonan'</strong>.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Confirmation Modal -->
                <div class="fixed inset-0 z-50 hidden items-center justify-center bg-on-surface/40 backdrop-blur-sm p-4" id="successModal">
                    <div class="bg-surface-container-lowest rounded-xl max-w-md w-full p-6 sm:p-8 shadow-xl text-center space-y-5 border border-outline-variant/30">
                        <div class="w-14 h-14 rounded-full bg-primary-fixed text-primary flex items-center justify-center mx-auto">
                            <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        </div>
                        <div>
                            <h3 class="font-headline-sm text-headline-sm text-on-surface">Permintaan Berhasil Dikirim!</h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-2">
                                Permohonan Anda untuk <span class="font-semibold text-on-surface" id="modalQty">1</span> unit {{ $item->nama_barang }} telah tercatat di posko transit.
                            </p>
                        </div>
                        <div class="bg-surface-container-low rounded-xl p-4 space-y-2 text-left border border-outline-variant/20">
                            <div class="flex justify-between items-center">
                                <span class="font-label-md text-label-md text-on-surface-variant">Nomor Registrasi</span>
                                <span class="font-label-lg text-label-lg font-bold text-primary tabular-nums">REQ-{{ date('Y') }}-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-label-md text-label-md text-on-surface-variant">Status</span>
                                <span class="bg-tertiary-fixed text-on-tertiary-fixed-variant font-label-sm text-label-sm px-2.5 py-1 rounded-full font-semibold">Menunggu Verifikasi Permohonan</span>
                            </div>
                        </div>
                        <a href="{{ route('permintaan.index') }}" class="w-full inline-block bg-primary-container hover:bg-primary text-on-primary font-label-lg text-label-lg py-3 rounded-lg transition-colors text-center" id="closeModalBtn">
                            Lihat Permintaan Saya
                        </a>
                    </div>
                </div>
            </div>

            <script>
                const maxQty = {{ max(1, $item->jumlah) }};
                const qtyInput = document.getElementById('jumlahDibutuhkan');
                const btnMinus = document.getElementById('btnMinus');
                const btnPlus = document.getElementById('btnPlus');

                if (btnMinus && qtyInput) {
                    btnMinus.addEventListener('click', () => {
                        let val = parseInt(qtyInput.value, 10) || 1;
                        if (val > 1) qtyInput.value = val - 1;
                    });
                }

                if (btnPlus && qtyInput) {
                    btnPlus.addEventListener('click', () => {
                        let val = parseInt(qtyInput.value, 10) || 1;
                        if (val < maxQty) qtyInput.value = val + 1;
                    });
                }

                function handleFileChange(e) {
                    const file = e.target.files[0];
                    if (file) {
                        document.getElementById('fileNameText').textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
                        document.getElementById('fileChipContainer').classList.remove('hidden');
                    }
                }

                function clearFile() {
                    const input = document.getElementById('fileInput');
                    input.value = '';
                    document.getElementById('fileChipContainer').classList.add('hidden');
                }
            </script>
        </main>
    </div>
</body>
</html>
