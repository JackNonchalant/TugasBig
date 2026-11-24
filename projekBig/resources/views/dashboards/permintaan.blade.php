<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="web_dashboard" name="shell-type"/>
    <title>Permintaan Saya &amp; Lacak Status - PojokBerbagi</title>
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

            <a aria-current="page" class="flex items-center px-3 py-2.5 transition-all bg-primary-container text-on-primary-container font-bold rounded-lg" href="{{ route('permintaan.index') }}">
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
                <span class="text-on-surface font-semibold">Permintaan Saya &amp; Lacak Status</span>
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
            <div class="flex flex-col w-full gap-space-xl pb-space-xl">
                <!-- Header & Summary Strip -->
                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-space-md pt-6">
                    <div class="flex flex-col gap-space-xs max-w-2xl">
                        <div class="flex items-center gap-space-sm">
                            <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary font-bold bg-primary-fixed text-on-primary-fixed px-2.5 py-1 rounded-full">Layanan Posko Transit</span>
                            <span class="font-label-md text-label-md text-on-surface-variant">• Pembaruan Real-time</span>
                        </div>
                        <h1 class="font-headline-md text-headline-md text-on-surface tracking-tight">Permintaan Saya &amp; Lacak Status Posko Transit</h1>
                        <p class="font-body-md text-body-md text-on-surface-variant">Pantau perkembangan serah terima barang pendidikan Anda dari tahap verifikasi posko transit hingga siap disalurkan.</p>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-3 gap-space-sm sm:gap-space-md shrink-0">
                        <div class="bg-surface-container-lowest rounded-xl px-4 py-3 shadow-sm border border-outline-variant/30 flex flex-col">
                            <span class="font-label-sm text-label-sm text-on-surface-variant">Total Terdata</span>
                            <span class="font-headline-sm text-headline-sm text-on-surface tabular-nums">{{ $totalPengajuan }}</span>
                        </div>
                        <div class="bg-tertiary-fixed/40 rounded-xl px-4 py-3 shadow-sm border border-tertiary-fixed-dim/30 flex flex-col">
                            <span class="font-label-sm text-label-sm text-on-tertiary-fixed-variant">Verifikasi Posko</span>
                            <span class="font-headline-sm text-headline-sm text-on-tertiary-fixed tabular-nums">{{ $totalDalamProses }}</span>
                        </div>
                        <div class="bg-primary-fixed/50 rounded-xl px-4 py-3 shadow-sm border border-primary-fixed-dim/30 flex flex-col">
                            <span class="font-label-sm text-label-sm text-on-primary-fixed-variant">Siap di Katalog</span>
                            <span class="font-headline-sm text-headline-sm text-on-primary-fixed tabular-nums">{{ $totalSelesai }}</span>
                        </div>
                    </div>
                </div>

                <!-- Top Section: Daftar Permintaan Saya -->
                <section class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
                    <div class="px-6 py-5 bg-surface-container-low/60 flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm border-b border-outline-variant/20">
                        <div class="flex items-center gap-space-sm">
                            <span class="material-symbols-outlined text-primary-container text-2xl">assignment</span>
                            <h2 class="font-title-md text-title-md text-on-surface font-semibold">Daftar Status Posko Transit</h2>
                        </div>
                        <div class="flex items-center gap-space-sm">
                            <span class="font-label-md text-label-md text-on-surface-variant">Menampilkan data pencatatan serah terima posko</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low/40 border-b border-outline-variant/20">
                                    <th class="py-3.5 px-6 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Kode Referensi</th>
                                    <th class="py-3.5 px-6 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Nama Barang</th>
                                    <th class="py-3.5 px-6 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Jumlah</th>
                                    <th class="py-3.5 px-6 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Tanggal Tercatat</th>
                                    <th class="py-3.5 px-6 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Status Posko</th>
                                    <th class="py-3.5 px-6 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="request-table-body" class="divide-y divide-outline-variant/20">
                                @forelse ($items as $index => $item)
                                    @php
                                        $reqCode = 'REQ-' . date('Y') . '-' . str_pad($item->id, 4, '0', STR_PAD_LEFT);
                                        $isSelected = $index === 0;
                                    @endphp
                                    <tr class="{{ $isSelected ? 'bg-primary-fixed/20' : 'bg-surface-container-lowest' }} transition-colors cursor-pointer hover:bg-primary-fixed/30" data-req="{{ $reqCode }}" onclick="selectRequestItem('{{ $reqCode }}', '{{ addslashes($item->nama_barang) }}', '{{ addslashes($item->status) }}', '{{ addslashes($item->lokasi_posko ?? 'Posko Transit Pusat, Bandung') }}', '{{ $item->jadwal_penyerahan ? $item->jadwal_penyerahan->format('d M Y') : date('d M Y') }}', 'PB-PSK-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}')">
                                        <td class="py-4 px-6 font-label-lg text-label-lg text-primary font-semibold tabular-nums">{{ $reqCode }}</td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                @if ($item->foto)
                                                    <img alt="{{ $item->nama_barang }}" class="w-10 h-10 rounded-lg object-cover shrink-0 shadow-sm border border-outline-variant/30" src="{{ $item->foto_url }}"/>
                                                @else
                                                    <div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary-container shrink-0 border border-outline-variant/30">
                                                        <span class="material-symbols-outlined text-lg">menu_book</span>
                                                    </div>
                                                @endif
                                                <div class="min-w-0">
                                                    <p class="font-label-lg text-label-lg text-on-surface truncate font-medium">{{ $item->nama_barang }}</p>
                                                    <p class="font-body-sm text-body-sm text-on-surface-variant truncate">{{ $item->kategori }} • Kondisi: {{ $item->kondisi }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 font-body-md text-body-md text-on-surface tabular-nums">{{ $item->jumlah }} Unit</td>
                                        <td class="py-4 px-6 font-body-md text-body-md text-on-surface-variant tabular-nums">{{ $item->created_at->format('d M Y') }}</td>
                                        <td class="py-4 px-6">
                                            @if ($item->status === 'Menunggu Verifikasi Transit')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed-variant font-label-md text-label-md">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-tertiary animate-pulse"></span>
                                                    Menunggu Verifikasi Transit
                                                </span>
                                            @elseif ($item->status === 'tersedia')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed font-label-md text-label-md">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-primary-container"></span>
                                                    Tersedia di Katalog
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-md text-label-md">
                                                    {{ $item->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <a href="{{ route('items.show', $item->id) }}" class="inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md hover:bg-primary transition-colors">
                                                <span>Detail</span>
                                                <span class="material-symbols-outlined text-base">arrow_forward</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-12 text-center text-on-surface-variant">
                                            Belum ada permohonan atau postingan barang yang tercatat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Bottom/Expanded Detail Card for Selected Request -->
                @php
                    $firstItem = $items->first();
                @endphp
                <section class="bg-surface-container-lowest rounded-xl shadow-md border border-outline-variant/30 overflow-hidden" id="detail-card">
                    <!-- Detail Header -->
                    <div class="px-6 py-5 bg-primary text-on-primary flex flex-col md:flex-row md:items-center justify-between gap-space-md">
                        <div class="flex items-center gap-space-md">
                            <div class="w-12 h-12 rounded-xl bg-on-primary/15 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-2xl text-on-primary">local_shipping</span>
                            </div>
                            <div>
                                <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary-fixed">Detail Pelacakan Alur Transit</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-primary" id="detail-title">
                                    {{ $firstItem ? 'REQ-' . date('Y') . '-' . str_pad($firstItem->id, 4, '0', STR_PAD_LEFT) . ' — ' . $firstItem->nama_barang : 'REQ-2025-0001 — Buku Pendidikan' }}
                                </h3>
                            </div>
                        </div>
                        <div class="flex items-center gap-space-sm">
                            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-md text-label-md" id="detail-status-badge">
                                <span class="w-2 h-2 rounded-full bg-tertiary animate-pulse"></span>
                                <span id="detail-status-text">{{ $firstItem ? $firstItem->status : 'Menunggu Verifikasi Transit' }}</span>
                            </span>
                        </div>
                    </div>

                    <div class="p-6 lg:p-8 flex flex-col gap-space-xl">
                        <!-- Horizontal 4-Step Progress Timeline -->
                        <div class="flex flex-col gap-space-md">
                            <div class="flex items-center justify-between">
                                <span class="font-label-lg text-label-lg text-on-surface font-bold">Progres Verifikasi &amp; Penyaluran</span>
                                <span class="font-label-md text-label-md text-primary font-semibold" id="timeline-step-text">Tahap 2 dari 4</span>
                            </div>

                            <div class="relative grid grid-cols-1 md:grid-cols-4 gap-space-md pt-2">
                                <!-- Step 1: Completed -->
                                <div class="relative flex md:flex-col items-start md:items-center gap-space-md md:gap-space-sm bg-primary-fixed/25 rounded-xl p-4 border border-primary-fixed-dim/40">
                                    <div class="w-10 h-10 rounded-full bg-primary text-on-primary flex items-center justify-center shrink-0 shadow-sm">
                                        <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">check</span>
                                    </div>
                                    <div class="md:text-center">
                                        <span class="font-label-sm text-label-sm text-primary uppercase tracking-wider font-bold">Tahap 1 • Selesai</span>
                                        <p class="font-label-lg text-label-lg text-on-surface mt-0.5 font-semibold">Postingan Dibuat</p>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant tabular-nums">Donatur Memilih Posko</p>
                                    </div>
                                </div>

                                <!-- Step 2: Active -->
                                <div class="relative flex md:flex-col items-start md:items-center gap-space-md md:gap-space-sm bg-tertiary-fixed/45 rounded-xl p-4 shadow-sm border border-tertiary-fixed-dim/40">
                                    <div class="w-10 h-10 rounded-full bg-tertiary text-on-tertiary flex items-center justify-center shrink-0 shadow-sm">
                                        <span class="material-symbols-outlined text-xl">hourglass_top</span>
                                    </div>
                                    <div class="md:text-center">
                                        <span class="font-label-sm text-label-sm text-on-tertiary-fixed-variant uppercase tracking-wider font-bold">Tahap 2 • Berlangsung</span>
                                        <p class="font-label-lg text-label-lg text-on-tertiary-fixed mt-0.5 font-semibold">Verifikasi Posko Transit</p>
                                        <p class="font-body-sm text-body-sm text-on-tertiary-fixed-variant">Cek Fisik &amp; Kelayakan</p>
                                    </div>
                                </div>

                                <!-- Step 3: Upcoming -->
                                <div class="relative flex md:flex-col items-start md:items-center gap-space-md md:gap-space-sm bg-surface-container-low rounded-xl p-4 opacity-80 border border-outline-variant/30">
                                    <div class="w-10 h-10 rounded-full bg-surface-container-highest text-on-surface-variant flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-xl">menu_book</span>
                                    </div>
                                    <div class="md:text-center">
                                        <span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Tahap 3 • Katalog</span>
                                        <p class="font-label-lg text-label-lg text-on-surface mt-0.5 font-semibold">Tayang di Katalog</p>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant">Siap Diajukan Penerima</p>
                                    </div>
                                </div>

                                <!-- Step 4: Upcoming -->
                                <div class="relative flex md:flex-col items-start md:items-center gap-space-md md:gap-space-sm bg-surface-container-low rounded-xl p-4 opacity-75 border border-outline-variant/30">
                                    <div class="w-10 h-10 rounded-full bg-surface-container-highest text-on-surface-variant flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-xl">volunteer_activism</span>
                                    </div>
                                    <div class="md:text-center">
                                        <span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Tahap 4 • Serah Terima</span>
                                        <p class="font-label-lg text-label-lg text-on-surface mt-0.5 font-semibold">Barang Diserahkan</p>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant">Penerima Mengambil Barang</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Posko Pickup / Delivery Info & Map -->
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg items-stretch">
                            <!-- Left: Posko Info Card -->
                            <div class="lg:col-span-7 bg-surface-container-low rounded-xl p-6 flex flex-col justify-between gap-space-lg border border-outline-variant/30">
                                <div class="flex flex-col gap-space-md">
                                    <div class="flex items-center gap-space-sm">
                                        <span class="material-symbols-outlined text-primary-container text-2xl">storefront</span>
                                        <h4 class="font-title-md text-title-md text-on-surface font-semibold">Informasi Posko Transit Terkait</h4>
                                    </div>
                                    <div class="bg-surface-container-lowest rounded-xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-space-md shadow-sm border border-outline-variant/20">
                                        <div class="flex items-start gap-space-sm">
                                            <span class="material-symbols-outlined text-primary-container mt-0.5">location_on</span>
                                            <div>
                                                <p class="font-label-lg text-label-lg text-on-surface font-semibold" id="detail-posko-nama">
                                                    {{ $firstItem ? ($firstItem->lokasi_posko ?? 'Posko Transit Pusat, Bandung') : 'Posko Transit Pusat' }}
                                                </p>
                                                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1" id="detail-posko-jadwal">
                                                    Jadwal Penyerahan / Buka: {{ $firstItem && $firstItem->jadwal_penyerahan ? $firstItem->jadwal_penyerahan->format('d M Y') : 'Senin - Sabtu (09:00 - 17:00 WIB)' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
                                        <div class="bg-surface-container-lowest rounded-xl p-4 border border-outline-variant/20 shadow-sm">
                                            <span class="font-label-sm text-label-sm text-on-surface-variant uppercase font-semibold">Penanggung Jawab Posko</span>
                                            <p class="font-label-lg text-label-lg text-on-surface mt-1 font-medium">Relawan PojokBerbagi</p>
                                            <p class="font-body-sm text-body-sm text-primary mt-0.5">+62 812-3456-7890</p>
                                        </div>
                                        <div class="bg-surface-container-lowest rounded-xl p-4 border border-outline-variant/20 shadow-sm">
                                            <span class="font-label-sm text-label-sm text-on-surface-variant uppercase font-semibold">Kode Posko / Pengambilan</span>
                                            <p class="font-headline-sm text-headline-sm text-primary tabular-nums mt-1 font-bold" id="detail-kode-pengambilan">
                                                PB-PSK-{{ $firstItem ? str_pad($firstItem->id, 3, '0', STR_PAD_LEFT) : '001' }}
                                            </p>
                                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Tunjukkan kode ini kepada relawan</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-wrap items-center gap-space-sm pt-2">
                                    <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-lg text-label-lg hover:bg-primary transition-colors cursor-pointer" onclick="alert('Kode QR Verifikasi: PB-PSK-001\nTunjukkan ke petugas Posko Transit saat penyerahan barang.')" type="button">
                                        <span class="material-symbols-outlined text-lg">qr_code_2</span>
                                        <span>Tampilkan QR Pengambilan</span>
                                    </button>
                                    <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-surface-container-lowest text-on-surface font-label-lg text-label-lg hover:bg-surface-container-high transition-colors shadow-sm border border-outline-variant/30">
                                        <span class="material-symbols-outlined text-lg">chat</span>
                                        <span>Hubungi Posko</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Right: Location Visual / Posko Map -->
                            <div class="lg:col-span-5 flex flex-col gap-space-sm">
                                <div class="w-full h-64 lg:h-full min-h-[240px] bg-cover bg-center rounded-xl shadow-sm border border-outline-variant/30 relative overflow-hidden" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBAq7Tt7ZUreyk9MF0ruaVbIOObMhL2YCk_RBL8hQ-rCYmiLH5flOuT0b95UxsLERD9PySvFg4RPzBW_MsyqHxwPV47i_l_dmd8M0FfgN82Flu15EfTGeLIlDTnTAMrj6hPRgf5fK-OXdZjs-ZLSveQE0HkR-kOwb2vvrcUi81bVO50CTQddBeHlCEHlBUWeToFKse-lgLeKh1umXw7MEVlOd79OykKJHUDUDpJ7cRV')">
                                    <div class="absolute inset-0 bg-gradient-to-t from-on-surface/60 via-transparent to-transparent flex items-end p-5">
                                        <div class="text-white">
                                            <p class="font-title-md font-bold text-white flex items-center gap-1.5">
                                                <span class="material-symbols-outlined text-lg text-primary-fixed">verified</span>
                                                Posko Transit Resmi PojokBerbagi
                                            </p>
                                            <p class="text-xs text-white/90">Buka Senin - Sabtu pukul 09:00 - 17:00 WIB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <script>
                function selectRequestItem(reqId, namaBarang, status, posko, jadwal, kode) {
                    const rows = document.querySelectorAll('#request-table-body tr');
                    rows.forEach(row => {
                        if (row.getAttribute('data-req') === reqId) {
                            row.classList.remove('bg-surface-container-lowest');
                            row.classList.add('bg-primary-fixed/20');
                        } else {
                            row.classList.remove('bg-primary-fixed/20');
                            row.classList.add('bg-surface-container-lowest');
                        }
                    });

                    document.getElementById('detail-title').textContent = `${reqId} — ${namaBarang}`;
                    document.getElementById('detail-status-text').textContent = status;
                    document.getElementById('detail-posko-nama').textContent = posko;
                    document.getElementById('detail-posko-jadwal').textContent = `Jadwal Penyerahan / Buka: ${jadwal}`;
                    document.getElementById('detail-kode-pengambilan').textContent = kode;

                    document.getElementById('detail-card').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            </script>
        </main>
    </div>
</body>
</html>
