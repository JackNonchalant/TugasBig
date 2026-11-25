@extends('layouts.admin')
@section('page-title', 'Penyaluran Barang')

@section('title', 'Daftar Penyaluran Barang')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 pb-6 border-b border-stone-200 rise">
        <div>
            <p class="flex items-center gap-3 text-[11px] font-semibold uppercase tracking-[.18em] text-ochre mb-2">
                <span class="h-px w-8 bg-ochre"></span>
                Tim Posko Transit
            </p>
            <h1 class="font-display text-3xl sm:text-4xl tracking-tight text-ink">
                Penyaluran barang <em class="text-ochre">donasi.</em>
            </h1>
            <p class="text-sm text-warm mt-1.5">Kelola dan pantau seluruh transaksi penyaluran barang donasi pendidikan.</p>
        </div>
        <a href="{{ route('admin.distributions.create') }}"
           class="group inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-forest text-paper text-sm font-semibold hover:bg-forest-soft transition duration-300 active:scale-95 self-start sm:self-auto">
            Buat Penyaluran Baru
            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
            </svg>
        </a>
    </div>

    <!-- Statistics -->
    <div class="bg-white rounded-2xl border border-stone-200 grid grid-cols-2 lg:grid-cols-4 divide-y lg:divide-y-0 lg:divide-x divide-stone-200">
        <div class="p-5 sm:p-6">
            <div class="text-[11px] font-semibold text-warm uppercase tracking-[.12em]">Total Penyaluran</div>
            <div class="font-display text-4xl text-ink mt-2 leading-none">{{ $stats['total'] }}</div>
        </div>
        <div class="p-5 sm:p-6 border-l border-stone-200 lg:border-l-0">
            <div class="text-[11px] font-semibold text-ochre uppercase tracking-[.12em]">Menunggu</div>
            <div class="font-display text-4xl text-ochre mt-2 leading-none">{{ $stats['menunggu'] }}</div>
        </div>
        <div class="p-5 sm:p-6">
            <div class="text-[11px] font-semibold text-ink uppercase tracking-[.12em]">Dalam Proses</div>
            <div class="font-display text-4xl text-ink mt-2 leading-none">{{ $stats['proses'] }}</div>
        </div>
        <div class="p-5 sm:p-6 border-l border-stone-200 lg:border-l-0">
            <div class="text-[11px] font-semibold text-forest uppercase tracking-[.12em]">Disalurkan</div>
            <div class="font-display text-4xl text-forest mt-2 leading-none">{{ $stats['selesai'] }}</div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-2xl border border-stone-200">
        <form method="GET" action="{{ route('admin.distributions.index') }}" class="p-4 sm:p-5 flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang, penerima, atau nomor resi..."
                       class="w-full px-4 py-2.5 bg-paper rounded-xl border border-stone-200 text-sm text-ink placeholder:text-stone-400 focus:bg-white focus:ring-2 focus:ring-forest/20 focus:border-forest outline-none transition-all">
            </div>
            <select name="status" class="px-4 py-2.5 bg-paper rounded-xl border border-stone-200 text-sm text-ink focus:bg-white focus:ring-2 focus:ring-forest/20 focus:border-forest outline-none">
                <option value="semua" {{ request('status') === 'semua' ? 'selected' : '' }}>Semua Status</option>
                <option value="Menunggu Penyaluran" {{ request('status') === 'Menunggu Penyaluran' ? 'selected' : '' }}>Menunggu Penyaluran</option>
                <option value="Dalam Proses Penyaluran" {{ request('status') === 'Dalam Proses Penyaluran' ? 'selected' : '' }}>Dalam Proses Penyaluran</option>
                <option value="Disalurkan" {{ request('status') === 'Disalurkan' ? 'selected' : '' }}>Disalurkan</option>
            </select>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-forest text-paper text-sm font-semibold hover:bg-forest-soft transition duration-300 active:scale-95 cursor-pointer">
                Filter
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
        <div class="p-5 sm:p-6 border-b border-stone-200 flex items-center justify-between">
            <div>
                <h2 class="font-display text-2xl text-ink">Data Penyaluran</h2>
                <p class="text-xs text-warm mt-0.5">Daftar seluruh transaksi penyaluran barang donasi</p>
            </div>
            <span class="text-xs font-semibold text-warm bg-paper px-3 py-1.5 rounded-lg border border-stone-200">
                {{ $distributions->total() }} Data
            </span>
        </div>

        @if ($distributions->isEmpty())
            <div class="p-14 text-center">
                <p class="font-display text-2xl text-ink">Belum ada data penyaluran.</p>
                <a href="{{ route('admin.distributions.create') }}" class="inline-flex items-center gap-1 mt-3 text-sm font-semibold text-forest hover:text-ochre transition-colors">
                    Buat penyaluran baru →
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-warm">
                    <thead class="bg-paper text-warm uppercase text-[11px] font-semibold tracking-[.12em] border-b border-stone-200">
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
                    <tbody class="divide-y divide-stone-200/80">
                        @foreach ($distributions as $dist)
                            <tr class="hover:bg-paper/70 transition-colors">
                                <td class="px-6 py-4 font-mono text-xs text-stone-400">#{{ $dist->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-ink text-sm">{{ $dist->donationItem->nama_barang ?? '-' }}</div>
                                    <div class="text-[11px] text-stone-400">{{ $dist->donationItem->kategori ?? '' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($dist->beneficiary)
                                        <div class="text-xs font-semibold text-ink">{{ $dist->beneficiary->name }}</div>
                                        <div class="text-[11px] text-stone-400">{{ $dist->beneficiary->email }}</div>
                                    @else
                                        <span class="text-xs text-stone-400 italic">Belum ditentukan</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($dist->status === 'Menunggu Penyaluran')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-ochre animate-pulse"></span>
                                            Menunggu
                                        </span>
                                    @elseif ($dist->status === 'Dalam Proses Penyaluran')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-sky-50 text-sky-900 border border-sky-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-sky-600 animate-pulse"></span>
                                            Dalam Proses
                                        </span>
                                    @elseif ($dist->status === 'Disalurkan')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-emerald-50 text-forest border border-forest/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-forest"></span>
                                            Disalurkan
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs font-mono text-warm">
                                    {{ $dist->nomor_resi ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-xs text-ink">
                                    {{ $dist->processor->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-xs text-stone-400">
                                    {{ $dist->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.distributions.show', $dist->id) }}"
                                           class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-forest bg-cream hover:bg-stone-200/80 transition-colors">
                                            Detail
                                        </a>
                                        @if ($dist->status !== 'Disalurkan')
                                            <a href="{{ route('admin.distributions.edit-status', $dist->id) }}"
                                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-paper bg-forest hover:bg-forest-soft transition-colors">
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
                <div class="p-4 border-t border-stone-200">
                    {{ $distributions->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
