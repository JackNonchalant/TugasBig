{{-- resources/views/dashboards/admin.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard Administrator')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-8">

    {{-- ═══════════════════════════════════════════════════════
         SECTION 1 ─ HEADER
    ═══════════════════════════════════════════════════════ --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-purple-50 text-purple-700 text-xs font-semibold uppercase tracking-wider mb-1.5">
                <span class="w-2 h-2 rounded-full bg-purple-500 animate-pulse"></span>
                Tim Posko Transit — Panel Admin
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Dashboard Manajemen Sistem</h1>
            <p class="text-sm text-slate-500 mt-0.5">Pantau seluruh aktivitas donasi, penyaluran, dan pengguna PojokBerbagi.</p>
        </div>
        <div class="text-xs text-slate-400">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</div>
    </div>

    {{-- ═══════════════════════════════════════════════════════
         SECTION 2 ─ STATISTIK RINGKASAN (3 kelompok)
    ═══════════════════════════════════════════════════════ --}}

    {{-- Baris 1: Barang Donasi --}}
    <div>
        <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-3">📦 Barang Donasi</p>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Barang</div>
                <div class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['total_items'] }}</div>
                <div class="text-[11px] text-slate-400 mt-1">Semua donasi tercatat</div>
            </div>
            <div class="bg-white rounded-2xl border border-amber-200 shadow-sm p-5">
                <div class="text-xs font-semibold text-amber-600 uppercase tracking-wider">Menunggu Verifikasi</div>
                <div class="text-3xl font-bold text-amber-600 mt-2">{{ $stats['total_menunggu_verifikasi'] }}</div>
                <div class="text-[11px] text-amber-500/80 mt-1">Perlu dicek transit</div>
            </div>
            <div class="bg-white rounded-2xl border border-emerald-200 shadow-sm p-5">
                <div class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Tersedia</div>
                <div class="text-3xl font-bold text-emerald-600 mt-2">{{ $stats['total_available'] }}</div>
                <div class="text-[11px] text-emerald-500/80 mt-1">Siap disalurkan</div>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Sudah Disalurkan</div>
                <div class="text-3xl font-bold text-slate-700 mt-2">{{ $stats['total_disalurkan_items'] }}</div>
                <div class="text-[11px] text-slate-400 mt-1">Barang terselesaikan</div>
            </div>
        </div>
    </div>

    {{-- Baris 2: Distribusi & Pengguna --}}
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">

        {{-- Pengguna --}}
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-3">👥 Pengguna</p>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                    <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Pengguna</div>
                    <div class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['total_users'] }}</div>
                    <div class="text-[11px] text-slate-400 mt-1">Donatur + Penerima</div>
                </div>
                <div class="bg-white rounded-2xl border border-purple-200 shadow-sm p-5">
                    <div class="text-xs font-semibold text-purple-600 uppercase tracking-wider">Donatur</div>
                    <div class="text-3xl font-bold text-purple-600 mt-2">{{ $stats['total_donors'] }}</div>
                </div>
                <div class="bg-white rounded-2xl border border-blue-200 shadow-sm p-5">
                    <div class="text-xs font-semibold text-blue-600 uppercase tracking-wider">Penerima</div>
                    <div class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['total_beneficiaries'] }}</div>
                </div>
                <div class="bg-white rounded-2xl border border-red-200 shadow-sm p-5">
                    <div class="text-xs font-semibold text-red-500 uppercase tracking-wider">Suspended</div>
                    <div class="text-3xl font-bold text-red-500 mt-2">{{ $stats['total_suspended'] }}</div>
                    <div class="text-[11px] text-red-400/80 mt-1">Perlu tindakan</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════
         SECTION 3 ─ AKUN SUSPENDED (peringatan jika ada)
    ═══════════════════════════════════════════════════════ --}}
    @if ($suspendedUsers->isNotEmpty())
    <div class="bg-red-50 border border-red-200 rounded-2xl p-5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                <div>
                    <h3 class="text-sm font-bold text-red-800">Akun Dinonaktifkan — Perlu Perhatian</h3>
                    <p class="text-xs text-red-600">{{ $stats['total_suspended'] }} akun berstatus suspended.</p>
                </div>
            </div>
            <a href="{{ route('admin.users.index', ['status' => 'suspended']) }}"
               class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-red-700 bg-white border border-red-200 hover:bg-red-50 rounded-lg transition-colors">
                Kelola Semua →
            </a>
        </div>
        <div class="divide-y divide-red-100">
            @foreach ($suspendedUsers as $u)
            <div class="flex items-center justify-between py-2.5">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-full bg-red-200 flex items-center justify-center text-xs font-bold text-red-700">
                        {{ strtoupper(substr($u->name ?? '?', 0, 1)) }}
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-slate-800">{{ $u->name }}</div>
                        <div class="text-xs text-slate-500">{{ $u->email }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.users.activate', $u->id) }}">
                    @csrf @method('PATCH')
                    <button type="submit" class="text-xs font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-3 py-1 rounded-lg transition-colors">
                        Aktifkan
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ═══════════════════════════════════════════════════════
         SECTION 4 ─ PENGGUNA TERDAFTAR TERBARU
    ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between p-5 border-b border-slate-100">
            <div>
                <h2 class="text-base font-bold text-slate-900">Pengguna Terdaftar Terbaru</h2>
                <p class="text-xs text-slate-400 mt-0.5">5 akun terakhir yang mendaftar</p>
            </div>
            <a href="{{ route('admin.users.index') }}"
               class="text-xs font-semibold text-emerald-600 hover:underline">Kelola Semua →</a>
        </div>
        @if ($recentUsers->isEmpty())
            <div class="p-10 text-center text-sm text-slate-400">Belum ada pengguna terdaftar.</div>
        @else
        <ul class="divide-y divide-slate-100">
            @foreach ($recentUsers as $u)
            <li class="flex items-center gap-3 px-5 py-3 hover:bg-slate-50/60 transition-colors">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-white shrink-0
                    {{ $u->role === 'donor' ? 'bg-emerald-600' : 'bg-blue-600' }}">
                    {{ strtoupper(substr($u->name ?? '?', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-semibold text-slate-800 truncate">{{ $u->name }}</div>
                    <div class="text-xs text-slate-400 truncate">{{ $u->email }}</div>
                </div>
                <div class="text-right shrink-0 space-y-0.5">
                    @if ($u->role === 'donor')
                        <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">Donatur</span>
                    @else
                        <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">Penerima</span>
                    @endif
                    @if ($u->status_akun === 'suspended')
                        <div><span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-semibold bg-red-50 text-red-600 border border-red-200">Suspended</span></div>
                    @endif
                </div>
            </li>
            @endforeach
        </ul>
        @endif
    </div>

    {{-- ═══════════════════════════════════════════════════════
         SECTION 5 ─ BARANG DONASI TERBARU
    ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between p-5 border-b border-slate-100">
            <div>
                <h2 class="text-base font-bold text-slate-900">Barang Donasi Terbaru</h2>
                <p class="text-xs text-slate-400 mt-0.5">5 postingan donasi terakhir masuk ke sistem</p>
            </div>
            <a href="{{ route('items.create') }}"
               class="text-xs font-semibold text-emerald-600 hover:underline">Lihat Semua →</a>
        </div>
        @if ($recentItems->isEmpty())
            <div class="p-10 text-center text-sm text-slate-400">Belum ada data barang donasi.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-[11px] font-bold tracking-wider border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Barang Donasi</th>
                            <th class="px-6 py-4">Donatur</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Kondisi</th>
                            <th class="px-6 py-4">Jumlah</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($recentItems as $item)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="px-6 py-4 font-mono text-xs text-slate-400">#{{ $item->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($item->foto)
                                            <img src="{{ $item->foto_url }}" alt="{{ $item->nama_barang }}" class="w-9 h-9 rounded-lg object-cover border border-slate-200">
                                        @else
                                            <div class="w-9 h-9 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <a href="{{ route('items.show', $item->id) }}" class="font-bold text-slate-900 hover:text-emerald-600 transition-colors">
                                                {{ $item->nama_barang }}
                                            </a>
                                            <div class="text-[11px] text-slate-400">
                                                {{ $item->created_at->format('d M Y, H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-xs font-semibold text-slate-800">{{ $item->donor->name ?? '-' }}</div>
                                    <div class="text-[10px] text-slate-400">{{ $item->donor->email ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-xs">{{ $item->kategori }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                        {{ $item->kondisi }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-900">{{ $item->jumlah }}</td>
                                <td class="px-6 py-4">
                                    @if ($item->status === 'Menunggu Verifikasi Transit')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-300">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Menunggu Verifikasi
                                        </span>
                                    @elseif ($item->status === 'tersedia')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-300">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Tersedia
                                        </span>
                                    @elseif ($item->status === 'Dalam Proses Penyaluran')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-800 border border-blue-300">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                                            Dalam Proses
                                        </span>
                                    @elseif ($item->status === 'Disalurkan')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-teal-50 text-teal-700 border border-teal-300">
                                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                            Disalurkan
                                        </span>
                                    @else
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a
                                        href="{{ route('items.show', $item->id) }}"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-purple-700 bg-purple-50 hover:bg-purple-100 transition-colors"
                                    >
                                        Lihat Detail
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- ═══════════════════════════════════════════════════════
         SECTION 6 ─ QUICK ACTION CARDS
    ═══════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

        <a href="{{ route('admin.users.index') }}"
           class="flex items-center gap-4 bg-purple-600 hover:bg-purple-700 text-white rounded-2xl p-5 shadow-sm shadow-purple-600/20 transition-all group">
            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <div>
                <div class="text-sm font-bold">Kelola Pengguna</div>
                <div class="text-xs text-purple-100 mt-0.5">Suspend · Aktifkan akun</div>
            </div>
            <svg class="w-4 h-4 ml-auto opacity-60 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        <a href="{{ route('admin.users.index', ['status' => 'suspended']) }}"
           class="flex items-center gap-4 bg-red-600 hover:bg-red-700 text-white rounded-2xl p-5 shadow-sm shadow-red-600/20 transition-all group">
            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                </svg>
            </div>
            <div>
                <div class="text-sm font-bold">Akun Suspended</div>
                <div class="text-xs text-red-100 mt-0.5">
                    {{ $stats['total_suspended'] }} akun perlu ditinjau
                </div>
            </div>
            <svg class="w-4 h-4 ml-auto opacity-60 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

    </div>

</div>
@endsection
