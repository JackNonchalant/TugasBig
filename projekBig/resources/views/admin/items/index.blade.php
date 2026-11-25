{{-- resources/views/admin/items/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Verifikasi Barang Donasi')
@section('page-title', 'Verifikasi Barang')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 pb-6 border-b border-stone-200 rise">
        <div>
            <p class="flex items-center gap-3 text-[11px] font-semibold uppercase tracking-[.18em] text-ochre mb-2">
                <span class="h-px w-8 bg-ochre"></span>
                Tim Posko Transit
            </p>
            <h1 class="font-display text-3xl sm:text-4xl tracking-tight text-ink">
                Verifikasi barang <em class="text-ochre">donasi.</em>
            </h1>
            <p class="text-sm text-warm mt-1.5">Periksa kelayakan barang yang diposting donatur sebelum ditayangkan di katalog penerima manfaat.</p>
        </div>
        <span class="text-xs font-semibold text-warm bg-white border border-stone-200 px-3.5 py-2 rounded-xl self-start sm:self-auto">
            Menunggu Verifikasi: <strong class="text-ochre">{{ $stats['menunggu'] }}</strong> Barang
        </span>
    </div>

    {{-- Metric Strip --}}
    <div class="bg-white rounded-2xl border border-stone-200 grid grid-cols-2 lg:grid-cols-4 divide-y lg:divide-y-0 lg:divide-x divide-stone-200">
        <div class="p-5 sm:p-6">
            <div class="text-[11px] font-semibold text-warm uppercase tracking-[.12em]">Total Barang</div>
            <div class="font-display text-4xl text-ink mt-2 leading-none">{{ $stats['total'] }}</div>
        </div>
        <div class="p-5 sm:p-6 border-l border-stone-200 lg:border-l-0">
            <div class="text-[11px] font-semibold text-ochre uppercase tracking-[.12em]">Menunggu Verifikasi</div>
            <div class="font-display text-4xl text-ochre mt-2 leading-none">{{ $stats['menunggu'] }}</div>
        </div>
        <div class="p-5 sm:p-6">
            <div class="text-[11px] font-semibold text-forest uppercase tracking-[.12em]">Lolos / Tersedia</div>
            <div class="font-display text-4xl text-forest mt-2 leading-none">{{ $stats['tersedia'] }}</div>
        </div>
        <div class="p-5 sm:p-6 border-l border-stone-200 lg:border-l-0">
            <div class="text-[11px] font-semibold text-red-700 uppercase tracking-[.12em]">Ditolak</div>
            <div class="font-display text-4xl text-red-700 mt-2 leading-none">{{ $stats['ditolak'] }}</div>
        </div>
    </div>

    {{-- Filter & Search --}}
    <form method="GET" action="{{ route('admin.items.index') }}"
          class="bg-white rounded-2xl border border-stone-200 p-4 sm:p-5 flex flex-col md:flex-row md:items-end gap-3">
        <div class="flex-1">
            <label for="search" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-1.5">Cari Barang / Donatur</label>
            <div class="relative">
                <svg class="w-4 h-4 text-stone-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" id="search" name="search" value="{{ $search }}"
                       placeholder="Cari nama barang, kategori, atau nama donatur..."
                       class="w-full pl-10 pr-4 py-2.5 bg-paper border border-stone-200 rounded-xl text-sm text-ink placeholder:text-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest transition-all">
            </div>
        </div>

        <div class="w-full md:w-56">
            <label for="status" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-1.5">Status</label>
            <select id="status" name="status"
                    class="w-full py-2.5 px-3 bg-paper border border-stone-200 rounded-xl text-sm text-ink focus:bg-white focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest transition-all">
                <option value="semua" {{ $status === '' || $status === 'semua' ? 'selected' : '' }}>Semua Status</option>
                <option value="Menunggu Verifikasi Transit" {{ $status === 'Menunggu Verifikasi Transit' ? 'selected' : '' }}>Menunggu Verifikasi Transit</option>
                <option value="tersedia" {{ $status === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="ditolak" {{ $status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                <option value="Dalam Proses Penyaluran" {{ $status === 'Dalam Proses Penyaluran' ? 'selected' : '' }}>Dalam Proses Penyaluran</option>
                <option value="Disalurkan" {{ $status === 'Disalurkan' ? 'selected' : '' }}>Disalurkan</option>
            </select>
        </div>

        <div class="flex items-center gap-2">
            <button type="submit"
                    class="px-5 py-2.5 rounded-xl bg-forest text-paper text-sm font-semibold hover:bg-forest-soft transition duration-300 active:scale-95 cursor-pointer">
                Filter
            </button>
            @if ($search !== '' || ($status !== '' && $status !== 'semua'))
                <a href="{{ route('admin.items.index') }}"
                   class="px-4 py-2.5 rounded-xl border border-stone-200 bg-paper text-sm font-medium text-warm hover:text-ink hover:bg-cream transition-colors">
                    Reset
                </a>
            @endif
        </div>
    </form>

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
        @if ($items->isEmpty())
            <div class="p-14 text-center">
                <p class="font-display text-2xl text-ink">Tidak ada barang donasi ditemukan.</p>
                <p class="text-xs text-warm mt-1">Coba ubah filter status atau kata kunci pencarian Anda.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-warm">
                    <thead class="bg-paper text-warm uppercase text-[11px] font-semibold tracking-[.12em] border-b border-stone-200">
                        <tr>
                            <th class="px-6 py-4">Barang Donasi</th>
                            <th class="px-6 py-4">Donatur</th>
                            <th class="px-6 py-4">Kategori &amp; Kondisi</th>
                            <th class="px-6 py-4">Jumlah</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-200/80">
                        @foreach ($items as $item)
                            <tr class="hover:bg-paper/70 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($item->foto)
                                            <img src="{{ $item->foto_url }}" alt="{{ $item->nama_barang }}" class="w-10 h-10 rounded-lg object-cover border border-stone-200 shrink-0">
                                        @else
                                            <div class="w-10 h-10 rounded-lg bg-cream flex items-center justify-center text-stone-400 border border-stone-200 shrink-0">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="min-w-0">
                                            <a href="{{ route('items.show', $item->id) }}" class="font-semibold text-ink hover:text-forest transition-colors line-clamp-1">
                                                {{ $item->nama_barang }}
                                            </a>
                                            <div class="text-[11px] text-stone-400">{{ $item->created_at->format('d M Y, H:i') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-xs font-semibold text-ink">{{ $item->donor->name ?? '-' }}</div>
                                    <div class="text-[11px] text-stone-400">{{ $item->donor->email ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-xs text-ink font-medium">{{ $item->kategori }}</div>
                                    <span class="inline-block mt-1 px-2 py-0.5 rounded-md text-[10.5px] font-medium bg-paper border border-stone-200 text-warm">
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
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-emerald-50 text-forest border border-forest/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-forest"></span>
                                            Tersedia
                                        </span>
                                    @elseif ($item->status === 'ditolak')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-red-50 text-red-800 border border-red-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                            Ditolak
                                        </span>
                                    @elseif ($item->status === 'Dalam Proses Penyaluran')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-sky-50 text-sky-900 border border-sky-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-sky-600 animate-pulse"></span>
                                            Dalam Proses
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-stone-100 text-ink border border-stone-200">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if ($item->status === 'Menunggu Verifikasi Transit')
                                            <form method="POST" action="{{ route('admin.items.approve', $item->id) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-paper bg-forest hover:bg-forest-soft transition duration-300 active:scale-95 cursor-pointer">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                    Setujui
                                                </button>
                                            </form>
                                            <button type="button"
                                                    onclick="openRejectModal({{ $item->id }}, '{{ e($item->nama_barang) }}')"
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-red-800 bg-red-50 hover:bg-red-100 border border-red-200 transition-colors cursor-pointer active:scale-95">
                                                Tolak
                                            </button>
                                        @elseif ($item->status === 'tersedia')
                                            <a href="{{ route('admin.distributions.create', ['item_id' => $item->id]) }}"
                                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-forest bg-cream hover:bg-stone-200/80 transition-colors">
                                                Salurkan
                                            </a>
                                        @endif
                                        <a href="{{ route('items.show', $item->id) }}"
                                           class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-warm border border-stone-200 bg-paper hover:text-ink hover:bg-cream transition-colors">
                                            Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($items->hasPages())
                <div class="p-4 border-t border-stone-200">
                    {{ $items->links() }}
                </div>
            @endif
        @endif
    </div>
</div>

{{-- ========== REJECT MODAL ========== --}}
<div id="reject-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-ink/40 backdrop-blur-xs" onclick="closeRejectModal()"></div>

    <form id="reject-form" method="POST" action=""
          class="relative bg-paper rounded-2xl border border-stone-200 shadow-[0_20px_50px_-15px_rgba(28,25,23,0.3)] w-full max-w-md mx-4 overflow-hidden">
        @csrf
        @method('PATCH')

        <div class="px-6 pt-6 pb-5">
            <h3 class="font-display text-2xl text-ink leading-tight">Tolak Barang Donasi</h3>
            <p class="text-xs text-warm mt-1">
                Barang <strong id="reject-item-name" class="text-ink"></strong> tidak akan ditayangkan di katalog.
            </p>

            <div class="mt-4">
                <label for="reject-alasan" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-1.5">
                    Alasan Penolakan (Opsional)
                </label>
                <textarea id="reject-alasan" name="alasan" rows="3" maxlength="500"
                          placeholder="Contoh: Kondisi barang kurang layak pakai atau foto belum jelas..."
                          class="w-full px-3.5 py-2.5 bg-white border border-stone-200 rounded-xl text-sm text-ink placeholder:text-stone-400 focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest resize-none"></textarea>
            </div>
        </div>

        <div class="px-6 py-4 bg-white border-t border-stone-200 flex justify-end gap-3">
            <button type="button" onclick="closeRejectModal()"
                    class="px-4 py-2 text-sm font-medium text-warm bg-paper border border-stone-200 hover:bg-cream rounded-xl transition-colors cursor-pointer">
                Batal
            </button>
            <button type="submit"
                    class="px-4 py-2 text-sm font-semibold text-white bg-red-700 hover:bg-red-800 rounded-xl transition-colors cursor-pointer active:scale-95">
                Tolak Barang
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function openRejectModal(itemId, itemName) {
        document.getElementById('reject-item-name').textContent = itemName;
        document.getElementById('reject-alasan').value = '';
        document.getElementById('reject-form').action = '{{ url("admin/items") }}/' + itemId + '/reject';
        document.getElementById('reject-modal').classList.remove('hidden');
    }
    function closeRejectModal() {
        document.getElementById('reject-modal').classList.add('hidden');
    }
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeRejectModal();
    });
</script>
@endpush
@endsection
