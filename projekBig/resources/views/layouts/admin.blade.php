{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PojokBerbagi') }} - @yield('title', 'Panel Admin')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Scripts & Styles via Vite -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="h-full antialiased text-slate-800 selection:bg-emerald-500 selection:text-white">

    <div class="flex h-full">

        {{-- ========== SIDEBAR ========== --}}
        <aside id="admin-sidebar"
               class="fixed inset-y-0 left-0 z-40 flex flex-col w-64 bg-slate-900 text-white transform -translate-x-full lg:translate-x-0 lg:static lg:inset-auto transition-transform duration-200 ease-in-out">

            {{-- Brand --}}
            <div class="flex items-center gap-3 px-5 h-16 border-b border-slate-700/60 shrink-0">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-400 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <span class="text-lg font-bold tracking-tight">PojokBerbagi</span>
                    <span class="block text-[10px] font-semibold text-emerald-400 uppercase tracking-widest">Panel Admin</span>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
                <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2">Menu Utama</p>

                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Dashboard
                </a>

                {{-- Penyaluran Barang --}}
                <a href="{{ route('admin.distributions.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('admin.distributions.*') ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Penyaluran Barang
                    @php $distMenunggu = \App\Models\Distribution::where('status','Menunggu Penyaluran')->count(); @endphp
                    @if ($distMenunggu > 0)
                        <span class="ml-auto inline-flex items-center justify-center min-w-[20px] h-5 px-1 text-[10px] font-bold text-white bg-amber-500 rounded-full">{{ $distMenunggu }}</span>
                    @endif
                </a>

                <p class="px-3 pt-5 text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2">Pengelolaan</p>

                {{-- Kelola Pengguna --}}
                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('admin.users.*') ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Kelola Pengguna
                    @php
                        $suspendedCount = \App\Models\User::where('status_akun', 'suspended')->count();
                    @endphp
                    @if ($suspendedCount > 0)
                        <span class="ml-auto inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-red-500 rounded-full">{{ $suspendedCount }}</span>
                    @endif
                </a>
            </nav>

            {{-- User Info (bottom) --}}
            <div class="border-t border-slate-700/60 px-4 py-3 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center text-xs font-bold text-white uppercase">
                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-semibold text-white truncate">{{ auth()->user()->name ?? '-' }}</div>
                        <div class="text-[11px] text-slate-400 truncate">{{ auth()->user()->email ?? '-' }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Keluar" class="p-1.5 text-slate-400 hover:text-red-400 hover:bg-slate-800 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Sidebar Overlay (mobile) --}}
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden" onclick="toggleSidebar()"></div>

        {{-- ========== MAIN CONTENT ========== --}}
        <div class="flex-1 flex flex-col min-h-screen overflow-auto">

            {{-- Top Bar --}}
            <header class="sticky top-0 z-20 bg-white/95 backdrop-blur border-b border-slate-200 h-16 flex items-center px-4 sm:px-6 lg:px-8 shrink-0">
                {{-- Mobile menu button --}}
                <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 mr-3 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <h2 class="text-lg font-bold text-slate-900">@yield('page-title', 'Panel Admin')</h2>

                {{-- Right side: back to main site --}}
                <div class="ml-auto flex items-center gap-3">
                    <a href="{{ route('home') }}" class="text-sm text-slate-500 hover:text-emerald-600 transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Situs
                    </a>
                </div>
            </header>

            {{-- Flash Messages --}}
            <div class="px-4 sm:px-6 lg:px-8 w-full mt-4">
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

            {{-- Page Content --}}
            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="border-t border-slate-200 py-4 px-4 sm:px-6 lg:px-8 text-xs text-slate-400 shrink-0">
                &copy; {{ date('Y') }} <strong>PojokBerbagi</strong> &mdash; Panel Administrasi Tim Posko Transit.
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
    </script>
    @stack('scripts')
</body>
</html>
