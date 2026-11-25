@extends('layouts.admin')
@section('page-title', 'Update Status Penyaluran')

@section('title', 'Perbarui Status Penyaluran')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs text-warm mb-6">
        <a href="{{ route('admin.distributions.index') }}" class="hover:text-forest transition-colors">Penyaluran</a>
        <span>/</span>
        <a href="{{ route('admin.distributions.show', $distribution->id) }}" class="hover:text-forest transition-colors">Detail #{{ $distribution->id }}</a>
        <span>/</span>
        <span class="text-ink font-semibold">Perbarui Status</span>
    </div>

    <!-- Header -->
    <div class="mb-8 rise">
        <p class="flex items-center gap-3 text-[11px] font-semibold uppercase tracking-[.18em] text-ochre mb-2">
            <span class="h-px w-8 bg-ochre"></span>
            Pembaruan Progres
        </p>
        <h1 class="font-display text-3xl sm:text-4xl tracking-tight text-ink">Perbarui status penyaluran.</h1>
        <p class="text-sm text-warm mt-1.5">
            Barang: <strong class="text-ink">{{ $distribution->donationItem->nama_barang }}</strong>
            &bull; Status saat ini:
            <span class="font-semibold
                {{ $distribution->status === 'Menunggu Penyaluran' ? 'text-ochre' :
                   ($distribution->status === 'Dalam Proses Penyaluran' ? 'text-sky-900' : 'text-forest') }}">
                {{ $distribution->status }}
            </span>
        </p>
    </div>

    <!-- Current Info Card -->
    <div class="bg-cream/70 rounded-2xl border border-stone-200 p-6 mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-[11px] font-semibold text-warm uppercase tracking-[.12em]">Barang Donasi</span>
                <div class="font-semibold text-ink mt-1">{{ $distribution->donationItem->nama_barang }}</div>
            </div>
            <div>
                <span class="text-[11px] font-semibold text-warm uppercase tracking-[.12em]">Penerima Manfaat</span>
                <div class="font-semibold text-ink mt-1">{{ $distribution->beneficiary->name ?? 'Belum ditentukan' }}</div>
            </div>
            <div>
                <span class="text-[11px] font-semibold text-warm uppercase tracking-[.12em]">No. Resi Saat Ini</span>
                <div class="font-mono text-ink mt-1">{{ $distribution->nomor_resi ?? '-' }}</div>
            </div>
            <div>
                <span class="text-[11px] font-semibold text-warm uppercase tracking-[.12em]">Jumlah Barang</span>
                <div class="font-semibold text-ink mt-1">{{ $distribution->donationItem->jumlah }} item</div>
            </div>
        </div>
    </div>

    @if (count($availableStatuses) === 0)
        <div class="bg-white border border-forest/25 rounded-2xl p-8 text-center">
            <p class="font-display text-2xl text-forest">Penyaluran telah selesai.</p>
            <p class="text-xs text-warm mt-1.5">Status sudah final dan tidak dapat diubah lagi.</p>
            <a href="{{ route('admin.distributions.show', $distribution->id) }}"
               class="inline-flex items-center gap-1 mt-4 text-sm font-semibold text-forest hover:text-ochre transition-colors">
                ← Kembali ke Detail
            </a>
        </div>
    @else
        <!-- Form Update Status (POST route) -->
        <form method="POST" action="{{ route('admin.distributions.update-status', $distribution->id) }}" enctype="multipart/form-data"
              class="bg-white rounded-2xl border border-stone-200 overflow-hidden" id="updateStatusForm">
            @csrf

            <div class="p-6 border-b border-stone-200">
                <h2 class="font-display text-2xl text-ink">Form Pembaruan Status</h2>
                <p class="text-xs text-warm mt-0.5">Pilih status baru dan lengkapi informasi yang diperlukan</p>
            </div>

            <div class="p-6 space-y-6">
                <!-- Status Baru -->
                <div>
                    <label for="status" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
                        Status Baru <span class="text-ochre">*</span>
                    </label>
                    <select name="status" id="status" required
                            class="w-full px-4 py-2.5 bg-paper rounded-xl border border-stone-200 text-sm text-ink focus:bg-white focus:ring-2 focus:ring-forest/20 focus:border-forest outline-none transition-all"
                            onchange="toggleProofUpload(this.value)">
                        <option value="">— Pilih Status Baru —</option>
                        @foreach ($availableStatuses as $status)
                            <option value="{{ $status }}" {{ old('status') === $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="text-xs text-red-700 mt-1">{{ $message }}</p>
                    @enderror

                    <div class="mt-2 flex items-center gap-2 text-xs text-stone-400">
                        Transisi tersedia dari "{{ $distribution->status }}":
                        @foreach ($availableStatuses as $s)
                            <span class="font-semibold text-ink">{{ $s }}</span>{{ !$loop->last ? ',' : '' }}
                        @endforeach
                    </div>
                </div>

                <!-- Nomor Resi -->
                <div>
                    <label for="nomor_resi" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
                        Nomor Resi Transit
                    </label>
                    <input type="text" name="nomor_resi" id="nomor_resi" value="{{ old('nomor_resi', $distribution->nomor_resi) }}"
                           placeholder="Contoh: JKT-TRN-20261119-001"
                           class="w-full px-4 py-2.5 bg-paper rounded-xl border border-stone-200 text-sm text-ink focus:bg-white focus:ring-2 focus:ring-forest/20 focus:border-forest outline-none transition-all">
                    @error('nomor_resi')
                        <p class="text-xs text-red-700 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catatan -->
                <div>
                    <label for="catatan" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
                        Catatan
                    </label>
                    <textarea name="catatan" id="catatan" rows="4" placeholder="Tambahkan catatan terkait pembaruan status penyaluran..."
                              class="w-full px-4 py-2.5 bg-paper rounded-xl border border-stone-200 text-sm text-ink focus:bg-white focus:ring-2 focus:ring-forest/20 focus:border-forest outline-none resize-none transition-all">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <p class="text-xs text-red-700 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Upload Bukti Foto (muncul saat status = Disalurkan) -->
                <div id="proofUploadSection" class="hidden">
                    <div class="border-t border-stone-200 pt-6">
                        <label class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-1.5">
                            Bukti Foto Serah Terima
                        </label>
                        <p class="text-xs text-warm mb-3">Unggah foto bukti serah terima barang donasi kepada penerima manfaat</p>

                        <div class="border border-dashed border-stone-300 bg-paper rounded-xl p-6 text-center hover:border-forest transition-colors" id="dropZone">
                            <input type="file" name="bukti_foto" accept="image/jpeg,image/jpg,image/png"
                                   class="w-full text-sm text-warm file:mr-3 file:px-4 file:py-2 file:rounded-lg file:border-0 file:bg-cream file:text-forest file:font-semibold file:text-xs"
                                   onchange="previewImage(event)">
                            <p class="text-[11px] text-stone-400 mt-2">Format: JPG, JPEG, PNG &bull; Ukuran maks: 2MB</p>
                        </div>

                        @error('bukti_foto')
                            <p class="text-xs text-red-700 mt-1">{{ $message }}</p>
                        @enderror

                        <div id="imagePreview" class="mt-4 hidden">
                            <div class="relative inline-block">
                                <img id="previewImg" src="" alt="Preview" class="h-40 rounded-xl border border-stone-200 object-cover">
                                <button type="button" onclick="clearPreview()" class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-700 text-white flex items-center justify-center text-xs hover:bg-red-800 cursor-pointer">
                                    ✕
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="p-6 bg-paper border-t border-stone-200 flex items-center justify-between gap-3">
                <a href="{{ route('admin.distributions.show', $distribution->id) }}"
                   class="px-5 py-2.5 rounded-xl border border-stone-200 bg-white text-sm font-semibold text-warm hover:text-ink hover:bg-cream transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-forest text-paper text-sm font-semibold hover:bg-forest-soft transition duration-300 active:scale-95 cursor-pointer">
                    Simpan Perubahan Status
                </button>
            </div>
        </form>
    @endif
</div>

@push('scripts')
<script>
    function toggleProofUpload(value) {
        const section = document.getElementById('proofUploadSection');
        if (!section) return;
        if (value === 'Disalurkan') {
            section.classList.remove('hidden');
        } else {
            section.classList.add('hidden');
        }
    }

    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran foto melebihi batas 2MB. Silakan pilih foto lain.');
                event.target.value = '';
                return;
            }
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!validTypes.includes(file.type)) {
                alert('Format foto tidak valid. Gunakan format JPG, JPEG, atau PNG.');
                event.target.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }

    function clearPreview() {
        document.getElementById('imagePreview').classList.add('hidden');
        document.querySelector('input[name="bukti_foto"]').value = '';
    }

    const statusSelect = document.getElementById('status');
    if (statusSelect && statusSelect.value) {
        toggleProofUpload(statusSelect.value);
    }
</script>
@endpush
@endsection
