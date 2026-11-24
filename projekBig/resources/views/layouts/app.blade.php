<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PojokBerbagi') }} — @yield('title', 'Platform Donasi Barang Pendidikan')</title>

    <!-- Fonts: Plus Jakarta Sans (body) + Lora (editorial accent) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|lora:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles via Vite -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body { font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; }
        .font-editorial { font-family: 'Lora', ui-serif, Georgia, serif; }
    </style>
    @stack('head')
</head>
<body class="flex flex-col min-h-screen antialiased selection:bg-emerald-600 selection:text-white" style="background:#FAF9F6; color:#1e293b;">

    <!-- ═══════════════════ NAVBAR ═══════════════════ -->
    <header class="sticky top-0 z-50 border-b border-stone-200/60" style="background:rgba(250,249,246,.92); backdrop-filter:blur(12px);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                {{-- Brand --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group shrink-0">
                    <div class="w-9 h-9 rounded-lg bg-emerald-700 flex items-center justify-center text-white group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-lg font-extrabold tracking-tight text-stone-900 group-hover:text-emerald-700 transition-colors">PojokBerbagi</span>
                </a>

                {{-- Public nav links --}}
                <nav class="hidden md:flex items-center gap-1 text-[13px] font-semibold">
                    <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('home') ? 'text-emerald-700 bg-emerald-50' : 'text-stone-600 hover:text-emerald-700 hover:bg-emerald-50/60' }}">
                        Beranda
                    </a>
                    <a href="{{ route('katalog.index') }}" class="px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('katalog.*') ? 'text-emerald-700 bg-emerald-50' : 'text-stone-600 hover:text-emerald-700 hover:bg-emerald-50/60' }}">
                        Katalog Barang
                    </a>

                    @auth
                        @if (auth()->user()->isDonor())
                            <a href="{{ route('donor.dashboard') }}" class="px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('donor.dashboard') ? 'text-emerald-700 bg-emerald-50' : 'text-stone-600 hover:text-emerald-700 hover:bg-emerald-50/60' }}">
                                Dashboard
                            </a>
                        @elseif (auth()->user()->isBeneficiary())
                            <a href="{{ route('beneficiary.dashboard') }}" class="px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('beneficiary.dashboard') ? 'text-emerald-700 bg-emerald-50' : 'text-stone-600 hover:text-emerald-700 hover:bg-emerald-50/60' }}">
                                Dashboard
                            </a>
                        @elseif (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-emerald-700 bg-emerald-50' : 'text-stone-600 hover:text-emerald-700 hover:bg-emerald-50/60' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('admin.distributions.index') }}" class="text-slate-600 hover:text-emerald-600 transition-colors {{ request()->routeIs('admin.distributions.*') ? 'text-emerald-600 font-semibold' : '' }}">
                                Penyaluran
                            </a>
                        @endif
                    @endauth
                </nav>

                {{-- Right side: auth / profile --}}
                <div class="flex items-center gap-2">
                    @auth
                        {{-- Notification bell --}}
                        <a href="{{ route('notifications.index') }}" class="relative p-2 rounded-lg text-stone-500 hover:text-emerald-700 hover:bg-emerald-50/60 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            @if (auth()->user()->unreadNotificationsCount() > 0)
                                <span class="absolute top-1 right-1 w-4 h-4 rounded-full bg-red-500 text-white text-[9px] font-bold flex items-center justify-center ring-2 ring-white">
                                    {{ auth()->user()->unreadNotificationsCount() > 9 ? '9+' : auth()->user()->unreadNotificationsCount() }}
                                </span>
                            @endif
                        </a>

                        {{-- Separator --}}
                        <div class="hidden sm:block w-px h-6 bg-stone-200 mx-1"></div>

                        {{-- Profile dropdown area --}}
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg hover:bg-stone-100 transition-colors">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold shrink-0
                                    {{ auth()->user()->isAdmin() ? 'bg-amber-600' : (auth()->user()->isBeneficiary() ? 'bg-sky-600' : 'bg-emerald-700') }}">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div class="hidden sm:block text-left">
                                    <div class="text-[13px] font-semibold text-stone-800 leading-tight truncate max-w-[120px]">{{ auth()->user()->name }}</div>
                                    <div class="text-[11px] text-stone-400 leading-tight">
                                        {{ auth()->user()->isAdmin() ? 'Tim Posko Transit' : (auth()->user()->isBeneficiary() ? 'Penerima Manfaat' : 'Donatur') }}
                                    </div>
                                </div>
                                <svg class="w-3.5 h-3.5 text-stone-400 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            {{-- Dropdown --}}
                            <div x-show="open" @click.outside="open = false" x-transition
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-stone-200/80 py-1.5 z-50">
                                @if (auth()->user()->isDonor())
                                    <a href="{{ route('items.create') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-stone-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        Posting Donasi
                                    </a>
                                @endif
                                <div class="border-t border-stone-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-stone-500 hover:text-red-600 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-[13px] font-semibold text-stone-600 hover:text-emerald-700 transition-colors">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-[13px] font-bold text-white bg-emerald-700 hover:bg-emerald-800 rounded-lg transition-colors">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- ═══════════════════ FLASH MESSAGES ═══════════════════ -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full mt-4">
        @if (session('success'))
            <div class="flex items-center gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm shadow-sm mb-4">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="flex-1 font-medium">{{ session('success') }}</div>
            </div>
        @endif

        @if (session('error'))
            <div class="flex items-center gap-3 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm shadow-sm mb-4">
                <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="flex-1 font-medium">{{ session('error') }}</div>
            </div>
        @endif
    </div>

    <!-- ═══════════════════ MAIN CONTENT ═══════════════════ -->
    <main class="flex-1 pb-16">
        @yield('content')
    </main>

    <!-- ═══════════════════ FOOTER ═══════════════════ -->
    <footer class="mt-auto border-t border-stone-200/60 py-10" style="background:#FAF9F6;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-700 flex items-center justify-center text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-stone-800">PojokBerbagi</div>
                        <div class="text-xs text-stone-400">Mendukung pemerataan akses pendidikan untuk anak bangsa.</div>
                    </div>
                </div>
                <div class="text-xs text-stone-400">
                    &copy; {{ date('Y') }} PojokBerbagi &middot; Platform Donasi Barang Pendidikan
                </div>
            </div>
        </div>
    </footer>

    {{-- Alpine.js for dropdown (lightweight, single CDN) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
