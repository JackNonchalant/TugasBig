@extends('layouts.app')

@section('title', 'Detail Riwayat Donasi #' . $donation->id)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Bar Navigasi Atas: Tombol Kembali & Indikator Status Hak Akses --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('donor.my-donations') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 font-semibold text-sm hover:bg-slate-100 shadow-sm transition-all self-start">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Riwayat Donasi
        </a>

        @if ($authStatus === 'owner')
            <span class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold self-start sm:self-auto">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                Akses Valid: Pemilik Transaksi ({{ $donation->donor->name }})
            </span>
        @else
            <span class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-blue-50 text-blue-700 border border-blue-200 text-xs font-bold self-start sm:self-auto">
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                Akses Valid: Pihak Berwenang (Admin)
            </span>
        @endif
    </div>

    {{-- Card Ringkasan Donasi --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 pb-6 border-b border-slate-100">
            <div>
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider">
                    #DON-{{ str_pad((string) $donation->id, 4, '0', STR_PAD_LEFT) }}
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">{{ $donation->nama_barang }}</h1>
                <p class="text-xs text-slate-500 mt-1">
                    Didonasikan pada {{ $donation->created_at->format('d M Y, H:i') }} WIB
                </p>
            </div>

            @php
                $normalizedStatus = strtolower($donation->status);
            @endphp
            @if (str_contains($normalizedStatus, 'menunggu'))
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 self-start">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    Menunggu Verifikasi
                </span>
            @elseif (str_contains($normalizedStatus, 'diproses') || str_contains($normalizedStatus, 'tersedia'))
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200 self-start">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Diproses / Siap Disalurkan
                </span>
            @elseif (str_contains($normalizedStatus, 'disalurkan') || str_contains($normalizedStatus, 'selesai'))
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 self-start">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Selesai Disalurkan
                </span>
            @else
                <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200 self-start">
                    {{ ucfirst($donation->status) }}
                </span>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 py-6 border-b border-slate-100">
            <div>
                <div class="text-xs text-slate-400">Kategori</div>
                <div class="font-semibold text-slate-800 text-sm mt-0.5">{{ $donation->kategori }}</div>
            </div>
            <div>
                <div class="text-xs text-slate-400">Kondisi Barang</div>
                <div class="font-semibold text-slate-800 text-sm mt-0.5">{{ $donation->kondisi }}</div>
            </div>
            <div>
                <div class="text-xs text-slate-400">Jumlah Unit</div>
                <div class="font-semibold text-slate-800 text-sm mt-0.5">{{ $donation->jumlah }} Unit</div>
            </div>
            <div>
                <div class="text-xs text-slate-400">Nama Donatur</div>
                <div class="font-semibold text-slate-800 text-sm mt-0.5">{{ $donation->donor->name }}</div>
            </div>
        </div>

        <div class="pt-6 flex flex-col md:flex-row gap-6 items-start">
            @if ($donation->foto)
                <img src="{{ $donation->foto_url }}" alt="{{ $donation->nama_barang }}"
                     class="w-full md:w-44 h-44 rounded-2xl object-cover border border-slate-200 shrink-0">
            @endif
            <div class="flex-1">
                <div class="text-xs text-slate-400 font-medium mb-1">Deskripsi Barang Donasi</div>
                <p class="text-sm text-slate-700 leading-relaxed">{{ $donation->deskripsi }}</p>
            </div>
        </div>
    </div>

    {{-- Grid 2 Kolom: Data Penerima Manfaat & Bukti Penerimaan --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Kolom 1: Data Penerima Manfaat --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <h2 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </span>
                Data Penerima Manfaat
            </h2>

            @if ($donation->recipient_name)
                <div class="space-y-3 text-sm">
                    <div>
                        <div class="text-xs text-slate-400 font-medium">Lembaga / Penerima</div>
                        <div class="font-bold text-slate-900 mt-0.5">{{ $donation->recipient_name }}</div>
                    </div>
                    @if ($donation->recipient_contact)
                        <div>
                            <div class="text-xs text-slate-400 font-medium">Penanggung Jawab / Kontak</div>
                            <div class="font-medium text-slate-700 mt-0.5">{{ $donation->recipient_contact }}</div>
                        </div>
                    @endif
                    @if ($donation->recipient_address)
                        <div>
                            <div class="text-xs text-slate-400 font-medium">Alamat Penyaluran</div>
                            <div class="text-slate-600 mt-0.5">{{ $donation->recipient_address }}</div>
                        </div>
                    @endif
                    @if ($donation->received_at)
                        <div>
                            <div class="text-xs text-slate-400 font-medium">Tanggal Diterima</div>
                            <div class="font-semibold text-emerald-700 mt-0.5">{{ $donation->received_at->format('d M Y, H:i') }} WIB</div>
                        </div>
                    @endif
                    @if ($donation->distribution_notes)
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs text-slate-600">
                            <strong>Catatan:</strong> {{ $donation->distribution_notes }}
                        </div>
                    @endif
                </div>
            @else
                <div class="p-6 rounded-xl bg-amber-50/70 border border-dashed border-amber-200 text-center">
                    <p class="text-sm font-semibold text-amber-800">Penerima Manfaat Belum Ditentukan</p>
                    <p class="text-xs text-amber-700 mt-1 leading-relaxed">
                        Data penerima manfaat akan tampil setelah barang dialokasikan oleh tim verifikasi logistik.
                    </p>
                </div>
            @endif
        </div>

        {{-- Kolom 2: Bukti Penerimaan & Dokumen Serah Terima --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <h2 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                Bukti Penerimaan &amp; Serah Terima
            </h2>

            @if ($donation->receipt_photo || $donation->receipt_document)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @if ($donation->receipt_photo)
                        <div class="border border-slate-200 rounded-2xl p-4 bg-slate-50 flex flex-col justify-between">
                            @php
                                $photoUrl = str_starts_with($donation->receipt_photo, 'http')
                                    ? $donation->receipt_photo
                                    : asset('storage/' . $donation->receipt_photo);
                            @endphp
                            <img src="{{ $photoUrl }}" alt="Bukti Foto Serah Terima"
                                 class="aspect-video w-full rounded-xl object-cover border border-slate-200 mb-3 bg-white">
                            <div class="flex items-center justify-between gap-2">
                                <span class="text-xs font-semibold text-slate-700">Foto Serah Terima</span>
                                <a href="{{ $photoUrl }}" target="_blank" rel="noopener noreferrer"
                                   class="px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold">
                                    Buka Foto
                                </a>
                            </div>
                        </div>
                    @endif

                    @if ($donation->receipt_document)
                        <div class="border border-slate-200 rounded-2xl p-4 bg-slate-50 flex flex-col justify-between">
                            @php
                                $docUrl = str_starts_with($donation->receipt_document, 'http')
                                    ? $donation->receipt_document
                                    : asset('storage/' . $donation->receipt_document);
                            @endphp
                            <div class="aspect-video rounded-xl bg-white border border-slate-200 flex flex-col items-center justify-center text-slate-600 mb-3 p-4 text-center">
                                <svg class="w-10 h-10 text-blue-600 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-xs font-bold text-slate-800">Dokumen Serah Terima (BAST)</span>
                                <span class="text-[11px] text-slate-400 mt-0.5 truncate max-w-full">{{ basename($donation->receipt_document) }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-2">
                                <span class="text-xs font-semibold text-slate-700">Dokumen BAST</span>
                                <a href="{{ $docUrl }}" target="_blank" rel="noopener noreferrer"
                                   class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-900 text-white text-xs font-semibold">
                                    Lihat Dokumen
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="p-8 rounded-xl bg-slate-50 border border-dashed border-slate-200 text-center">
                    <p class="text-sm font-semibold text-slate-700">Bukti Penerimaan Belum Tersedia</p>
                    <p class="text-xs text-slate-500 mt-1 max-w-md mx-auto leading-relaxed">
                        Foto dokumentasi serah terima dan dokumen berita acara (BAST) akan tersedia setelah proses penyerahan barang kepada penerima manfaat selesai dilakukan.
                    </p>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
