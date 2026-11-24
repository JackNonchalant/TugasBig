@extends('layouts.app')

@section('title', 'Dashboard Administrator')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-purple-50 text-purple-700 text-xs font-semibold uppercase tracking-wider mb-2">
                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                Panel Administrator
            </div>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">Dashboard Manajemen Sistem</h1>
            <p class="text-xs text-slate-500 mt-1">Pantau seluruh aktivitas barang donasi, donatur, dan penerima manfaat PojokBerbagi</p>
        </div>
        <a href="{{ route('admin.distributions.index') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 shadow-sm shadow-emerald-600/20 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            Kelola Penyaluran
        </a>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm">
            <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Barang</div>
            <div class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['total_items'] }}</div>
            <div class="text-[11px] text-slate-400 mt-1">Seluruh donasi tercatat</div>
        </div>
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm">
            <div class="text-xs font-semibold text-amber-600 uppercase tracking-wider">Verifikasi Transit</div>
            <div class="text-3xl font-bold text-amber-600 mt-2">{{ $stats['total_menunggu_verifikasi'] }}</div>
            <div class="text-[11px] text-amber-600/70 mt-1">Menunggu dicek</div>
        </div>
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm">
            <div class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Barang Tersedia</div>
            <div class="text-3xl font-bold text-emerald-600 mt-2">{{ $stats['total_available'] }}</div>
            <div class="text-[11px] text-emerald-600/70 mt-1">Siap disalurkan</div>
        </div>
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm">
            <div class="text-xs font-semibold text-purple-600 uppercase tracking-wider">Total Donatur</div>
            <div class="text-3xl font-bold text-purple-600 mt-2">{{ $stats['total_donors'] }}</div>
            <div class="text-[11px] text-slate-400 mt-1">Akun donatur aktif</div>
        </div>
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm">
            <div class="text-xs font-semibold text-blue-600 uppercase tracking-wider">Penerima Manfaat</div>
            <div class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['total_beneficiaries'] }}</div>
            <div class="text-[11px] text-slate-400 mt-1">Akun penerima terdaftar</div>
        </div>
    </div>

    <!-- Distribution Statistics -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-sm">
            <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Penyaluran</div>
            <div class="text-2xl font-bold text-slate-900 mt-2">{{ $stats['total_distributions'] ?? 0 }}</div>
            <a href="{{ route('admin.distributions.index') }}" class="text-[11px] text-emerald-600 font-semibold hover:underline mt-1 inline-block">Lihat semua →</a>
        </div>
        <div class="p-5 rounded-2xl bg-white border border-amber-200 shadow-sm">
            <div class="text-xs font-semibold text-amber-600 uppercase tracking-wider">Menunggu Penyaluran</div>
            <div class="text-2xl font-bold text-amber-600 mt-2">{{ $stats['distributions_menunggu'] ?? 0 }}</div>
        </div>
        <div class="p-5 rounded-2xl bg-white border border-blue-200 shadow-sm">
            <div class="text-xs font-semibold text-blue-600 uppercase tracking-wider">Dalam Proses</div>
            <div class="text-2xl font-bold text-blue-600 mt-2">{{ $stats['distributions_proses'] ?? 0 }}</div>
        </div>
        <div class="p-5 rounded-2xl bg-white border border-emerald-200 shadow-sm">
            <div class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Sudah Disalurkan</div>
            <div class="text-2xl font-bold text-emerald-600 mt-2">{{ $stats['distributions_selesai'] ?? 0 }}</div>
        </div>
    </div>

    <!-- All Items Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Seluruh Data Barang Donasi</h2>
                <p class="text-xs text-slate-500 mt-0.5">Daftar lengkap postingan donasi yang masuk ke dalam sistem</p>
            </div>
            <span class="text-xs font-semibold text-slate-500 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-200">
                Total: {{ $items->total() }} Data
            </span>
        </div>

        @if ($items->isEmpty())
            <div class="p-12 text-center text-xs text-slate-400">
                Belum ada data barang donasi di sistem.
            </div>
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
                        @foreach ($items as $item)
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

            @if ($items->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $items->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
