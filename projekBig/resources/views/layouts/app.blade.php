<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#FAF9F6">

    <title>{{ config('app.name', 'PojokBerbagi') }} — @yield('title', 'Platform Donasi Barang Pendidikan')</title>

    <!-- Fonts: Plus Jakarta Sans (UI) + Instrument Serif (editorial) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|instrument-serif:400,400i&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles via Vite -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    @stack('head')
</head>
<body class="flex flex-col min-h-screen bg-paper text-ink antialiased selection:bg-ochre selection:text-white">
    <div class="grain" aria-hidden="true"></div>

    <!-- ═══════════════════ NAVBAR ═══════════════════ -->
    <header id="site-header" data-scrolled="false"
            class="sticky top-0 z-50 border-b border-transparent bg-paper/85 backdrop-blur-md transition-colors duration-300 data-[scrolled=true]:border-stone-200">
        <div class="max-w-7xl mx-auto px-5 sm:px-8">
            <div class="flex justify-between items-center h-16">

                {{-- Brand --}}
                <a href="{{ route('home') }}" class="font-display text-[1.7rem] leading-none tracking-tight text-forest shrink-0">
                    Pojok<em class="text-ochre">Berbagi</em>
                </a>

                {{-- Public & Role nav links --}}
                <nav class="hidden md:flex items-center gap-7 text-sm font-medium text-warm">
                    <a href="{{ route('home') }}"
                       class="transition-colors hover:text-forest {{ request()->routeIs('home') ? 'text-forest font-semibold' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('katalog.index') }}"
                       class="transition-colors hover:text-forest {{ request()->routeIs('katalog.*') ? 'text-forest font-semibold' : '' }}">
                        Katalog Barang
                    </a>

                    @auth
                        @if (auth()->user()->isDonor())
                            <a href="{{ route('donor.dashboard') }}"
                               class="transition-colors hover:text-forest {{ request()->routeIs('donor.dashboard') ? 'text-forest font-semibold' : '' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('items.create') }}"
                               class="transition-colors hover:text-forest {{ request()->routeIs('items.create') ? 'text-forest font-semibold' : '' }}">
                                Posting Donasi
                            </a>
                        @elseif (auth()->user()->isBeneficiary())
                            <a href="{{ route('beneficiary.dashboard') }}"
                               class="transition-colors hover:text-forest {{ request()->routeIs('beneficiary.dashboard') ? 'text-forest font-semibold' : '' }}">
                                Dashboard
                            </a>
                        @elseif (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                               class="transition-colors hover:text-forest {{ request()->routeIs('admin.*') ? 'text-forest font-semibold' : '' }}">
                                Dashboard Admin
                            </a>
                        @endif
                    @endauth
                </nav>

                {{-- Right side: auth / profile --}}
                <div class="flex items-center gap-2.5">
                    @auth
                        {{-- Notification bell --}}
                        <a href="{{ route('notifications.index') }}"
                           title="Notifikasi"
                           class="relative p-2 rounded-lg text-warm hover:text-forest hover:bg-stone-200/50 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            @if (auth()->user()->unreadNotificationsCount() > 0)
                                <span class="absolute top-1 right-1 w-4 h-4 rounded-full bg-ochre text-white text-[9px] font-bold flex items-center justify-center ring-2 ring-paper">
                                    {{ auth()->user()->unreadNotificationsCount() > 9 ? '9+' : auth()->user()->unreadNotificationsCount() }}
                                </span>
                            @endif
                        </a>

                        <div class="hidden sm:block w-px h-5 bg-stone-200 mx-0.5"></div>

                        {{-- Profile dropdown --}}
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" type="button"
                                    class="flex items-center gap-2 px-2 py-1.5 rounded-xl hover:bg-stone-200/50 transition-colors cursor-pointer">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-paper text-xs font-bold shrink-0
                                    {{ auth()->user()->isAdmin() ? 'bg-ochre' : (auth()->user()->isBeneficiary() ? 'bg-stone-700' : 'bg-forest') }}">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div class="hidden sm:block text-left">
                                    <div class="text-[13px] font-semibold text-ink leading-tight truncate max-w-[130px]">{{ auth()->user()->name }}</div>
                                    <div class="text-[11px] text-warm leading-tight">
                                        {{ auth()->user()->isAdmin() ? 'Tim Posko Transit' : (auth()->user()->isBeneficiary() ? 'Penerima Manfaat' : 'Donatur') }}
                                    </div>
                                </div>
                                <svg class="w-3.5 h-3.5 text-warm hidden sm:block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <div x-show="open" @click.outside="open = false" x-transition
                                 style="display: none;"
                                 class="absolute right-0 mt-2 w-52 bg-paper rounded-xl border border-stone-200 shadow-[0_12px_30px_-14px_rgba(20,54,43,0.22)] py-1.5 z-50">
                                <div class="px-4 py-2 border-b border-stone-200/70 sm:hidden">
                                    <div class="text-xs font-semibold text-ink truncate">{{ auth()->user()->name }}</div>
                                    <div class="text-[11px] text-warm">{{ auth()->user()->email }}</div>
                                </div>
                                @if (auth()->user()->isDonor())
                                    <a href="{{ route('donor.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-ink hover:bg-cream transition-colors">
                                        Dashboard Donatur
                                    </a>
                                    <a href="{{ route('items.create') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-forest font-semibold hover:bg-cream transition-colors">
                                        + Posting Donasi
                                    </a>
                                @elseif (auth()->user()->isBeneficiary())
                                    <a href="{{ route('beneficiary.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-ink hover:bg-cream transition-colors">
                                        Dashboard Penerima
                                    </a>
                                @elseif (auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-forest font-semibold hover:bg-cream transition-colors">
                                        Buka Panel Admin
                                    </a>
                                @endif
                                <a href="{{ route('notifications.index') }}" class="flex items-center justify-between px-4 py-2 text-sm text-warm hover:text-ink hover:bg-cream transition-colors">
                                    <span>Notifikasi</span>
                                    @if (auth()->user()->unreadNotificationsCount() > 0)
                                        <span class="px-1.5 py-0.5 text-[10px] font-bold rounded-full bg-ochre text-white">{{ auth()->user()->unreadNotificationsCount() }}</span>
                                    @endif
                                </a>
                                <div class="border-t border-stone-200/70 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-700 hover:bg-red-50 transition-colors cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="hidden md:flex items-center gap-2.5">
                            <a href="{{ route('login') }}" class="px-3 py-2 text-sm font-semibold text-ink hover:text-ochre transition-colors">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-semibold text-paper bg-forest hover:bg-forest-soft rounded-xl transition duration-300 active:scale-95">
                                Daftar
                            </a>
                        </div>
                    @endauth

                    {{-- Mobile Menu Toggle --}}
                    <button id="app-menu-btn" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="app-mobile-menu"
                            class="md:hidden p-2 -mr-1 text-forest rounded-lg hover:bg-stone-200/50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" d="M4 8h16M4 16h16"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Nav Drawer --}}
        <div id="app-mobile-menu" class="hidden md:hidden border-t border-stone-200 bg-paper">
            <div class="max-w-7xl mx-auto px-5 py-4 flex flex-col gap-1 text-sm font-medium text-ink">
                <a href="{{ route('home') }}" class="rounded-lg px-3 py-2.5 hover:bg-cream">Beranda</a>
                <a href="{{ route('katalog.index') }}" class="rounded-lg px-3 py-2.5 hover:bg-cream">Katalog Barang</a>
                @auth
                    @if (auth()->user()->isDonor())
                        <a href="{{ route('donor.dashboard') }}" class="rounded-lg px-3 py-2.5 hover:bg-cream">Dashboard</a>
                        <a href="{{ route('items.create') }}" class="rounded-lg px-3 py-2.5 text-forest font-semibold hover:bg-cream">+ Posting Donasi</a>
                    @elseif (auth()->user()->isBeneficiary())
                        <a href="{{ route('beneficiary.dashboard') }}" class="rounded-lg px-3 py-2.5 hover:bg-cream">Dashboard</a>
                    @elseif (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="rounded-lg px-3 py-2.5 text-forest font-semibold hover:bg-cream">Dashboard Admin</a>
                    @endif
                @else
                    <div class="mt-2 pt-3 border-t border-stone-200 flex gap-2">
                        <a href="{{ route('login') }}" class="flex-1 rounded-xl border border-stone-300 px-4 py-2.5 text-center font-semibold">Masuk</a>
                        <a href="{{ route('register') }}" class="flex-1 rounded-xl bg-forest px-4 py-2.5 text-center font-semibold text-paper">Daftar</a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- ═══════════════════ FLASH MESSAGES ═══════════════════ -->
    @if (session('success') || session('error'))
        <div class="max-w-7xl mx-auto px-5 sm:px-8 w-full mt-5">
            @if (session('success'))
                <div class="flex items-center gap-3 p-4 rounded-xl bg-white border border-forest/25 text-forest text-sm mb-3">
                    <span class="w-2 h-2 rounded-full bg-forest shrink-0"></span>
                    <div class="flex-1 font-medium">{{ session('success') }}</div>
                </div>
            @endif

            @if (session('error'))
                <div class="flex items-center gap-3 p-4 rounded-xl bg-red-50/80 border border-red-200 text-red-900 text-sm mb-3">
                    <span class="w-2 h-2 rounded-full bg-red-600 shrink-0"></span>
                    <div class="flex-1 font-medium">{{ session('error') }}</div>
                </div>
            @endif
        </div>
    @endif

    <!-- ═══════════════════ MAIN CONTENT ═══════════════════ -->
    <main class="flex-1 pb-16">
        @yield('content')
    </main>

    <!-- ═══════════════════ FOOTER ═══════════════════ -->
    <footer class="mt-auto border-t border-stone-200 bg-paper">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 py-10">
            <div class="flex flex-col md:flex-row items-start md:items-end justify-between gap-6">
                <div>
                    <a href="{{ route('home') }}" class="font-display text-2xl leading-none text-forest">
                        Pojok<em class="text-ochre">Berbagi</em>
                    </a>
                    <p class="text-xs text-warm mt-2 max-w-xs leading-relaxed">
                        Platform redistribusi perlengkapan pendidikan layak pakai untuk pemerataan akses belajar.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-6 text-xs font-medium text-warm">
                    <a href="{{ route('home') }}" class="hover:text-forest transition-colors">Beranda</a>
                    <a href="{{ route('katalog.index') }}" class="hover:text-forest transition-colors">Katalog</a>
                    <span class="text-stone-400">&copy; {{ date('Y') }} PojokBerbagi</span>
                </div>
            </div>
        </div>
    </footer>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        (function () {
            var header = document.getElementById('site-header');
            if (header) {
                var onScroll = function () { header.dataset.scrolled = window.scrollY > 8 ? 'true' : 'false'; };
                window.addEventListener('scroll', onScroll, { passive: true });
                onScroll();
            }

            var btn = document.getElementById('app-menu-btn');
            var menu = document.getElementById('app-mobile-menu');
            if (btn && menu) {
                btn.addEventListener('click', function () {
                    var open = menu.classList.toggle('hidden') === false;
                    btn.setAttribute('aria-expanded', open ? 'true' : 'false');
                });
            }

            if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches && 'IntersectionObserver' in window) {
                var io = new IntersectionObserver(function (entries) {
                    entries.forEach(function (e) {
                        if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
                    });
                }, { threshold: 0.1, rootMargin: '0px 0px -4% 0px' });
                document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });
            } else {
                document.querySelectorAll('.reveal').forEach(function (el) { el.classList.add('in'); });
            }
        })();
    </script>
    @stack('scripts')
</body>
</html>
