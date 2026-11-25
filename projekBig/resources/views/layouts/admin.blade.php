{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#14362B">

    <title>{{ config('app.name', 'PojokBerbagi') }} — @yield('title', 'Panel Posko Transit')</title>

    <!-- Fonts: Plus Jakarta Sans (UI) + Instrument Serif (editorial) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|instrument-serif:400,400i&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles via Vite -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    @stack('head')
</head>
<body class="h-full bg-paper text-ink antialiased selection:bg-ochre selection:text-white">
    <div class="grain" aria-hidden="true"></div>

    <div class="flex min-h-full">

        {{-- ========== SIDEBAR (Deep Forest Green) ========== --}}
        <aside id="admin-sidebar"
               class="fixed inset-y-0 left-0 z-40 flex flex-col w-64 bg-forest text-paper transform -translate-x-full lg:translate-x-0 lg:sticky lg:top-0 lg:h-screen transition-transform duration-300 ease-out border-r border-forest-soft shrink-0">

            {{-- Brand --}}
            <div class="flex items-center justify-between px-5 h-16 border-b border-paper/10 shrink-0">
                <a href="{{ route('admin.dashboard') }}" class="flex flex-col">
                    <span class="font-display text-[1.6rem] leading-none tracking-tight text-paper">
                        Pojok<em class="text-[#f0a974]">Berbagi</em>
                    </span>
                    <span class="text-[10px] font-semibold uppercase tracking-[.18em] text-paper/60 mt-1">Posko Transit</span>
                </a>
                <button onclick="toggleSidebar()" type="button" class="lg:hidden p-1.5 text-paper/70 hover:text-paper rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-1">
                <p class="px-3 text-[10px] font-semibold uppercase tracking-[.18em] text-paper/45 mb-2">Menu Utama</p>

                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors
                          {{ request()->routeIs('admin.dashboard') ? 'bg-paper text-forest font-semibold' : 'text-paper/80 hover:bg-paper/10 hover:text-paper' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Dashboard
                </a>

                {{-- Penyaluran Barang --}}
                <a href="{{ route('admin.distributions.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors
                          {{ request()->routeIs('admin.distributions.*') ? 'bg-paper text-forest font-semibold' : 'text-paper/80 hover:bg-paper/10 hover:text-paper' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Penyaluran Barang
                    @php $distMenunggu = \App\Models\Distribution::where('status','Menunggu Penyaluran')->count(); @endphp
                    @if ($distMenunggu > 0)
                        <span class="ml-auto inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-[10px] font-bold text-white bg-ochre rounded-full">{{ $distMenunggu }}</span>
                    @endif
                </a>

                <p class="px-3 pt-5 text-[10px] font-semibold uppercase tracking-[.18em] text-paper/45 mb-2">Pengelolaan</p>

                {{-- Kelola Pengguna --}}
                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors
                          {{ request()->routeIs('admin.users.*') ? 'bg-paper text-forest font-semibold' : 'text-paper/80 hover:bg-paper/10 hover:text-paper' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Kelola Pengguna
                    @php
                        $suspendedCount = \App\Models\User::where('status_akun', 'suspended')->count();
                    @endphp
                    @if ($suspendedCount > 0)
                        <span class="ml-auto inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-[10px] font-bold text-white bg-red-500 rounded-full">{{ $suspendedCount }}</span>
                    @endif
                </a>

                <p class="px-3 pt-5 text-[10px] font-semibold uppercase tracking-[.18em] text-paper/45 mb-2">Lainnya</p>

                {{-- Notifikasi --}}
                <a href="{{ route('notifications.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors
                          {{ request()->routeIs('notifications.*') ? 'bg-paper text-forest font-semibold' : 'text-paper/80 hover:bg-paper/10 hover:text-paper' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    Notifikasi
                    @php $unreadNotif = \App\Models\Notification::where('user_id', auth()->id())->whereNull('read_at')->count(); @endphp
                    @if ($unreadNotif > 0)
                        <span class="ml-auto inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-[10px] font-bold text-ink bg-[#f0a974] rounded-full">{{ $unreadNotif }}</span>
                    @endif
                </a>

                {{-- Katalog Publik --}}
                <a href="{{ route('katalog.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors text-paper/80 hover:bg-paper/10 hover:text-paper">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    Katalog Barang
                </a>
            </nav>

            {{-- User Info (bottom) --}}
            <div class="border-t border-paper/10 px-4 py-3.5 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-ochre flex items-center justify-center text-xs font-bold text-white uppercase shrink-0">
                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-semibold text-paper truncate">{{ auth()->user()->name ?? '-' }}</div>
                        <div class="text-[11px] text-paper/55 truncate">{{ auth()->user()->email ?? '-' }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Keluar" class="p-1.5 text-paper/60 hover:text-[#f0a974] hover:bg-paper/10 rounded-lg transition-colors cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Sidebar Overlay (mobile) --}}
        <div id="sidebar-overlay" class="fixed inset-0 bg-ink/40 backdrop-blur-xs z-30 hidden lg:hidden" onclick="toggleSidebar()"></div>

        {{-- ========== MAIN CONTENT ========== --}}
        <div class="flex-1 flex flex-col min-w-0 min-h-screen">

            {{-- Top Bar --}}
            <header class="sticky top-0 z-20 bg-paper/85 backdrop-blur-md border-b border-stone-200 h-16 flex items-center px-5 sm:px-8 shrink-0">
                <button onclick="toggleSidebar()" type="button" class="lg:hidden p-2 -ml-2 mr-3 text-warm hover:text-forest hover:bg-stone-200/50 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <h2 class="font-display text-2xl tracking-tight text-ink">@yield('page-title', 'Panel Admin')</h2>

                <div class="ml-auto flex items-center gap-4">
                    <a href="{{ route('home') }}" class="group text-xs sm:text-sm font-medium text-warm hover:text-forest transition-colors flex items-center gap-1.5">
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </header>

            {{-- Flash Messages --}}
            @if (session('success') || session('error'))
                <div class="px-5 sm:px-8 w-full mt-5">
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

            {{-- Page Content --}}
            <main class="flex-1 px-5 sm:px-8 py-8">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="border-t border-stone-200 py-4 px-5 sm:px-8 text-xs text-warm shrink-0">
                &copy; {{ date('Y') }} <strong class="text-ink">PojokBerbagi</strong> &mdash; Panel Administrasi Tim Posko Transit.
            </footer>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
        (function () {
            if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches && 'IntersectionObserver' in window) {
                var io = new IntersectionObserver(function (entries) {
                    entries.forEach(function (e) {
                        if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
                    });
                }, { threshold: 0.08 });
                document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });
            } else {
                document.querySelectorAll('.reveal').forEach(function (el) { el.classList.add('in'); });
            }
        })();
    </script>
    @stack('scripts')
</body>
</html>
