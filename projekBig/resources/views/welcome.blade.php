@php
    // ── CTA mengikuti status login ─────────────────────────────────────
    $katalog = route('katalog.index');
    $user    = auth()->user();

    $cta = match (true) {
        ! $user               => [['Mulai berbagi', route('register')],            ['Lihat katalog kebutuhan', $katalog]],
        $user->isAdmin()      => [['Buka Panel Admin', route('admin.dashboard')],  ['Lihat katalog kebutuhan', $katalog]],
        $user->isDonor()      => [['Donasikan barang', route('items.create')],     ['Lihat katalog kebutuhan', $katalog]],
        default               => [['Lihat katalog kebutuhan', $katalog],           ['Dashboard saya', route('beneficiary.dashboard')]],
    };

    $dashboardUrl = match (true) {
        ! $user          => null,
        $user->isAdmin() => route('admin.dashboard'),
        $user->isDonor() => route('donor.dashboard'),
        default          => route('beneficiary.dashboard'),
    };

    // ── Kartu status distribusi (data nyata, fallback contoh) ──────────
    $stepMap  = ['Menunggu Penyaluran' => 1, 'Dalam Proses Penyaluran' => 2, 'Disalurkan' => 3];
    $isSample = ! $latestDistribution || ! $latestDistribution->donationItem;

    if ($isSample) {
        $live = [
            'nama'   => 'Paket buku tematik SD kelas 4–6',
            'meta'   => 'Buku Pelajaran · 12 unit',
            'step'   => 2,
            'waktu'  => 'contoh alur',
        ];
    } else {
        $it   = $latestDistribution->donationItem;
        $live = [
            'nama'   => $it->nama_barang,
            'meta'   => $it->kategori . ' · ' . $it->jumlah . ' unit',
            'step'   => $stepMap[$latestDistribution->status] ?? 1,
            'waktu'  => $latestDistribution->updated_at->diffForHumans(),
        ];
    }
    $stepLabels = ['Menunggu', 'Diproses', 'Disalurkan'];

    // ── Foto editorial (Unsplash, hotlink — ganti dengan dokumentasi asli) ─
    $img = fn (string $id, int $w = 900) => "https://images.unsplash.com/photo-{$id}?auto=format&fit=crop&w={$w}&q=75";

    $metricList = [
        ['n' => $metrics['units_total'],     'label' => 'Unit barang tercatat',   'note' => 'buku, seragam, alat tulis, dan perlengkapan lain'],
        ['n' => $metrics['units_delivered'], 'label' => 'Unit sudah disalurkan',  'note' => 'dengan bukti serah terima'],
        ['n' => $metrics['donors'],          'label' => 'Donatur terdaftar',      'note' => 'akun donatur di platform'],
        ['n' => $metrics['beneficiaries'],   'label' => 'Penerima manfaat',       'note' => 'akun penerima terverifikasi'],
    ];
@endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#FAF9F6">
    <meta name="description" content="PojokBerbagi menghubungkan donatur dengan siswa yang membutuhkan buku, seragam, dan alat tulis layak pakai — diperiksa Tim Posko Transit, disalurkan dengan bukti serah terima.">
    <title>PojokBerbagi — Dari rak bukumu, ke meja belajar anak lain</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700|instrument-serif:400,400i&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        :root { --ease: cubic-bezier(0.16, 1, 0.3, 1); }
        body  { font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; }
        .font-display { font-family: 'Instrument Serif', ui-serif, Georgia, serif; font-weight: 400; }

        /* Grain halus agar kertas terasa organik */
        .grain {
            position: fixed; inset: 0; z-index: 60; pointer-events: none;
            opacity: .06; mix-blend-mode: multiply;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='180' height='180'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='3' stitchTiles='stitch'/%3E%3CfeColorMatrix values='0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 .55 0'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
        }

        /* Entrance bertahap (load) */
        @keyframes rise { from { opacity: 0; transform: translateY(26px); } to { opacity: 1; transform: none; } }
        @keyframes rise-line { from { transform: translateY(112%); } to { transform: none; } }
        .rise       { opacity: 0; animation: rise 1s var(--ease) forwards; animation-delay: var(--d, 0ms); }
        .line       { display: block; overflow: hidden; padding-bottom: .14em; margin-bottom: -.14em; }
        .line-inner { display: block; transform: translateY(112%); animation: rise-line 1.1s var(--ease) forwards; animation-delay: var(--d, 0ms); }

        /* Scroll reveal */
        .reveal    { opacity: 0; transform: translateY(30px); transition: opacity .9s var(--ease), transform .9s var(--ease); transition-delay: var(--d, 0ms); }
        .reveal.in { opacity: 1; transform: none; }

        /* Strip metrik */
        .metric { padding: 2rem 1.25rem; border-left: 1px solid #e7e5e4; }
        .metric:nth-child(odd)    { border-left: 0; }
        .metric:nth-child(-n+2)   { border-bottom: 1px solid #e7e5e4; }
        @media (min-width: 1024px) {
            .metric { padding: 2.5rem 2rem; }
            .metric:nth-child(odd)  { border-left: 1px solid #e7e5e4; }
            .metric:first-child     { border-left: 0; }
            .metric:nth-child(-n+2) { border-bottom: 0; }
        }

        @media (prefers-reduced-motion: reduce) {
            .rise, .line-inner, .reveal { animation: none !important; transition: none !important; opacity: 1 !important; transform: none !important; }
            .animate-ping { animation: none !important; }
        }
    </style>
    <noscript><style>.rise,.reveal{opacity:1!important;transform:none!important}.line-inner{transform:none!important}</style></noscript>
</head>

<body class="bg-paper text-ink font-sans antialiased selection:bg-ochre selection:text-white">
<div class="grain" aria-hidden="true"></div>

{{-- ═════════════════════ NAVBAR ═════════════════════ --}}
<header id="site-header" data-scrolled="false"
        class="sticky top-0 z-50 border-b border-transparent bg-paper/80 backdrop-blur-md transition-colors duration-300 data-[scrolled=true]:border-stone-200">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-5 sm:px-8">
        <a href="{{ route('home') }}" class="font-display text-[1.7rem] leading-none tracking-tight text-forest">
            Pojok<em class="text-ochre">Berbagi</em>
        </a>

        <nav class="hidden items-center gap-8 text-sm font-medium text-warm md:flex" aria-label="Utama">
            <a href="#cara-kerja" class="transition-colors hover:text-forest">Cara kerja</a>
            <a href="#barang" class="transition-colors hover:text-forest">Barang tersedia</a>
            <a href="{{ $katalog }}" class="transition-colors hover:text-forest">Katalog</a>
        </nav>

        <div class="hidden items-center gap-3 md:flex">
            @if ($user)
                <a href="{{ $dashboardUrl }}" class="text-sm font-semibold text-forest transition-colors hover:text-ochre">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-xl border border-stone-300 px-4 py-2 text-sm font-semibold text-ink transition duration-300 hover:border-forest active:scale-95">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="px-2 text-sm font-semibold text-ink transition-colors hover:text-ochre">Masuk</a>
                <a href="{{ route('register') }}" class="rounded-xl bg-forest px-4 py-2 text-sm font-semibold text-paper transition duration-300 hover:bg-forest-soft active:scale-95">Daftar</a>
            @endif
        </div>

        <button id="menu-btn" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="mobile-menu"
                class="-mr-2 inline-flex h-10 w-10 items-center justify-center rounded-lg text-forest md:hidden">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" d="M4 8h16M4 16h16"/></svg>
        </button>
    </div>

    <div id="mobile-menu" class="hidden border-t border-stone-200 bg-paper md:hidden">
        <div class="mx-auto flex max-w-7xl flex-col gap-1 px-5 py-4 text-[15px] font-medium text-ink sm:px-8">
            <a href="#cara-kerja" class="rounded-lg px-2 py-2.5 hover:bg-stone-100">Cara kerja</a>
            <a href="#barang" class="rounded-lg px-2 py-2.5 hover:bg-stone-100">Barang tersedia</a>
            <a href="{{ $katalog }}" class="rounded-lg px-2 py-2.5 hover:bg-stone-100">Katalog</a>
            <div class="mt-2 flex gap-2 border-t border-stone-200 pt-4">
                @if ($user)
                    <a href="{{ $dashboardUrl }}" class="flex-1 rounded-xl bg-forest px-4 py-3 text-center text-sm font-semibold text-paper">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="flex-1 rounded-xl border border-stone-300 px-4 py-3 text-center text-sm font-semibold">Masuk</a>
                    <a href="{{ route('register') }}" class="flex-1 rounded-xl bg-forest px-4 py-3 text-center text-sm font-semibold text-paper">Daftar</a>
                @endif
            </div>
        </div>
    </div>
</header>

<main>
{{-- ═════════════════════ HERO ═════════════════════ --}}
<section class="relative">
    <div class="mx-auto max-w-7xl px-5 pb-20 pt-12 sm:px-8 lg:pb-28 lg:pt-20">
        <div class="grid items-center gap-14 lg:grid-cols-12 lg:gap-10">

            {{-- Teks --}}
            <div class="lg:col-span-6">
                <p class="rise flex items-center gap-3 text-[12px] font-semibold uppercase tracking-[.18em] text-ochre" style="--d:80ms">
                    <span class="h-px w-9 bg-ochre"></span>
                    Redistribusi perlengkapan sekolah
                </p>

                <h1 class="font-display mt-6 text-[clamp(3rem,7vw,5.9rem)] leading-[.98] tracking-[-.02em] text-ink">
                    <span class="line"><span class="line-inner" style="--d:160ms">Dari rak bukumu,</span></span>
                    <span class="line"><span class="line-inner" style="--d:260ms">ke meja belajar</span></span>
                    <span class="line"><span class="line-inner" style="--d:360ms"><em class="text-ochre">anak lain.</em></span></span>
                </h1>

                <p class="rise mt-8 max-w-[34rem] text-[17px] leading-relaxed text-warm" style="--d:560ms">
                    PojokBerbagi mempertemukan donatur dengan siswa yang membutuhkan buku pelajaran, seragam, dan alat tulis layak pakai. Setiap barang diperiksa Tim Posko Transit sebelum sampai ke tangan penerima.
                </p>

                <div class="rise mt-10 flex flex-wrap items-center gap-3" style="--d:680ms">
                    <a href="{{ $cta[0][1] }}"
                       class="group inline-flex items-center gap-2.5 rounded-xl bg-forest px-6 py-3.5 text-sm font-semibold text-paper transition duration-300 hover:bg-forest-soft active:scale-95">
                        {{ $cta[0][0] }}
                        <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </a>
                    <a href="{{ $cta[1][1] }}"
                       class="group inline-flex items-center gap-2.5 rounded-xl border border-stone-300 px-6 py-3.5 text-sm font-semibold text-ink transition duration-300 hover:border-forest hover:bg-stone-100/70 active:scale-95">
                        {{ $cta[1][0] }}
                        <svg class="h-4 w-4 text-warm transition duration-300 group-hover:translate-x-1 group-hover:text-forest" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </a>
                </div>

                <p class="rise mt-8 flex items-center gap-2 text-[13px] text-warm" style="--d:800ms">
                    <svg class="h-4 w-4 shrink-0 text-forest" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7"/></svg>
                    Tidak ada barang yang disalurkan sebelum lolos verifikasi.
                </p>
            </div>

            {{-- Kolase foto editorial + kartu status --}}
            <div class="lg:col-span-6">
                <div class="relative mx-auto aspect-[5/5.6] w-full max-w-[34rem] lg:ml-auto lg:max-w-none">
                    <div class="grid h-full grid-cols-12 grid-rows-12 gap-3">

                        <figure class="rise group relative col-span-7 col-start-1 row-span-8 row-start-1 overflow-hidden rounded-2xl border border-stone-200 bg-stone-200" style="--d:300ms">
                            <img src="{{ $img('1509062522246-3755977927d7', 1000) }}" alt="Guru dan siswa di ruang kelas"
                                 fetchpriority="high" onerror="this.style.display='none'"
                                 class="h-full w-full object-cover object-[42%_50%] transition-transform duration-700 ease-out group-hover:scale-105">
                        </figure>

                        <figure class="rise group relative col-span-5 col-start-8 row-span-5 row-start-1 overflow-hidden rounded-2xl border border-stone-200 bg-stone-200" style="--d:420ms">
                            <img src="{{ $img('1497633762265-9d179a990aa6', 700) }}" alt="Tumpukan buku berwarna" loading="eager" onerror="this.style.display='none'"
                                 class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                        </figure>

                        <figure class="rise group relative col-span-5 col-start-8 row-span-7 row-start-6 overflow-hidden rounded-2xl border border-stone-200 bg-stone-200" style="--d:540ms">
                            <img src="{{ $img('1503676260728-1c00da094a0b', 700) }}" alt="Buku, apel, dan pensil warna di atas meja belajar" loading="eager" onerror="this.style.display='none'"
                                 class="h-full w-full object-cover object-[35%_50%] transition-transform duration-700 ease-out group-hover:scale-105">
                        </figure>
                    </div>

                    {{-- Kartu status distribusi --}}
                    <div class="rise absolute bottom-0 left-0 w-[64%] min-w-[15.5rem] max-w-[21rem] rounded-xl border border-stone-200 bg-paper/95 p-4 shadow-[0_10px_30px_-14px_rgba(20,54,43,.35)] backdrop-blur sm:p-5 lg:-left-6" style="--d:760ms">
                        <div class="flex items-center justify-between gap-3">
                            <span class="inline-flex items-center gap-2 text-[10.5px] font-semibold uppercase tracking-[.16em] text-warm">
                                <span class="relative flex h-2 w-2">
                                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-ochre opacity-60"></span>
                                    <span class="relative inline-flex h-2 w-2 rounded-full bg-ochre"></span>
                                </span>
                                {{ $isSample ? 'Contoh alur' : 'Status distribusi' }}
                            </span>
                            <span class="text-[11px] text-stone-400">{{ $live['waktu'] }}</span>
                        </div>

                        <p class="font-display mt-3 line-clamp-2 text-[1.35rem] leading-[1.15] text-ink">{{ $live['nama'] }}</p>
                        <p class="mt-1 text-xs text-warm">{{ $live['meta'] }}</p>

                        <div class="mt-4 grid grid-cols-3 gap-1.5" role="img" aria-label="Tahap {{ $live['step'] }} dari 3: {{ $stepLabels[$live['step'] - 1] }}">
                            @foreach ($stepLabels as $i => $label)
                                <div>
                                    <div class="h-1 rounded-full {{ $i < $live['step'] ? 'bg-forest' : 'bg-stone-200' }}"></div>
                                    <p class="mt-1.5 text-[10.5px] {{ $i + 1 === $live['step'] ? 'font-semibold text-forest' : 'text-stone-400' }}">{{ $label }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═════════════════════ STRIP METRIK ═════════════════════ --}}
<section class="border-y border-stone-200 bg-white/40" aria-label="Angka platform">
    <div class="mx-auto grid max-w-7xl grid-cols-2 px-5 sm:px-8 lg:grid-cols-4">
        @foreach ($metricList as $i => $m)
            <div class="metric reveal" style="--d:{{ $i * 90 }}ms">
                <p class="font-display text-[clamp(2.6rem,5vw,4rem)] leading-none tracking-tight text-forest">
                    <span data-count="{{ $m['n'] }}">{{ number_format($m['n'], 0, ',', '.') }}</span>
                </p>
                <p class="mt-3 text-sm font-semibold text-ink">{{ $m['label'] }}</p>
                <p class="mt-1 text-[12.5px] leading-snug text-warm">{{ $m['note'] }}</p>
            </div>
        @endforeach
    </div>
    <p class="mx-auto max-w-7xl px-5 pb-5 text-[11.5px] text-stone-400 sm:px-8">Dihitung langsung dari data platform.</p>
</section>

{{-- ═════════════════════ CARA KERJA ═════════════════════ --}}
<section id="cara-kerja" class="scroll-mt-16 py-24 lg:py-32">
    <div class="mx-auto grid max-w-7xl gap-12 px-5 sm:px-8 lg:grid-cols-12 lg:gap-16">
        <div class="lg:col-span-5">
            <div class="reveal lg:sticky lg:top-28">
                <p class="flex items-center gap-3 text-[12px] font-semibold uppercase tracking-[.18em] text-ochre">
                    <span class="h-px w-9 bg-ochre"></span> Cara kerja
                </p>
                <h2 class="font-display mt-5 text-[clamp(2.4rem,4.6vw,3.8rem)] leading-[1.02] tracking-[-.015em]">
                    Tiga langkah, <em class="text-ochre">satu rantai</em> kepercayaan.
                </h2>
                <p class="mt-6 max-w-md text-[16px] leading-relaxed text-warm">
                    Donatur tidak perlu mencari penerima, penerima tidak perlu bertanya ke mana barang itu berasal. Tim Posko Transit berada di tengah untuk memastikan semuanya tepat.
                </p>
            </div>
        </div>

        <ol class="lg:col-span-7">
            @foreach ([
                ['01', 'Donatur mengunggah barang', 'Foto, kondisi, dan jumlah barang dicatat lewat satu formulir singkat. Tidak perlu tahu siapa yang akan menerimanya.', 'Donatur'],
                ['02', 'Posko memeriksa kelayakan', 'Tim Posko Transit mengecek setiap barang sebelum masuk katalog. Barang yang tidak layak pakai tidak akan disalurkan.', 'Tim Posko Transit'],
                ['03', 'Tiba dengan bukti serah terima', 'Barang disalurkan kepada penerima manfaat. Statusnya bisa dipantau, dan foto serah terima tersimpan sebagai bukti.', 'Penerima manfaat'],
            ] as $i => [$no, $judul, $isi, $tag])
                <li class="reveal group grid grid-cols-[auto_1fr] gap-x-6 border-t border-stone-300 py-9 first:border-t-0 first:pt-0 lg:gap-x-10" style="--d:{{ $i * 110 }}ms">
                    <span class="font-display text-[3.2rem] leading-none text-ochre/90 transition-transform duration-500 ease-out group-hover:-translate-y-1 lg:text-[4rem]">{{ $no }}</span>
                    <div>
                        <span class="inline-block rounded-md border border-stone-300 px-2 py-0.5 text-[10.5px] font-semibold uppercase tracking-[.14em] text-warm">{{ $tag }}</span>
                        <h3 class="font-display mt-3 text-[1.9rem] leading-tight text-ink lg:text-[2.2rem]">{{ $judul }}</h3>
                        <p class="mt-3 max-w-lg text-[15.5px] leading-relaxed text-warm">{{ $isi }}</p>
                    </div>
                </li>
            @endforeach
        </ol>
    </div>
</section>

{{-- ═════════════════════ BARANG TERSEDIA ═════════════════════ --}}
<section id="barang" class="scroll-mt-16 border-t border-stone-200 bg-white/40 py-24 lg:py-28">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">
        <div class="reveal flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="flex items-center gap-3 text-[12px] font-semibold uppercase tracking-[.18em] text-ochre">
                    <span class="h-px w-9 bg-ochre"></span> Tersedia sekarang
                </p>
                <h2 class="font-display mt-5 text-[clamp(2.3rem,4.4vw,3.5rem)] leading-[1.03] tracking-[-.015em]">
                    Siap menemukan <em class="text-ochre">pemiliknya.</em>
                </h2>
            </div>
            <a href="{{ $katalog }}" class="group inline-flex shrink-0 items-center gap-2 text-sm font-semibold text-forest transition-colors hover:text-ochre">
                Lihat semua di katalog
                <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
            </a>
        </div>

        @if ($recentItems->isEmpty())
            <div class="reveal mt-12 rounded-2xl border border-dashed border-stone-300 px-6 py-16 text-center">
                <p class="font-display text-2xl text-ink">Belum ada barang yang tersedia.</p>
                <p class="mt-2 text-sm text-warm">Jadilah yang pertama berbagi — barang Anda akan muncul di sini setelah diverifikasi.</p>
            </div>
        @else
            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($recentItems as $i => $item)
                    <article class="reveal group flex flex-col overflow-hidden rounded-xl border border-stone-200 bg-paper transition-colors duration-300 hover:border-stone-300" style="--d:{{ ($i % 3) * 90 }}ms">
                        <div class="relative aspect-[4/3] overflow-hidden bg-stone-200">
                            @if ($item->foto)
                                <img src="{{ $item->foto_url }}" alt="{{ $item->nama_barang }}" loading="lazy"
                                     class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-[#efeae0] px-6 text-center">
                                    <span class="font-display text-2xl italic text-stone-400">{{ $item->kategori }}</span>
                                </div>
                            @endif
                            <span class="absolute left-3 top-3 rounded-md border border-stone-200 bg-paper/90 px-2 py-1 text-[10.5px] font-semibold text-warm backdrop-blur">{{ $item->kondisi }}</span>
                        </div>
                        <div class="flex flex-1 flex-col p-5">
                            <p class="text-[10.5px] font-semibold uppercase tracking-[.14em] text-ochre">{{ $item->kategori }}</p>
                            <h3 class="font-display mt-2 line-clamp-2 text-[1.55rem] leading-[1.12] text-ink">{{ $item->nama_barang }}</h3>
                            <p class="mt-2 line-clamp-2 text-[14px] leading-relaxed text-warm">{{ $item->deskripsi }}</p>
                            <div class="mt-auto flex items-center justify-between border-t border-stone-200 pt-4 text-sm">
                                <span class="font-semibold text-ink">{{ $item->jumlah }} unit</span>
                                <a href="{{ $user ? route('items.show', $item->id) : route('login') }}" class="group/l inline-flex items-center gap-1.5 font-semibold text-forest transition-colors hover:text-ochre">
                                    {{ $user ? 'Lihat detail' : 'Masuk untuk detail' }}
                                    <svg class="h-3.5 w-3.5 transition-transform duration-300 group-hover/l:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ═════════════════════ CTA PENUTUP ═════════════════════ --}}
<section class="px-5 py-20 sm:px-8 lg:py-28">
    <div class="reveal mx-auto grid max-w-7xl overflow-hidden rounded-2xl bg-forest text-paper lg:grid-cols-12">
        <div class="p-8 sm:p-12 lg:col-span-7 lg:p-16">
            <p class="flex items-center gap-3 text-[12px] font-semibold uppercase tracking-[.18em] text-[#f0a974]">
                <span class="h-px w-9 bg-[#f0a974]"></span> Mulai dari yang kecil
            </p>
            <h2 class="font-display mt-6 text-[clamp(2.4rem,4.8vw,4rem)] leading-[1.02] tracking-[-.015em]">
                Satu barang yang tak lagi terpakai bisa jadi <em class="text-[#f0a974]">buku pertama</em> seorang anak.
            </h2>
            <p class="mt-6 max-w-lg text-[16px] leading-relaxed text-paper/70">
                Daftar, unggah barang, lalu pantau perjalanannya sampai tiba. Prosesnya ringkas, dan setiap tahap tercatat.
            </p>
            <div class="mt-10 flex flex-wrap gap-3">
                <a href="{{ $cta[0][1] }}" class="group inline-flex items-center gap-2.5 rounded-xl bg-paper px-6 py-3.5 text-sm font-semibold text-forest transition duration-300 hover:bg-white active:scale-95">
                    {{ $cta[0][0] }}
                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                </a>
                <a href="{{ $katalog }}" class="inline-flex items-center rounded-xl border border-paper/25 px-6 py-3.5 text-sm font-semibold text-paper transition duration-300 hover:bg-paper/10 active:scale-95">
                    Jelajahi katalog
                </a>
            </div>
        </div>
        <div class="group relative hidden min-h-[22rem] overflow-hidden lg:col-span-5 lg:block">
            <img src="{{ $img('1456513080510-7bf3a84b82f8', 900) }}" alt="Buku terbuka dengan pena di atas meja" loading="lazy" onerror="this.style.display='none'"
                 class="absolute inset-0 h-full w-full object-cover opacity-90 transition-transform duration-700 ease-out group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-r from-forest via-forest/20 to-transparent"></div>
        </div>
    </div>
</section>
</main>

{{-- ═════════════════════ FOOTER ═════════════════════ --}}
<footer class="border-t border-stone-200">
    <div class="mx-auto flex max-w-7xl flex-col gap-8 px-5 py-12 sm:px-8 md:flex-row md:items-end md:justify-between">
        <div>
            <a href="{{ route('home') }}" class="font-display text-3xl leading-none text-forest">Pojok<em class="text-ochre">Berbagi</em></a>
            <p class="mt-3 max-w-xs text-[13.5px] leading-relaxed text-warm">Platform redistribusi barang edukasi layak pakai untuk pemerataan akses pendidikan.</p>
        </div>
        <nav class="flex flex-wrap gap-x-8 gap-y-3 text-sm font-medium text-warm" aria-label="Footer">
            <a href="#cara-kerja" class="transition-colors hover:text-forest">Cara kerja</a>
            <a href="{{ $katalog }}" class="transition-colors hover:text-forest">Katalog</a>
            @unless ($user)
                <a href="{{ route('login') }}" class="transition-colors hover:text-forest">Masuk</a>
                <a href="{{ route('register') }}" class="transition-colors hover:text-forest">Daftar</a>
            @endunless
        </nav>
    </div>
    <div class="border-t border-stone-200">
        <p class="mx-auto max-w-7xl px-5 py-5 text-xs text-stone-400 sm:px-8">&copy; {{ date('Y') }} PojokBerbagi. Hak cipta dilindungi.</p>
    </div>
</footer>

<script>
(function () {
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Navbar: border tipis muncul saat di-scroll
    var header = document.getElementById('site-header');
    var onScroll = function () { header.dataset.scrolled = window.scrollY > 8 ? 'true' : 'false'; };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // Menu mobile
    var btn = document.getElementById('menu-btn'), menu = document.getElementById('mobile-menu');
    btn.addEventListener('click', function () {
        var open = menu.classList.toggle('hidden') === false;
        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    menu.querySelectorAll('a').forEach(function (a) {
        a.addEventListener('click', function () { menu.classList.add('hidden'); btn.setAttribute('aria-expanded', 'false'); });
    });

    if (reduce || !('IntersectionObserver' in window)) {
        document.querySelectorAll('.reveal').forEach(function (el) { el.classList.add('in'); });
        return; // angka sudah berisi nilai akhir
    }

    // Scroll reveal
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -6% 0px' });
    document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });

    // Counter angka
    var fmt = new Intl.NumberFormat('id-ID');
    var easeOutExpo = function (t) { return t === 1 ? 1 : 1 - Math.pow(2, -10 * t); };
    var counters = document.querySelectorAll('[data-count]');
    counters.forEach(function (el) { el.textContent = '0'; });

    var co = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (!e.isIntersecting) return;
            co.unobserve(e.target);
            var el = e.target, target = parseInt(el.dataset.count, 10) || 0, dur = 1600, t0 = null;
            var step = function (ts) {
                if (t0 === null) t0 = ts;
                var p = Math.min((ts - t0) / dur, 1);
                el.textContent = fmt.format(Math.round(target * easeOutExpo(p)));
                if (p < 1) requestAnimationFrame(step);
            };
            requestAnimationFrame(step);
        });
    }, { threshold: 0.6 });
    counters.forEach(function (el) { co.observe(el); });
})();
</script>
</body>
</html>
