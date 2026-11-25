<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PojokBerbagi') }} - @yield('title', 'Platform Donasi Barang Pendidikan')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Scripts & Styles via Vite -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen text-slate-800 antialiased selection:bg-emerald-500 selection:text-white">

    <!-- Header / Navbar -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Brand Logo -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white shadow-md shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-xl font-bold tracking-tight text-slate-900 group-hover:text-emerald-600 transition-colors">PojokBerbagi</span>
                            <span class="hidden sm:block text-[11px] font-medium text-emerald-600 uppercase tracking-wider">Donasi Pendidikan</span>
                        </div>
                    </a>
                </div>

               <!-- Navigation Links -->
                <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                    <a href="{{ route('home') }}" class="text-slate-600 hover:text-emerald-600 transition-colors {{ request()->routeIs('home') ? 'text-emerald-600 font-semibold' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('katalog.index') }}" class="text-slate-600 hover:text-emerald-600 transition-colors {{ request()->routeIs('katalog.*') ? 'text-emerald-600 font-semibold' : '' }}">
                        Katalog Barang
                    </a>

                    @auth
                        @if (auth()->user()->isDonor())
                            <a href="{{ route('donor.dashboard') }}" class="text-slate-600 hover:text-emerald-600 transition-colors {{ request()->routeIs('donor.dashboard') ? 'text-emerald-600 font-semibold' : '' }}">
                                Dashboard Donatur
                            </a>
                            <a href="{{ route('donor.my-donations') }}" class="text-slate-600 hover:text-emerald-600 transition-colors {{ request()->routeIs('donor.my-donations') ? 'text-emerald-600 font-semibold' : '' }}">
                                Riwayat Donasi
                            </a>
                            <a href="{{ route('items.create') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Posting Donasi
                            </a>
                        @elseif (auth()->user()->isBeneficiary())
                            <a href="{{ route('beneficiary.dashboard') }}" class="text-slate-600 hover:text-emerald-600 transition-colors {{ request()->routeIs('beneficiary.dashboard') ? 'text-emerald-600 font-semibold' : '' }}">
                                Katalog Donasi
                            </a>
                        @elseif (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-600 hover:text-emerald-600 transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-emerald-600 font-semibold' : '' }}">
                                Dashboard Admin
                            </a>
                        @endif
                    @endauth
                </nav>

                <!-- User & Auth Menu -->
                <div class="flex items-center gap-3">
                    @auth
                        <div class="flex items-center gap-3">
                            <!-- Role Badge -->
                            @if (auth()->user()->isAdmin())
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-purple-100 text-purple-800 border border-purple-200">
                                    Admin
                                </span>
                            @elseif (auth()->user()->isBeneficiary())
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                                    Penerima Manfaat
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    Donatur
                                </span>
                            @endif

                            <div class="hidden sm:block text-right">
                                <div class="text-sm font-semibold text-slate-800 leading-tight">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-slate-500">{{ auth()->user()->email }}</div>
                            </div>

                            <!-- Logout Form -->
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" title="Keluar dari akun" class="p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center gap-2">
                            <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:text-emerald-600 transition-colors">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg shadow-sm shadow-emerald-600/20 transition-all">
                                Daftar
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
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

    <!-- Main Content -->
    <main class="flex-1 pb-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-auto bg-white border-t border-slate-200 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-lg bg-emerald-600 flex items-center justify-center text-white">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253" />
                    </svg>
                </div>
                <span>&copy; {{ date('Y') }} <strong>PojokBerbagi</strong>. Platform Donasi Barang Pendidikan.</span>
            </div>
            <div class="text-slate-400">
                Mendukung pemerataan akses pendidikan untuk anak bangsa.
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
