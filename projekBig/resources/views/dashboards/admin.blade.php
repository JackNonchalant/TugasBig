{{-- resources/views/dashboards/admin.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard Administrator')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-8">

    {{-- ═══════════════════════════════════════════════════════
         SECTION 1 ─ HEADER
    ═══════════════════════════════════════════════════════ --}}
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 pb-6 border-b border-stone-200 rise">
        <div>
            <p class="flex items-center gap-3 text-[11px] font-semibold uppercase tracking-[.18em] text-ochre mb-2">
                <span class="h-px w-8 bg-ochre"></span>
                Tim Posko Transit — Panel Admin
            </p>
            <h1 class="font-display text-3xl sm:text-4xl tracking-tight text-ink">
                Dashboard manajemen <em class="text-ochre">sistem.</em>
            </h1>
            <p class="text-sm text-warm mt-1.5">Pantau seluruh aktivitas donasi, penyaluran, dan akun pengguna PojokBerbagi.</p>
        </div>
        <div class="text-xs font-medium text-warm bg-white border border-stone-200 px-3.5 py-2 rounded-xl self-start sm:self-auto">
            {{ now()->isoFormat('dddd, D MMMM YYYY') }}
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════
         SECTION 2 ─ STATISTIK RINGKASAN
    ═══════════════════════════════════════════════════════ --}}

    {{-- Baris 1: Barang Donasi --}}
    <div class="rise" style="--d:60ms">
        <p class="text-[11px] font-semibold uppercase tracking-[.16em] text-warm mb-3">Barang Donasi</p>
        <div class="bg-white rounded-2xl border border-stone-200 grid grid-cols-2 lg:grid-cols-4 divide-y lg:divide-y-0 lg:divide-x divide-stone-200">
            <div class="p-5 sm:p-6">
                <div class="text-[11px] font-semibold text-warm uppercase tracking-[.12em]">Total Barang</div>
                <div class="font-display text-4xl text-ink mt-2 leading-none">{{ $stats['total_items'] }}</div>
                <div class="text-xs text-warm mt-1.5">Semua donasi tercatat</div>
            </div>
            <div class="p-5 sm:p-6 border-l border-stone-200 lg:border-l-0">
                <div class="text-[11px] font-semibold text-ochre uppercase tracking-[.12em]">Menunggu Verifikasi</div>
                <div class="font-display text-4xl text-ochre mt-2 leading-none">{{ $stats['total_menunggu_verifikasi'] }}</div>
                <div class="text-xs text-warm mt-1.5">Perlu dicek transit</div>
            </div>
            <div class="p-5 sm:p-6">
                <div class="text-[11px] font-semibold text-forest uppercase tracking-[.12em]">Tersedia</div>
                <div class="font-display text-4xl text-forest mt-2 leading-none">{{ $stats['total_available'] }}</div>
                <div class="text-xs text-warm mt-1.5">Siap disalurkan</div>
            </div>
            <div class="p-5 sm:p-6 border-l border-stone-200 lg:border-l-0">
                <div class="text-[11px] font-semibold text-warm uppercase tracking-[.12em]">Sudah Disalurkan</div>
                <div class="font-display text-4xl text-ink mt-2 leading-none">{{ $stats['total_disalurkan_items'] }}</div>
                <div class="text-xs text-warm mt-1.5">Barang terselesaikan</div>
            </div>
        </div>
    </div>

    {{-- Baris 2: Pengguna --}}
    <div class="rise" style="--d:120ms">
        <p class="text-[11px] font-semibold uppercase tracking-[.16em] text-warm mb-3">Pengguna Terdaftar</p>
        <div class="bg-white rounded-2xl border border-stone-200 grid grid-cols-2 lg:grid-cols-4 divide-y lg:divide-y-0 lg:divide-x divide-stone-200">
            <div class="p-5 sm:p-6">
                <div class="text-[11px] font-semibold text-warm uppercase tracking-[.12em]">Total Pengguna</div>
                <div class="font-display text-4xl text-ink mt-2 leading-none">{{ $stats['total_users'] }}</div>
                <div class="text-xs text-warm mt-1.5">Donatur + Penerima</div>
            </div>
            <div class="p-5 sm:p-6 border-l border-stone-200 lg:border-l-0">
                <div class="text-[11px] font-semibold text-forest uppercase tracking-[.12em]">Donatur</div>
                <div class="font-display text-4xl text-forest mt-2 leading-none">{{ $stats['total_donors'] }}</div>
                <div class="text-xs text-warm mt-1.5">Penyumbang barang</div>
            </div>
            <div class="p-5 sm:p-6">
                <div class="text-[11px] font-semibold text-ink uppercase tracking-[.12em]">Penerima</div>
                <div class="font-display text-4xl text-ink mt-2 leading-none">{{ $stats['total_beneficiaries'] }}</div>
                <div class="text-xs text-warm mt-1.5">Penerima manfaat</div>
            </div>
            <div class="p-5 sm:p-6 border-l border-stone-200 lg:border-l-0">
                <div class="text-[11px] font-semibold text-red-700 uppercase tracking-[.12em]">Suspended</div>
                <div class="font-display text-4xl text-red-700 mt-2 leading-none">{{ $stats['total_suspended'] }}</div>
                <div class="text-xs text-warm mt-1.5">Perlu tindakan</div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════
         SECTION 3 ─ AKUN SUSPENDED (peringatan jika ada)
    ═══════════════════════════════════════════════════════ --}}
    @if ($suspendedUsers->isNotEmpty())
    <div class="bg-red-50/70 border border-red-200 rounded-2xl p-5 sm:p-6 reveal">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
            <div class="flex items-center gap-3">
                <span class="w-2.5 h-2.5 rounded-full bg-red-600 shrink-0 animate-pulse"></span>
                <div>
                    <h3 class="text-sm font-semibold text-red-900">Akun Dinonaktifkan — Perlu Perhatian</h3>
                    <p class="text-xs text-red-800/80">{{ $stats['total_suspended'] }} akun berstatus suspended.</p>
                </div>
            </div>
            <a href="{{ route('admin.users.index', ['status' => 'suspended']) }}"
               class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-xs font-semibold text-red-900 bg-white border border-red-200 hover:bg-red-50 rounded-xl transition-colors self-start sm:self-auto">
                Kelola Semua →
            </a>
        </div>
        <div class="divide-y divide-red-200/70">
            @foreach ($suspendedUsers as $u)
            <div class="flex items-center justify-between py-2.5 gap-3">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-8 h-8 rounded-full bg-red-200/70 flex items-center justify-center text-xs font-bold text-red-900 shrink-0">
                        {{ strtoupper(substr($u->name ?? '?', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <div class="text-sm font-semibold text-ink truncate">{{ $u->name }}</div>
                        <div class="text-xs text-warm truncate">{{ $u->email }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.users.activate', $u->id) }}" class="shrink-0">
                    @csrf @method('PATCH')
                    <button type="submit" class="text-xs font-semibold text-forest bg-white hover:bg-cream border border-stone-200 px-3 py-1.5 rounded-lg transition-colors cursor-pointer active:scale-95">
                        Aktifkan Kembali
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
    <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden reveal">
        <div class="flex items-center justify-between p-5 sm:p-6 border-b border-stone-200">
            <div>
                <h2 class="font-display text-2xl text-ink">Pengguna Terdaftar Terbaru</h2>
                <p class="text-xs text-warm mt-0.5">5 akun terakhir yang mendaftar di sistem</p>
            </div>
            <a href="{{ route('admin.users.index') }}"
               class="group inline-flex items-center gap-1 text-xs font-semibold text-forest hover:text-ochre transition-colors">
                Kelola Semua
                <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
            </a>
        </div>
        @if ($recentUsers->isEmpty())
            <div class="p-10 text-center text-sm text-warm">Belum ada pengguna terdaftar.</div>
        @else
        <ul class="divide-y divide-stone-200/80">
            @foreach ($recentUsers as $u)
            <li class="flex items-center gap-3 px-5 sm:px-6 py-3.5 hover:bg-paper/70 transition-colors">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-paper shrink-0
                    {{ $u->role === 'donor' ? 'bg-forest' : 'bg-stone-700' }}">
                    {{ strtoupper(substr($u->name ?? '?', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-semibold text-ink truncate">{{ $u->name }}</div>
                    <div class="text-xs text-warm truncate">{{ $u->email }}</div>
                </div>
                <div class="text-right shrink-0 flex items-center gap-2">
                    @if ($u->role === 'donor')
                        <span class="inline-block px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-emerald-50 text-forest border border-forest/20">Donatur</span>
                    @else
                        <span class="inline-block px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-cream text-ochre border border-stone-200">Penerima</span>
                    @endif
                    @if ($u->status_akun === 'suspended')
                        <span class="inline-block px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-red-50 text-red-800 border border-red-200">Suspended</span>
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
    <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden reveal">
        <div class="flex items-center justify-between p-5 sm:p-6 border-b border-stone-200">
            <div>
                <h2 class="font-display text-2xl text-ink">Barang Donasi Terbaru</h2>
                <p class="text-xs text-warm mt-0.5">5 postingan donasi terakhir masuk ke sistem</p>
            </div>
            <a href="{{ route('katalog.index') }}"
               class="group inline-flex items-center gap-1 text-xs font-semibold text-forest hover:text-ochre transition-colors">
                Lihat Katalog
                <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
            </a>
        </div>
        @if ($recentItems->isEmpty())
            <div class="p-10 text-center text-sm text-warm">Belum ada data barang donasi.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-warm">
                    <thead class="bg-paper text-warm uppercase text-[11px] font-semibold tracking-[.12em] border-b border-stone-200">
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
                                            <img src="{{ $item->foto_url }}" alt="{{ $item->nama_barang }}" class="w-9 h-9 rounded-lg object-cover border border-stone-200">
                                        @else
                                            <div class="w-9 h-9 rounded-lg bg-cream flex items-center justify-center text-stone-400 border border-stone-200 shrink-0">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <a href="{{ route('items.show', $item->id) }}" class="font-semibold text-ink hover:text-forest transition-colors">
                                                {{ $item->nama_barang }}
                                            </a>
                                            <div class="text-[11px] text-stone-400">
                                                {{ $item->created_at->format('d M Y, H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-xs font-semibold text-ink">{{ $item->donor->name ?? '-' }}</div>
                                    <div class="text-[11px] text-stone-400">{{ $item->donor->email ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-xs">{{ $item->kategori }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-2 py-0.5 rounded-md text-xs font-medium bg-paper border border-stone-200 text-ink">
                                        {{ $item->kondisi }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-semibold text-ink">{{ $item->jumlah }}</td>
                                <td class="px-6 py-4">
                                    @if ($item->status === 'Menunggu Verifikasi Transit')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-ochre animate-pulse"></span>
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
                                        <span class="inline-block px-2.5 py-0.5 rounded-md text-xs font-semibold bg-stone-100 text-warm border border-stone-200">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('items.show', $item->id) }}"
                                       class="group inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-forest bg-cream hover:bg-stone-200/70 transition-colors">
                                        Lihat Detail
                                        <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

           @if (isset($items) && $items instanceof \Illuminate\Pagination\AbstractPaginator && $items->hasPages())
                <div class="p-4 border-t border-stone-200">
                    {{ $items->links() }}
               </div>
           @endif
        @endif
    </div>

    {{-- ═══════════════════════════════════════════════════════
         SECTION 6 ─ QUICK ACTION CARDS
    ═══════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 reveal">
        <a href="{{ route('admin.users.index') }}"
           class="flex items-center gap-4 bg-forest hover:bg-forest-soft text-paper rounded-2xl p-6 transition duration-300 active:scale-[.99] group">
            <div class="w-11 h-11 rounded-xl bg-paper/10 border border-paper/15 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-[#f0a974]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <div>
                <div class="font-display text-2xl leading-tight">Kelola Pengguna</div>
                <div class="text-xs text-paper/70 mt-0.5">Cari, filter, suspend, atau aktifkan kembali akun</div>
            </div>
            <svg class="w-4 h-4 ml-auto opacity-70 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/>
            </svg>
        </a>

        <a href="{{ route('admin.users.index', ['status' => 'suspended']) }}"
           class="flex items-center gap-4 bg-white hover:bg-cream/70 text-ink border border-stone-200 hover:border-ochre/50 rounded-2xl p-6 transition duration-300 active:scale-[.99] group">
            <div class="w-11 h-11 rounded-xl bg-red-50 border border-red-200 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-red-700" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                </svg>
            </div>
            <div>
                <div class="font-display text-2xl leading-tight">Akun Suspended</div>
                <div class="text-xs text-warm mt-0.5">
                    {{ $stats['total_suspended'] }} akun perlu ditinjau ulang
                </div>
            </div>
            <svg class="w-4 h-4 ml-auto text-warm group-hover:text-forest group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/>
            </svg>
        </a>
    </div>

</div>
@endsection
