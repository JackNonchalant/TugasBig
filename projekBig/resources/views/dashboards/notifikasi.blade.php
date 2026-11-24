<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="web_dashboard" name="shell-type"/>
    <title>Pusat Aktivitas & Notifikasi - PojokBerbagi</title>

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
                <span class="material-symbols-outlined mr-3 text-xl">home</span>Beranda
            </a>
            @if(Auth::user()->role === 'donor')
                <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('donor.dashboard') }}">
                    <span class="material-symbols-outlined mr-3 text-xl">dashboard</span>Dashboard Donatur
                </a>
                <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('items.create') }}">
                    <span class="material-symbols-outlined mr-3 text-xl">add_box</span>Posting Donasi
                </a>
            @elseif(Auth::user()->role === 'beneficiary')
                <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('beneficiary.dashboard') }}">
                    <span class="material-symbols-outlined mr-3 text-xl">volunteer_activism</span>Katalog Donasi
                </a>
            @elseif(Auth::user()->role === 'admin')
                <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('admin.dashboard') }}">
                    <span class="material-symbols-outlined mr-3 text-xl">fact_check</span>Verifikasi Barang
                </a>
            @endif
            <a class="flex items-center px-3 py-2.5 rounded-lg font-label-lg text-label-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all" href="{{ route('permintaan.index') }}">
                <span class="material-symbols-outlined mr-3 text-xl">assignment</span>Permintaan & Posko
            </a>
            <a aria-current="page" class="flex items-center px-3 py-2.5 transition-all bg-primary-container text-on-primary-container font-bold rounded-lg shadow-sm" href="{{ route('notifikasi.index') }}">
                <span class="material-symbols-outlined mr-3 text-xl">notifications</span>Notifikasi
            </a>
        </nav>

        <div class="px-4 pt-4 border-t border-outline-variant/20">
            <div class="flex items-center gap-3 p-2 rounded-xl bg-surface-container mb-3">
                <div class="w-9 h-9 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold text-sm">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-on-surface truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-primary font-medium capitalize">{{ Auth::user()->role }}</p>
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
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                <span class="text-xs font-semibold text-on-surface-variant uppercase tracking-wider">PojokBerbagi • Notifikasi Terhubung</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('notifikasi.index') }}" class="p-2 rounded-full text-primary bg-primary-fixed/40 hover:bg-primary-fixed transition-colors">
                    <span class="material-symbols-outlined text-xl">notifications</span>
                </a>
            </div>
        </header>

        <main class="relative w-full px-8 pt-16 bg-surface">
            <div class="flex flex-col w-full py-space-xl max-w-5xl mx-auto">
                <!-- Header Section -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md mb-space-lg">
                    <div>
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary mb-1 block font-semibold">Pusat Aktivitas</span>
                        <h1 class="font-headline-md text-headline-md text-on-surface font-bold">Notifikasi</h1>
                    </div>
                    <button class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-surface-container-lowest text-primary font-label-lg text-label-lg shadow-sm hover:bg-surface-container-low transition-colors self-start md:self-auto border border-outline-variant/30 font-semibold" id="mark-all-read-btn" type="button">
                        <span class="material-symbols-outlined text-lg">done_all</span>
                        <span>Tandai semua telah dibaca</span>
                    </button>
                </div>

                <!-- Filter Pills & Summary Bar -->
                <div class="flex flex-wrap items-center justify-between gap-space-md mb-space-lg">
                    <div class="flex flex-wrap items-center gap-2" id="filter-pills">
                        <button class="filter-pill active px-4 py-2 rounded-full font-label-lg text-label-lg bg-primary-container text-on-primary transition-all font-semibold" data-filter="all" type="button">
                            Semua
                        </button>
                        <button class="filter-pill px-4 py-2 rounded-full font-label-lg text-label-lg bg-surface-container-low text-on-surface-variant hover:bg-surface-container-high transition-all" data-filter="unread" type="button">
                            Belum Dibaca (<span id="unread-count">3</span>)
                        </button>
                        <button class="filter-pill px-4 py-2 rounded-full font-label-lg text-label-lg bg-surface-container-low text-on-surface-variant hover:bg-surface-container-high transition-all" data-filter="verifikasi" type="button">
                            Verifikasi
                        </button>
                        <button class="filter-pill px-4 py-2 rounded-full font-label-lg text-label-lg bg-surface-container-low text-on-surface-variant hover:bg-surface-container-high transition-all" data-filter="penyaluran" type="button">
                            Penyaluran
                        </button>
                    </div>
                </div>

                <!-- Notification List -->
                <div class="flex flex-col gap-3" id="notification-list">
                    
                    @if($myDonations->count() > 0)
                        @foreach($myDonations as $item)
                            <!-- Dynamic Item from Database -->
                            <div class="notification-item unread group relative flex items-start gap-4 p-5 rounded-xl bg-surface-container-lowest shadow-sm hover:bg-surface-container-low transition-all cursor-pointer border border-outline-variant/20" data-category="verifikasi" data-unread="true">
                                <div class="relative flex-shrink-0 w-11 h-11 rounded-full {{ $item->status === 'tersedia' ? 'bg-emerald-100 text-emerald-800' : ($item->status === 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-primary-fixed text-on-primary-fixed-variant') }} flex items-center justify-center">
                                    <span class="material-symbols-outlined text-xl">{{ $item->status === 'tersedia' ? 'verified' : ($item->status === 'ditolak' ? 'cancel' : 'fact_check') }}</span>
                                    <span class="unread-dot absolute -top-0.5 -right-0.5 w-3 h-3 rounded-full bg-primary-container"></span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 mb-1">
                                        <h3 class="font-title-md text-title-md text-on-surface font-semibold truncate">
                                            Status Donasi: {{ $item->nama_barang }} — {{ $item->status }}
                                        </h3>
                                        <span class="font-label-md text-label-md text-on-surface-variant whitespace-nowrap">{{ $item->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="font-body-md text-body-md text-on-surface-variant">
                                        @if($item->status === 'tersedia')
                                            Barang donasi Anda telah lolos kurasi fisik di {{ $item->lokasi_posko }} dan telah tampil di Katalog Publik.
                                        @elseif($item->status === 'ditolak')
                                            Barang donasi Anda belum lolos kurasi posko transit. Catatan: {{ $item->alasan_penolakan ?? 'Kondisi belum sesuai standar.' }}
                                        @else
                                            Barang donasi Anda sedang menunggu verifikasi di {{ $item->lokasi_posko }}. Jadwal penyerahan: {{ $item->jadwal_penyerahan ? $item->jadwal_penyerahan->format('d M Y') : 'Segera' }}.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <!-- Item 1: Unread (Verifikasi / Permohonan) -->
                    <div class="notification-item unread group relative flex items-start gap-4 p-5 rounded-xl bg-surface-container-lowest shadow-sm hover:bg-surface-container-low transition-all cursor-pointer border border-outline-variant/20" data-category="verifikasi" data-unread="true">
                        <div class="relative flex-shrink-0 w-11 h-11 rounded-full bg-primary-fixed flex items-center justify-center text-on-primary-fixed-variant">
                            <span class="material-symbols-outlined text-xl">verified</span>
                            <span class="unread-dot absolute -top-0.5 -right-0.5 w-3 h-3 rounded-full bg-primary-container"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 mb-1">
                                <h3 class="font-title-md text-title-md text-on-surface font-semibold truncate">Permohonan Disetujui — REQ-2024-0891</h3>
                                <span class="font-label-md text-label-md text-on-surface-variant whitespace-nowrap">10 menit yang lalu</span>
                            </div>
                            <p class="font-body-md text-body-md text-on-surface-variant">Permintaan Buku Matematika Wajib Kelas 10 telah disetujui dan siap diambil di Posko Transit Pusat Bandung.</p>
                        </div>
                    </div>

                    <!-- Item 2: Unread (Verifikasi) -->
                    <div class="notification-item unread group relative flex items-start gap-4 p-5 rounded-xl bg-surface-container-lowest shadow-sm hover:bg-surface-container-low transition-all cursor-pointer border border-outline-variant/20" data-category="verifikasi" data-unread="true">
                        <div class="relative flex-shrink-0 w-11 h-11 rounded-full bg-primary-fixed flex items-center justify-center text-on-primary-fixed-variant">
                            <span class="material-symbols-outlined text-xl">fact_check</span>
                            <span class="unread-dot absolute -top-0.5 -right-0.5 w-3 h-3 rounded-full bg-primary-container"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 mb-1">
                                <h3 class="font-title-md text-title-md text-on-surface font-semibold truncate">Barang Terverifikasi — Paket Buku Cerita Edukasi</h3>
                                <span class="font-label-md text-label-md text-on-surface-variant whitespace-nowrap">2 jam yang lalu</span>
                            </div>
                            <p class="font-body-md text-body-md text-on-surface-variant">Donasi Anda telah lolos kurasi Posko Transit dan kini siap diakses oleh penerima manfaat.</p>
                        </div>
                    </div>

                    <!-- Item 3: Unread (Penyaluran - Urgent/Today) -->
                    <div class="notification-item unread group relative flex items-start gap-4 p-5 rounded-xl bg-surface-container-lowest shadow-sm hover:bg-surface-container-low transition-all cursor-pointer border border-outline-variant/20" data-category="penyaluran" data-unread="true">
                        <div class="relative flex-shrink-0 w-11 h-11 rounded-full bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed-variant">
                            <span class="material-symbols-outlined text-xl">event_available</span>
                            <span class="unread-dot absolute -top-0.5 -right-0.5 w-3 h-3 rounded-full bg-tertiary-container"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 mb-1">
                                <h3 class="font-title-md text-title-md text-on-surface font-semibold truncate">Jadwal Penyerahan Hari Ini</h3>
                                <span class="font-label-md text-label-md text-on-surface-variant whitespace-nowrap">3 jam yang lalu</span>
                            </div>
                            <p class="font-body-md text-body-md text-on-surface-variant">Pengambilan barang oleh Panti Asuhan Harapan Bangsa dijadwalkan pukul 10:00 WIB di Posko Transit.</p>
                        </div>
                    </div>

                    <!-- Item 4: Read (Penyaluran) -->
                    <div class="notification-item group relative flex items-start gap-4 p-5 rounded-xl bg-surface-container-low hover:bg-surface-container transition-all cursor-pointer border border-outline-variant/10" data-category="penyaluran" data-unread="false">
                        <div class="relative flex-shrink-0 w-11 h-11 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container">
                            <span class="material-symbols-outlined text-xl">volunteer_activism</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 mb-1">
                                <h3 class="font-title-md text-title-md text-on-surface-variant font-medium truncate">Barang Berhasil Disalurkan</h3>
                                <span class="font-label-md text-label-md text-outline whitespace-nowrap">Kemarin, 14:30</span>
                            </div>
                            <p class="font-body-md text-body-md text-on-surface-variant">Seragam Putih Merah SD telah diterima oleh penerima manfaat dengan dokumentasi lengkap.</p>
                        </div>
                    </div>

                    <!-- Item 5: Read (Sistem) -->
                    <div class="notification-item group relative flex items-start gap-4 p-5 rounded-xl bg-surface-container-low hover:bg-surface-container transition-all cursor-pointer border border-outline-variant/10" data-category="sistem" data-unread="false">
                        <div class="relative flex-shrink-0 w-11 h-11 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container">
                            <span class="material-symbols-outlined text-xl">info</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 mb-1">
                                <h3 class="font-title-md text-title-md text-on-surface-variant font-medium truncate">Pembaruan Sistem Posko Transit</h3>
                                <span class="font-label-md text-label-md text-outline whitespace-nowrap">2 hari yang lalu</span>
                            </div>
                            <p class="font-body-md text-body-md text-on-surface-variant">Posko Bandung dan sekitarnya kini melayani penerimaan serah terima setiap Senin–Sabtu.</p>
                        </div>
                    </div>
                </div>

                <!-- Empty State (Hidden by default) -->
                <div class="hidden flex-col items-center justify-center py-16 px-6 rounded-xl bg-surface-container-low text-center border border-outline-variant/20 mt-4" id="empty-state">
                    <div class="w-14 h-14 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant mb-4">
                        <span class="material-symbols-outlined text-3xl">notifications_off</span>
                    </div>
                    <h3 class="font-title-md text-title-md text-on-surface font-semibold mb-1">Tidak ada notifikasi</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant max-w-sm">Belum ada pembaruan untuk kategori ini saat ini.</p>
                </div>
            </div>
        </main>
    </div>

    <!-- Interactive Client Script -->
    <script>
        (function () {
            const filterPills = document.querySelectorAll('.filter-pill');
            const notificationItems = document.querySelectorAll('.notification-item');
            const markAllBtn = document.getElementById('mark-all-read-btn');
            const unreadCountEl = document.getElementById('unread-count');
            const emptyState = document.getElementById('empty-state');

            function updateUnreadCount() {
                const unreadItems = document.querySelectorAll('.notification-item[data-unread="true"]');
                if (unreadCountEl) unreadCountEl.textContent = unreadItems.length;
            }

            function applyFilter(filter) {
                let visibleCount = 0;
                notificationItems.forEach((item) => {
                    const category = item.getAttribute('data-category');
                    const isUnread = item.getAttribute('data-unread') === 'true';

                    let shouldShow = false;
                    if (filter === 'all') {
                        shouldShow = true;
                    } else if (filter === 'unread') {
                        shouldShow = isUnread;
                    } else {
                        shouldShow = category === filter;
                    }

                    if (shouldShow) {
                        item.classList.remove('hidden');
                        item.classList.add('flex');
                        visibleCount++;
                    } else {
                        item.classList.add('hidden');
                        item.classList.remove('flex');
                    }
                });

                if (emptyState) {
                    if (visibleCount === 0) {
                        emptyState.classList.remove('hidden');
                        emptyState.classList.add('flex');
                    } else {
                        emptyState.classList.add('hidden');
                        emptyState.classList.remove('flex');
                    }
                }
            }

            filterPills.forEach((pill) => {
                pill.addEventListener('click', () => {
                    filterPills.forEach((p) => {
                        p.classList.remove('active', 'bg-primary-container', 'text-on-primary', 'font-semibold');
                        p.classList.add('bg-surface-container-low', 'text-on-surface-variant');
                    });
                    pill.classList.add('active', 'bg-primary-container', 'text-on-primary', 'font-semibold');
                    pill.classList.remove('bg-surface-container-low', 'text-on-surface-variant');

                    applyFilter(pill.getAttribute('data-filter'));
                });
            });

            function markItemAsRead(item) {
                if (item.getAttribute('data-unread') === 'false') return;
                item.setAttribute('data-unread', 'false');
                item.classList.remove('unread', 'bg-surface-container-lowest', 'shadow-sm');
                item.classList.add('bg-surface-container-low');

                const dot = item.querySelector('.unread-dot');
                if (dot) dot.remove();

                const title = item.querySelector('h3');
                if (title) {
                    title.classList.remove('text-on-surface', 'font-semibold');
                    title.classList.add('text-on-surface-variant', 'font-medium');
                }

                updateUnreadCount();
                const activePill = document.querySelector('.filter-pill.active');
                if (activePill && activePill.getAttribute('data-filter') === 'unread') {
                    applyFilter('unread');
                }
            }

            notificationItems.forEach((item) => {
                item.addEventListener('click', () => markItemAsRead(item));
            });

            if (markAllBtn) {
                markAllBtn.addEventListener('click', () => {
                    notificationItems.forEach((item) => markItemAsRead(item));
                });
            }

            // Initialize count
            updateUnreadCount();
        })();
    </script>
</body>
</html>
