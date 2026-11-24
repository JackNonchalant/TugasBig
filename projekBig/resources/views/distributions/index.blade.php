@extends('layouts.app')

@section('title', 'Daftar Penyaluran Barang')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-purple-50 text-purple-700 text-xs font-semibold uppercase tracking-wider mb-2">
                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                Tim Posko Transit
            </div>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">Penyaluran Barang Donasi</h1>
            <p class="text-xs text-slate-500 mt-1">Kelola dan pantau seluruh transaksi penyaluran barang donasi pendidikan</p>
        </div>
        <a href="{{ route('admin.distributions.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 shadow-sm shadow-emerald-600/20 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Buat Penyaluran Baru
        </a>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-sm">
            <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Penyaluran</div>
            <div class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['total'] }}</div>
        </div>
        <div class="p-5 rounded-2xl bg-white border border-amber-200 shadow-sm">
            <div class="text-xs font-semibold text-amber-600 uppercase tracking-wider">Menunggu</div>
            <div class="text-3xl font-bold text-amber-600 mt-2">{{ $stats['menunggu'] }}</div>
        </div>
        <div class="p-5 rounded-2xl bg-white border border-blue-200 shadow-sm">
            <div class="text-xs font-semibold text-blue-600 uppercase tracking-wider">Dalam Proses</div>
            <div class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['proses'] }}</div>
        </div>
        <div class="p-5 rounded-2xl bg-white border border-emerald-200 shadow-sm">
            <div class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Disalurkan</div>
            <div class="text-3xl font-bold text-emerald-600 mt-2">{{ $stats['selesai'] }}</div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm mb-6">
        <form method="GET" action="{{ route('admin.distributions.index') }}" class="p-4 flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang, penerima, atau nomor resi..."
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
            </div>
            <select name="status" class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none bg-white">
                <option value="semua" {{ request('status') === 'semua' ? 'selected' : '' }}>Semua Status</option>
                <option value="Menunggu Penyaluran" {{ request('status') === 'Menunggu Penyaluran' ? 'selected' : '' }}>Menunggu Penyaluran</option>
                <option value="Dalam Proses Penyaluran" {{ request('status') === 'Dalam Proses Penyaluran' ? 'selected' : '' }}>Dalam Proses Penyaluran</option>
                <option value="Disalurkan" {{ request('status') === 'Disalurkan' ? 'selected' : '' }}>Disalurkan</option>
            </select>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-slate-800 text-white text-sm font-semibold hover:bg-slate-700 transition-colors">
                Filter
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Data Penyaluran</h2>
                <p class="text-xs text-slate-500 mt-0.5">Daftar seluruh transaksi penyaluran barang donasi</p>
            </div>
            <span class="text-xs font-semibold text-slate-500 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-200">
                {{ $distributions->total() }} Data
            </span>
        </div>

        @if ($distributions->isEmpty())
            <div class="p-12 text-center">
                <svg class="w-12 h-12 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <p class="text-sm text-slate-400">Belum ada data penyaluran.</p>
                <a href="{{ route('admin.distributions.create') }}" class="inline-flex items-center gap-1 mt-3 text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                    Buat penyaluran baru →
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-[11px] font-bold tracking-wider border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Barang Donasi</th>
                            <th class="px-6 py-4">Penerima</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">No. Resi</th>
                            <th class="px-6 py-4">Petugas</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($distributions as $dist)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="px-6 py-4 font-mono text-xs text-slate-400">#{{ $dist->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900 text-sm">{{ $dist->donationItem->nama_barang ?? '-' }}</div>
                                    <div class="text-[11px] text-slate-400">{{ $dist->donationItem->kategori ?? '' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($dist->beneficiary)
                                        <div class="text-xs font-semibold text-slate-800">{{ $dist->beneficiary->name }}</div>
                                        <div class="text-[10px] text-slate-400">{{ $dist->beneficiary->email }}</div>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Belum ditentukan</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($dist->status === 'Menunggu Penyaluran')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-300">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Menunggu
                                        </span>
                                    @elseif ($dist->status === 'Dalam Proses Penyaluran')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-800 border border-blue-300">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                                            Dalam Proses
                                        </span>
                                    @elseif ($dist->status === 'Disalurkan')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-300">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Disalurkan
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs font-mono text-slate-500">
                                    {{ $dist->nomor_resi ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-600">
                                    {{ $dist->processor->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-400">
                                    {{ $dist->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.distributions.show', $dist->id) }}"
                                           class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-purple-700 bg-purple-50 hover:bg-purple-100 transition-colors">
                                            Detail
                                        </a>
                                        @if ($dist->status !== 'Disalurkan')
                                            <a href="{{ route('admin.distributions.edit-status', $dist->id) }}"
                                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 transition-colors">
                                                Update Status
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($distributions->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $distributions->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
