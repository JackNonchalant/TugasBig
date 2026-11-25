@extends('layouts.admin')
@section('page-title', 'Detail Penyaluran')

@section('title', 'Detail Penyaluran #' . $distribution->id)

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs text-warm mb-6">
        <a href="{{ route('admin.distributions.index') }}" class="hover:text-forest transition-colors">Penyaluran</a>
        <span>/</span>
        <span class="text-ink font-semibold">Detail #{{ $distribution->id }}</span>
    </div>

    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4 pb-6 border-b border-stone-200 mb-8 rise">
        <div>
            <p class="flex items-center gap-3 text-[11px] font-semibold uppercase tracking-[.18em] text-ochre mb-2">
                <span class="h-px w-8 bg-ochre"></span>
                Transaksi #{{ $distribution->id }}
            </p>
            <h1 class="font-display text-3xl sm:text-4xl tracking-tight text-ink">
                {{ $distribution->donationItem->nama_barang }}
            </h1>
            <p class="text-xs text-warm mt-1.5">Dibuat: {{ $distribution->created_at->format('d M Y, H:i') }} WIB</p>
        </div>
        <div class="flex items-center gap-3">
            @if ($distribution->status !== 'Disalurkan')
                <a href="{{ route('admin.distributions.edit-status', $distribution->id) }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-forest text-paper text-sm font-semibold hover:bg-forest-soft transition duration-300 active:scale-95">
                    Perbarui Status
                </a>
            @endif
            <a href="{{ route('admin.distributions.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-stone-200 bg-white text-sm font-semibold text-warm hover:text-ink hover:bg-cream transition-colors">
                ← Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Info Utama -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Info Transaksi -->
            <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
                <div class="p-6 border-b border-stone-200">
                    <h2 class="font-display text-2xl text-ink">Informasi Penyaluran</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <div class="text-[11px] font-semibold text-warm uppercase tracking-[.12em] mb-1.5">Status Saat Ini</div>
                            @if ($distribution->status === 'Menunggu Penyaluran')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-ochre animate-pulse"></span>
                                    Menunggu Penyaluran
                                </span>
                            @elseif ($distribution->status === 'Dalam Proses Penyaluran')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-xs font-semibold bg-sky-50 text-sky-900 border border-sky-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-sky-600 animate-pulse"></span>
                                    Dalam Proses Penyaluran
                                </span>
                            @elseif ($distribution->status === 'Disalurkan')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-xs font-semibold bg-emerald-50 text-forest border border-forest/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-forest"></span>
                                    Disalurkan
                                </span>
                            @endif
                        </div>
                        <div>
                            <div class="text-[11px] font-semibold text-warm uppercase tracking-[.12em] mb-1.5">No. Resi Transit</div>
                            <div class="text-sm font-mono text-ink">{{ $distribution->nomor_resi ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-[11px] font-semibold text-warm uppercase tracking-[.12em] mb-1.5">Petugas Pemroses</div>
                            <div class="text-sm font-semibold text-ink">{{ $distribution->processor->name ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-[11px] font-semibold text-warm uppercase tracking-[.12em] mb-1.5">Waktu Serah Terima</div>
                            <div class="text-sm text-ink">{{ $distribution->distributed_at ? $distribution->distributed_at->format('d M Y, H:i') . ' WIB' : 'Belum diserahkan' }}</div>
                        </div>
                    </div>

                    @if ($distribution->catatan)
                        <div class="pt-4 border-t border-stone-200">
                            <div class="text-[11px] font-semibold text-warm uppercase tracking-[.12em] mb-1.5">Catatan</div>
                            <div class="text-sm text-ink bg-paper border border-stone-200 rounded-xl p-4">{{ $distribution->catatan }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Info Barang Donasi -->
            <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
                <div class="p-6 border-b border-stone-200">
                    <h2 class="font-display text-2xl text-ink">Barang Donasi</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-start gap-4">
                        @if ($distribution->donationItem->foto)
                            <img src="{{ $distribution->donationItem->foto_url }}" alt="{{ $distribution->donationItem->nama_barang }}"
                                 class="w-20 h-20 rounded-xl object-cover border border-stone-200 shrink-0">
                        @else
                            <div class="w-20 h-20 rounded-xl bg-cream flex items-center justify-center text-stone-400 border border-stone-200 shrink-0">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1 space-y-2">
                            <h3 class="font-display text-2xl text-ink leading-tight">{{ $distribution->donationItem->nama_barang }}</h3>
                            <div class="flex flex-wrap gap-2 text-xs">
                                <span class="px-2.5 py-0.5 rounded-md bg-paper border border-stone-200 text-warm font-semibold">{{ $distribution->donationItem->kategori }}</span>
                                <span class="px-2.5 py-0.5 rounded-md bg-paper border border-stone-200 text-warm font-semibold">{{ $distribution->donationItem->kondisi }}</span>
                                <span class="px-2.5 py-0.5 rounded-md bg-cream border border-stone-200 text-forest font-semibold">Jumlah: {{ $distribution->donationItem->jumlah }}</span>
                            </div>
                            <p class="text-sm text-warm">{{ $distribution->donationItem->deskripsi }}</p>
                            <div class="text-xs text-stone-400">
                                Donatur: <strong class="text-ink">{{ $distribution->donationItem->donor->name ?? '-' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bukti Foto Serah Terima -->
            <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
                <div class="p-6 border-b border-stone-200 flex items-center justify-between">
                    <div>
                        <h2 class="font-display text-2xl text-ink">Bukti Foto Serah Terima</h2>
                        <p class="text-xs text-warm mt-0.5">Dokumentasi fisik penyaluran barang donasi</p>
                    </div>
                    <span class="text-xs font-semibold text-warm bg-paper px-3 py-1.5 rounded-lg border border-stone-200">
                        {{ $distribution->proofs->count() }} Foto
                    </span>
                </div>
                <div class="p-6">
                    @if ($distribution->proofs->isEmpty())
                        <div class="text-center py-8 border border-dashed border-stone-200 rounded-xl bg-paper">
                            <p class="text-sm text-warm">Belum ada bukti foto yang diunggah.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach ($distribution->proofs as $proof)
                                <div class="relative group rounded-xl overflow-hidden border border-stone-200">
                                    <img src="{{ $proof->foto_url }}" alt="Bukti Serah Terima"
                                         class="w-full h-48 object-cover cursor-pointer transition-transform duration-700 ease-out group-hover:scale-105"
                                         onclick="openImageModal('{{ $proof->foto_url }}')">
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-ink/80 to-transparent px-3 py-2">
                                        <div class="text-[10px] text-paper/90 truncate">{{ $proof->original_name }}</div>
                                        <div class="text-[10px] text-paper/70">{{ $proof->created_at->format('d M Y, H:i') }} — {{ $proof->uploader->name ?? '-' }}</div>
                                    </div>
                                    <form method="POST" action="{{ route('admin.distributions.delete-proof', [$distribution->id, $proof->id]) }}"
                                          class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity"
                                          onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg bg-red-700 text-white hover:bg-red-800 transition-colors cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Upload Foto Tambahan -->
                    <div class="mt-6 pt-6 border-t border-stone-200">
                        <h3 class="text-sm font-semibold text-ink mb-3">Unggah Foto Bukti Baru</h3>
                        <form method="POST" action="{{ route('admin.distributions.upload-proof', $distribution->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-col sm:flex-row gap-3">
                                <div class="flex-1">
                                    <input type="file" name="bukti_foto" accept="image/jpeg,image/jpg,image/png"
                                           class="w-full px-4 py-2 bg-paper rounded-xl border border-stone-200 text-sm text-warm file:mr-3 file:px-3 file:py-1 file:rounded-lg file:border-0 file:bg-cream file:text-forest file:font-semibold file:text-xs"
                                           id="proofFileInput" onchange="previewProofImage(event)">
                                    <p class="text-[11px] text-stone-400 mt-1">Format: JPG, JPEG, PNG. Maks: 2MB</p>
                                    @error('bukti_foto')
                                        <p class="text-xs text-red-700 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="px-5 py-2.5 rounded-xl bg-forest text-paper text-sm font-semibold hover:bg-forest-soft transition duration-300 active:scale-95 self-start cursor-pointer">
                                    Unggah
                                </button>
                            </div>
                            <div id="proofPreview" class="mt-3 hidden">
                                <img id="proofPreviewImg" src="" alt="Preview" class="h-32 rounded-xl border border-stone-200 object-cover">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Histori Perubahan Status -->
            <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
                <div class="p-6 border-b border-stone-200">
                    <h2 class="font-display text-2xl text-ink">Histori Perubahan Status</h2>
                    <p class="text-xs text-warm mt-0.5">Rekam jejak kronologis seluruh perubahan status penyaluran</p>
                </div>
                <div class="p-6">
                    @if ($distribution->statusHistories->isEmpty())
                        <p class="text-sm text-warm text-center py-4">Belum ada histori perubahan status.</p>
                    @else
                        <div class="relative">
                            <div class="absolute left-[18px] top-0 bottom-0 w-px bg-stone-200"></div>

                            <div class="space-y-5">
                                @foreach ($distribution->statusHistories as $history)
                                    <div class="relative flex gap-4 pl-2">
                                        <div class="relative z-10 mt-1.5">
                                            @if ($history->status_after === 'Disalurkan')
                                                <div class="w-[18px] h-[18px] rounded-full bg-forest border-2 border-white flex items-center justify-center">
                                                    <svg class="w-2.5 h-2.5 text-paper" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                            @elseif ($history->status_after === 'Dalam Proses Penyaluran')
                                                <div class="w-[18px] h-[18px] rounded-full bg-sky-600 border-2 border-white"></div>
                                            @else
                                                <div class="w-[18px] h-[18px] rounded-full bg-ochre border-2 border-white"></div>
                                            @endif
                                        </div>

                                        <div class="flex-1 bg-paper border border-stone-200 rounded-xl p-4 -mt-0.5">
                                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 mb-2">
                                                <div class="flex items-center gap-2">
                                                    @if ($history->status_before)
                                                        <span class="text-xs font-medium text-warm">{{ $history->status_before }}</span>
                                                        <span class="text-stone-400">→</span>
                                                    @endif
                                                    <span class="text-xs font-semibold
                                                        {{ $history->status_after === 'Disalurkan' ? 'text-forest' :
                                                           ($history->status_after === 'Dalam Proses Penyaluran' ? 'text-sky-900' : 'text-ochre') }}">
                                                        {{ $history->status_after }}
                                                    </span>
                                                </div>
                                                <div class="text-[11px] text-stone-400">
                                                    {{ $history->created_at->format('d M Y, H:i:s') }} WIB
                                                </div>
                                            </div>

                                            <div class="text-xs text-warm">
                                                Oleh: <strong class="text-ink">{{ $history->changedByUser->name ?? '-' }}</strong>
                                            </div>

                                            @if ($history->catatan)
                                                <div class="mt-2 text-xs text-ink bg-white rounded-lg p-2.5 border border-stone-200">
                                                    {{ $history->catatan }}
                                                </div>
                                            @endif

                                            @if ($history->nomor_resi)
                                                <div class="mt-1.5 text-xs text-warm">
                                                    No. Resi: <span class="font-mono font-semibold text-ink">{{ $history->nomor_resi }}</span>
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

        <!-- Right Column -->
        <div class="space-y-6">
            <!-- Penerima Manfaat -->
            <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
                <div class="p-5 border-b border-stone-200">
                    <h2 class="font-display text-xl text-ink">Penerima Manfaat</h2>
                </div>
                <div class="p-5">
                    @if ($distribution->beneficiary)
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-full bg-cream border border-stone-200 flex items-center justify-center text-ochre font-bold text-base shrink-0">
                                {{ strtoupper(substr($distribution->beneficiary->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <div class="text-sm font-semibold text-ink truncate">{{ $distribution->beneficiary->name }}</div>
                                <div class="text-xs text-warm truncate">{{ $distribution->beneficiary->email }}</div>
                                <span class="inline-block mt-1 px-2 py-0.5 rounded-md text-[10px] font-semibold bg-cream border border-stone-200 text-ochre">Penerima Manfaat</span>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-sm text-stone-400 italic">Penerima belum ditentukan</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Status Progress -->
            <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
                <div class="p-5 border-b border-stone-200">
                    <h2 class="font-display text-xl text-ink">Progres Penyaluran</h2>
                </div>
                <div class="p-5 space-y-3">
                    @php
                        $steps = ['Menunggu Penyaluran', 'Dalam Proses Penyaluran', 'Disalurkan'];
                        $currentIndex = array_search($distribution->status, $steps);
                    @endphp
                    @foreach ($steps as $i => $step)
                        <div class="flex items-center gap-3">
                            @if ($i <= $currentIndex)
                                <div class="w-7 h-7 rounded-full bg-forest flex items-center justify-center text-paper shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-forest">{{ $step }}</span>
                            @else
                                <div class="w-7 h-7 rounded-full bg-paper border border-stone-300 flex items-center justify-center text-stone-400 shrink-0">
                                    <span class="text-xs font-semibold">{{ $i + 1 }}</span>
                                </div>
                                <span class="text-sm text-stone-400">{{ $step }}</span>
                            @endif
                        </div>
                        @if ($i < count($steps) - 1)
                            <div class="ml-3.5 w-px h-4 {{ $i < $currentIndex ? 'bg-forest/40' : 'bg-stone-200' }}"></div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Donatur Info -->
            <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
                <div class="p-5 border-b border-stone-200">
                    <h2 class="font-display text-xl text-ink">Donatur</h2>
                </div>
                <div class="p-5">
                    @if ($distribution->donationItem->donor)
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-full bg-forest flex items-center justify-center text-paper font-bold text-base shrink-0">
                                {{ strtoupper(substr($distribution->donationItem->donor->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <div class="text-sm font-semibold text-ink truncate">{{ $distribution->donationItem->donor->name }}</div>
                                <div class="text-xs text-warm truncate">{{ $distribution->donationItem->donor->email }}</div>
                                <span class="inline-block mt-1 px-2 py-0.5 rounded-md text-[10px] font-semibold bg-emerald-50 border border-forest/20 text-forest">Donatur</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="hidden fixed inset-0 z-50 bg-ink/80 backdrop-blur-xs flex items-center justify-center p-4" onclick="closeImageModal()">
    <img id="modalImage" src="" alt="Preview" class="max-w-full max-h-[90vh] rounded-2xl border border-stone-200">
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
