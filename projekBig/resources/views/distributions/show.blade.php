@extends('layouts.admin')
@section('page-title', 'Detail Penyaluran')

@section('title', 'Detail Penyaluran #' . $distribution->id)

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs text-slate-500 mb-6">
        <a href="{{ route('admin.distributions.index') }}" class="hover:text-emerald-600 transition-colors">Penyaluran</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-slate-800 font-semibold">Detail #{{ $distribution->id }}</span>
    </div>

    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                Detail Penyaluran — {{ $distribution->donationItem->nama_barang }}
            </h1>
            <p class="text-xs text-slate-500 mt-1">ID Transaksi: #{{ $distribution->id }} &bull; Dibuat: {{ $distribution->created_at->format('d M Y, H:i') }} WIB</p>
        </div>
        <div class="flex items-center gap-3">
            @if ($distribution->status !== 'Disalurkan')
                <a href="{{ route('admin.distributions.edit-status', $distribution->id) }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 shadow-sm transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Perbarui Status
                </a>
            @endif
            <a href="{{ route('admin.distributions.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
                ← Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Info Utama -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Info Transaksi -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h2 class="text-lg font-bold text-slate-900">Informasi Penyaluran</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <div class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Status Saat Ini</div>
                            @if ($distribution->status === 'Menunggu Penyaluran')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-semibold bg-amber-50 text-amber-800 border border-amber-300">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                    Menunggu Penyaluran
                                </span>
                            @elseif ($distribution->status === 'Dalam Proses Penyaluran')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-semibold bg-blue-50 text-blue-800 border border-blue-300">
                                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                                    Dalam Proses Penyaluran
                                </span>
                            @elseif ($distribution->status === 'Disalurkan')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-semibold bg-emerald-50 text-emerald-700 border border-emerald-300">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    Disalurkan
                                </span>
                            @endif
                        </div>
                        <div>
                            <div class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">No. Resi Transit</div>
                            <div class="text-sm font-mono text-slate-800">{{ $distribution->nomor_resi ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Petugas Pemroses</div>
                            <div class="text-sm font-semibold text-slate-800">{{ $distribution->processor->name ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Waktu Serah Terima</div>
                            <div class="text-sm text-slate-800">{{ $distribution->distributed_at ? $distribution->distributed_at->format('d M Y, H:i') . ' WIB' : 'Belum diserahkan' }}</div>
                        </div>
                    </div>

                    @if ($distribution->catatan)
                        <div class="pt-4 border-t border-slate-100">
                            <div class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Catatan</div>
                            <div class="text-sm text-slate-700 bg-slate-50 rounded-xl p-4">{{ $distribution->catatan }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Info Barang Donasi -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h2 class="text-lg font-bold text-slate-900">Barang Donasi</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-start gap-4">
                        @if ($distribution->donationItem->foto)
                            <img src="{{ $distribution->donationItem->foto_url }}" alt="{{ $distribution->donationItem->nama_barang }}"
                                 class="w-20 h-20 rounded-xl object-cover border border-slate-200 shrink-0">
                        @else
                            <div class="w-20 h-20 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200 shrink-0">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1 space-y-2">
                            <h3 class="text-lg font-bold text-slate-900">{{ $distribution->donationItem->nama_barang }}</h3>
                            <div class="flex flex-wrap gap-2 text-xs">
                                <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 font-semibold">{{ $distribution->donationItem->kategori }}</span>
                                <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 font-semibold">{{ $distribution->donationItem->kondisi }}</span>
                                <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 font-semibold">Jumlah: {{ $distribution->donationItem->jumlah }}</span>
                            </div>
                            <p class="text-sm text-slate-600">{{ $distribution->donationItem->deskripsi }}</p>
                            <div class="text-xs text-slate-400">
                                Donatur: <strong>{{ $distribution->donationItem->donor->name ?? '-' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PBI-014: Bukti Foto Serah Terima -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Bukti Foto Serah Terima</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Dokumentasi fisik penyaluran barang donasi</p>
                    </div>
                    <span class="text-xs font-semibold text-slate-500 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-200">
                        {{ $distribution->proofs->count() }} Foto
                    </span>
                </div>
                <div class="p-6">
                    @if ($distribution->proofs->isEmpty())
                        <div class="text-center py-8">
                            <svg class="w-10 h-10 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm text-slate-400">Belum ada bukti foto yang diunggah.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach ($distribution->proofs as $proof)
                                <div class="relative group">
                                    <img src="{{ $proof->foto_url }}" alt="Bukti Serah Terima"
                                         class="w-full h-48 object-cover rounded-xl border border-slate-200 cursor-pointer hover:opacity-90 transition-opacity"
                                         onclick="openImageModal('{{ $proof->foto_url }}')">
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent rounded-b-xl px-3 py-2">
                                        <div class="text-[10px] text-white/80">{{ $proof->original_name }}</div>
                                        <div class="text-[10px] text-white/60">{{ $proof->created_at->format('d M Y, H:i') }} — {{ $proof->uploader->name ?? '-' }}</div>
                                    </div>
                                    <form method="POST" action="{{ route('admin.distributions.delete-proof', [$distribution->id, $proof->id]) }}"
                                          class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity"
                                          onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors shadow-lg">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Upload Foto Tambahan -->
                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800 mb-3">Unggah Foto Bukti Baru</h3>
                        <form method="POST" action="{{ route('admin.distributions.upload-proof', $distribution->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-col sm:flex-row gap-3">
                                <div class="flex-1">
                                    <input type="file" name="bukti_foto" accept="image/jpeg,image/jpg,image/png"
                                           class="w-full px-4 py-2 rounded-xl border border-slate-200 text-sm file:mr-3 file:px-3 file:py-1 file:rounded-lg file:border-0 file:bg-emerald-50 file:text-emerald-700 file:font-semibold file:text-xs"
                                           id="proofFileInput" onchange="previewProofImage(event)">
                                    <p class="text-[11px] text-slate-400 mt-1">Format: JPG, JPEG, PNG. Maks: 2MB</p>
                                    @error('bukti_foto')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition-colors self-start">
                                    Unggah
                                </button>
                            </div>
                            <!-- Preview -->
                            <div id="proofPreview" class="mt-3 hidden">
                                <img id="proofPreviewImg" src="" alt="Preview" class="h-32 rounded-xl border border-slate-200 object-cover">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- PBI-015: Histori Perubahan Status -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h2 class="text-lg font-bold text-slate-900">Histori Perubahan Status</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Rekam jejak kronologis seluruh perubahan status penyaluran (read-only)</p>
                </div>
                <div class="p-6">
                    @if ($distribution->statusHistories->isEmpty())
                        <p class="text-sm text-slate-400 text-center py-4">Belum ada histori perubahan status.</p>
                    @else
                        <div class="relative">
                            <!-- Timeline line -->
                            <div class="absolute left-[18px] top-0 bottom-0 w-0.5 bg-slate-200"></div>

                            <div class="space-y-6">
                                @foreach ($distribution->statusHistories as $history)
                                    <div class="relative flex gap-4 pl-2">
                                        <!-- Timeline dot -->
                                        <div class="relative z-10 mt-1">
                                            @if ($history->status_after === 'Disalurkan')
                                                <div class="w-[18px] h-[18px] rounded-full bg-emerald-500 border-2 border-white shadow flex items-center justify-center">
                                                    <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                            @elseif ($history->status_after === 'Dalam Proses Penyaluran')
                                                <div class="w-[18px] h-[18px] rounded-full bg-blue-500 border-2 border-white shadow"></div>
                                            @else
                                                <div class="w-[18px] h-[18px] rounded-full bg-amber-400 border-2 border-white shadow"></div>
                                            @endif
                                        </div>

                                        <!-- Content -->
                                        <div class="flex-1 bg-slate-50 rounded-xl p-4 -mt-0.5">
                                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 mb-2">
                                                <div class="flex items-center gap-2">
                                                    @if ($history->status_before)
                                                        <span class="text-xs font-semibold text-slate-500">{{ $history->status_before }}</span>
                                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                                        </svg>
                                                    @endif
                                                    <span class="text-xs font-bold
                                                        {{ $history->status_after === 'Disalurkan' ? 'text-emerald-700' :
                                                           ($history->status_after === 'Dalam Proses Penyaluran' ? 'text-blue-700' : 'text-amber-700') }}">
                                                        {{ $history->status_after }}
                                                    </span>
                                                </div>
                                                <div class="text-[11px] text-slate-400">
                                                    {{ $history->created_at->format('d M Y, H:i:s') }} WIB
                                                </div>
                                            </div>

                                            <div class="text-xs text-slate-600">
                                                Oleh: <strong>{{ $history->changedByUser->name ?? '-' }}</strong>
                                            </div>

                                            @if ($history->catatan)
                                                <div class="mt-2 text-xs text-slate-600 bg-white rounded-lg p-2 border border-slate-100">
                                                    {{ $history->catatan }}
                                                </div>
                                            @endif

                                            @if ($history->nomor_resi)
                                                <div class="mt-1 text-xs text-slate-500">
                                                    No. Resi: <span class="font-mono font-semibold">{{ $history->nomor_resi }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Info Penerima -->
        <div class="space-y-6">
            <!-- Penerima Manfaat -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h2 class="font-bold text-slate-900">Penerima Manfaat</h2>
                </div>
                <div class="p-6">
                    @if ($distribution->beneficiary)
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-lg shrink-0">
                                {{ strtoupper(substr($distribution->beneficiary->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="text-sm font-bold text-slate-900">{{ $distribution->beneficiary->name }}</div>
                                <div class="text-xs text-slate-500">{{ $distribution->beneficiary->email }}</div>
                                <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-blue-100 text-blue-800">Penerima Manfaat</span>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-sm text-slate-400 italic">Penerima belum ditentukan</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Status Progress -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h2 class="font-bold text-slate-900">Progres Penyaluran</h2>
                </div>
                <div class="p-6 space-y-4">
                    @php
                        $steps = ['Menunggu Penyaluran', 'Dalam Proses Penyaluran', 'Disalurkan'];
                        $currentIndex = array_search($distribution->status, $steps);
                    @endphp
                    @foreach ($steps as $i => $step)
                        <div class="flex items-center gap-3">
                            @if ($i <= $currentIndex)
                                <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-emerald-700">{{ $step }}</span>
                            @else
                                <div class="w-8 h-8 rounded-full bg-slate-100 border-2 border-slate-200 flex items-center justify-center text-slate-400 shrink-0">
                                    <span class="text-xs font-bold">{{ $i + 1 }}</span>
                                </div>
                                <span class="text-sm text-slate-400">{{ $step }}</span>
                            @endif
                        </div>
                        @if ($i < count($steps) - 1)
                            <div class="ml-4 w-0.5 h-4 {{ $i < $currentIndex ? 'bg-emerald-300' : 'bg-slate-200' }}"></div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Donatur Info -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h2 class="font-bold text-slate-900">Donatur</h2>
                </div>
                <div class="p-6">
                    @if ($distribution->donationItem->donor)
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 font-bold text-lg shrink-0">
                                {{ strtoupper(substr($distribution->donationItem->donor->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="text-sm font-bold text-slate-900">{{ $distribution->donationItem->donor->name }}</div>
                                <div class="text-xs text-slate-500">{{ $distribution->donationItem->donor->email }}</div>
                                <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800">Donatur</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="hidden fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4" onclick="closeImageModal()">
    <img id="modalImage" src="" alt="Preview" class="max-w-full max-h-[90vh] rounded-2xl shadow-2xl">
</div>

@push('scripts')
<script>
    function openImageModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
    }
    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }
    function previewProofImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('proofPreviewImg').src = e.target.result;
                document.getElementById('proofPreview').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeImageModal();
    });
</script>
@endpush
@endsection
