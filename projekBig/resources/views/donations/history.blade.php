@extends('layouts.app')

@section('title', 'Riwayat Donasi Saya')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Header Halaman --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Riwayat Donasi Saya</h1>
            <p class="text-sm text-slate-500 mt-1">
                Pantau jejak kebaikan dan status penyaluran barang pendidikan yang telah Anda donasikan.
            </p>
        </div>
        <a href="{{ route('items.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 text-white font-semibold text-sm shadow-md hover:bg-emerald-700 transition-all cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Posting Donasi Baru
        </a>
    </div>

    {{-- Filter Navigasi Tab & Dropdown Mobile --}}
    <div class="mb-6">
        {{-- Versi Desktop: Tabs Navigation --}}
        <div class="hidden sm:flex items-center gap-2 border-b border-slate-200 pb-3">
            @php
                $tabs = [
                    'semua' => ['label' => 'Semua', 'count' => $counts['semua']],
                    'menunggu' => ['label' => 'Menunggu', 'count' => $counts['menunggu']],
                    'diproses' => ['label' => 'Diproses', 'count' => $counts['diproses']],
                    'selesai' => ['label' => 'Selesai', 'count' => $counts['selesai']],
                ];
            @endphp

            @foreach ($tabs as $key => $tab)
                @php
                    $isActive = ($statusParam === $key) || ($key === 'semua' && !in_array($statusParam, ['menunggu', 'diproses', 'selesai']));
                @endphp
                <a href="{{ route('donor.my-donations', ['status' => $key]) }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all {{ $isActive ? 'bg-emerald-600 text-white shadow-sm shadow-emerald-600/20' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}">
                    <span>{{ $tab['label'] }}</span>
                    <span class="px-2 py-0.5 rounded-full text-[11px] font-bold {{ $isActive ? 'bg-white/20 text-white' : 'bg-slate-200 text-slate-700' }}">
                        {{ $tab['count'] }}
                    </span>
                </a>
            @endforeach
        </div>

        {{-- Versi Mobile: Dropdown Filter --}}
        <div class="sm:hidden">
            <label for="status-filter-select" class="block text-xs font-semibold text-slate-700 mb-1">Filter Status:</label>
            <select id="status-filter-select"
                    onchange="window.location.href = this.value;"
                    class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xl text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 shadow-sm">
                <option value="{{ route('donor.my-donations', ['status' => 'semua']) }}" {{ in_array($statusParam, ['semua', '']) ? 'selected' : '' }}>
                    Semua ({{ $counts['semua'] }})
                </option>
                <option value="{{ route('donor.my-donations', ['status' => 'menunggu']) }}" {{ $statusParam === 'menunggu' ? 'selected' : '' }}>
                    Menunggu ({{ $counts['menunggu'] }})
                </option>
                <option value="{{ route('donor.my-donations', ['status' => 'diproses']) }}" {{ $statusParam === 'diproses' ? 'selected' : '' }}>
                    Diproses ({{ $counts['diproses'] }})
                </option>
                <option value="{{ route('donor.my-donations', ['status' => 'selesai']) }}" {{ $statusParam === 'selesai' ? 'selected' : '' }}>
                    Selesai ({{ $counts['selesai'] }})
                </option>
            </select>
        </div>
    </div>

    {{-- Konten Utama --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        @if ($counts['semua'] === 0)
            {{-- ===================== GLOBAL EMPTY STATE ===================== --}}
            <div class="p-12 sm:p-16 text-center">
                <div class="w-20 h-20 rounded-2xl bg-emerald-50 text-emerald-500 mx-auto flex items-center justify-center mb-5 shadow-inner">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-slate-800">Belum Ada Riwayat Donasi</h2>
                <p class="text-sm text-slate-500 max-w-md mx-auto mt-2 leading-relaxed">
                    Anda belum pernah memposting barang donasi. Mulai langkah pertama Anda untuk membantu pemerataan pendidikan bagi adik-adik yang membutuhkan.
                </p>
                <a href="{{ route('items.create') }}"
                   class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-xl shadow-lg shadow-emerald-600/20 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Mulai Donasi Sekarang
                </a>
            </div>

        @elseif ($donations->isEmpty())
            {{-- ===================== FILTER EMPTY STATE ===================== --}}
            <div class="p-12 sm:p-14 text-center">
                <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-500 mx-auto flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-slate-800">Tidak Ada Donasi dengan Status "{{ ucfirst($statusParam) }}"</h2>
                <p class="text-sm text-slate-500 max-w-sm mx-auto mt-1 mb-5 leading-relaxed">
                    Saat ini tidak ada barang donasi Anda yang berada dalam kategori status ini.
                </p>
                <a href="{{ route('donor.my-donations', ['status' => 'semua']) }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition-all">
                    Lihat Semua Riwayat Donasi
                </a>
            </div>

        @else
            {{-- =================== TABEL RIWAYAT DONASI =================== --}}
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Daftar Riwayat
                        @if ($statusParam !== 'semua' && in_array($statusParam, ['menunggu', 'diproses', 'selesai']))
                            <span class="text-emerald-600 font-medium">({{ ucfirst($statusParam) }})</span>
                        @endif
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Menampilkan {{ $donations->total() }} barang donasi terurut berdasarkan tanggal terbaru.
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-[11px] font-bold tracking-wider border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4">Nama Barang</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Tanggal Donasi</th>
                            <th class="px-6 py-4">Status Penyaluran</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($donations as $item)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                {{-- Nama Barang + Thumbnail --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($item->foto)
                                            <img src="{{ $item->foto_url }}" alt="{{ $item->nama_barang }}"
                                                 class="w-10 h-10 rounded-lg object-cover border border-slate-200">
                                        @else
                                            <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <span class="font-bold text-slate-900">{{ $item->nama_barang }}</span>
                                    </div>
                                </td>

                                {{-- Kategori --}}
                                <td class="px-6 py-4 text-xs">{{ $item->kategori }}</td>

                                {{-- Tanggal Donasi --}}
                                <td class="px-6 py-4 text-slate-500">
                                    {{ $item->created_at->format('d M Y, H:i') }}
                                </td>

                                {{-- Status Penyaluran (Badge Berwarna) --}}
                                <td class="px-6 py-4">
                                    @php
                                        $normalizedStatus = strtolower($item->status);
                                    @endphp

                                    @if (str_contains($normalizedStatus, 'menunggu'))
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Menunggu Verifikasi
                                        </span>
                                    @elseif (str_contains($normalizedStatus, 'diproses') || str_contains($normalizedStatus, 'tersedia'))
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                            Diproses / Siap
                                        </span>
                                    @elseif (str_contains($normalizedStatus, 'disalurkan') || str_contains($normalizedStatus, 'selesai'))
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Selesai Disalurkan
                                        </span>
                                    @else
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('donor.my-donations.show', $item->id) }}"
                                       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-emerald-50 hover:bg-emerald-600 text-xs font-semibold text-emerald-700 hover:text-white transition-all">
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

            {{-- Pagination Links dengan Query String Filter Tetap Terjaga --}}
            @if ($donations->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $donations->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
