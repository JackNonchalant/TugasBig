@extends('layouts.admin')
@section('page-title', 'Update Status Penyaluran')

@section('title', 'Perbarui Status Penyaluran')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs text-slate-500 mb-6">
        <a href="{{ route('admin.distributions.index') }}" class="hover:text-emerald-600 transition-colors">Penyaluran</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('admin.distributions.show', $distribution->id) }}" class="hover:text-emerald-600 transition-colors">Detail #{{ $distribution->id }}</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-slate-800 font-semibold">Perbarui Status</span>
    </div>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Perbarui Status Penyaluran</h1>
        <p class="text-sm text-slate-500 mt-1">
            Barang: <strong class="text-slate-700">{{ $distribution->donationItem->nama_barang }}</strong>
            &bull; Status saat ini:
            <span class="font-semibold
                {{ $distribution->status === 'Menunggu Penyaluran' ? 'text-amber-600' :
                   ($distribution->status === 'Dalam Proses Penyaluran' ? 'text-blue-600' : 'text-emerald-600') }}">
                {{ $distribution->status }}
            </span>
        </p>
    </div>

    <!-- Current Info Card -->
    <div class="bg-slate-50 rounded-2xl border border-slate-200 p-6 mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Barang Donasi</span>
                <div class="font-bold text-slate-900 mt-1">{{ $distribution->donationItem->nama_barang }}</div>
            </div>
            <div>
                <span class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Penerima Manfaat</span>
                <div class="font-bold text-slate-900 mt-1">{{ $distribution->beneficiary->name ?? 'Belum ditentukan' }}</div>
            </div>
            <div>
                <span class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">No. Resi Saat Ini</span>
                <div class="font-mono text-slate-700 mt-1">{{ $distribution->nomor_resi ?? '-' }}</div>
            </div>
            <div>
                <span class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Jumlah Barang</span>
                <div class="font-bold text-slate-900 mt-1">{{ $distribution->donationItem->jumlah }} item</div>
            </div>
        </div>
    </div>

    @if (count($availableStatuses) === 0)
        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-6 text-center">
            <svg class="w-10 h-10 mx-auto text-emerald-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm font-semibold text-emerald-800">Penyaluran telah selesai</p>
            <p class="text-xs text-emerald-600 mt-1">Status sudah final dan tidak dapat diubah lagi.</p>
            <a href="{{ route('admin.distributions.show', $distribution->id) }}"
               class="inline-flex items-center gap-1 mt-3 text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                ← Kembali ke Detail
            </a>
        </div>
    @else
        <!-- Form Update Status -->
        <form method="POST" action="{{ route('admin.distributions.update-status', $distribution->id) }}" enctype="multipart/form-data"
              class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden" id="updateStatusForm">
            @csrf
            @method('PUT')

            <div class="p-6 border-b border-slate-100">
                <h2 class="text-lg font-bold text-slate-900">Form Pembaruan Status</h2>
                <p class="text-xs text-slate-500 mt-0.5">Pilih status baru dan lengkapi informasi yang diperlukan</p>
            </div>

            <div class="p-6 space-y-6">
                <!-- Status Baru -->
                <div>
                    <label for="status" class="block text-sm font-bold text-slate-800 mb-2">
                        Status Baru <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none bg-white transition-all"
                            onchange="toggleProofUpload(this.value)">
                        <option value="">— Pilih Status Baru —</option>
                        @foreach ($availableStatuses as $status)
                            <option value="{{ $status }}" {{ old('status') === $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Status transition hint -->
                    <div class="mt-2 flex items-center gap-2 text-xs text-slate-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Transisi yang tersedia dari "{{ $distribution->status }}":
                        @foreach ($availableStatuses as $s)
                            <span class="font-semibold text-slate-600">{{ $s }}</span>{{ !$loop->last ? ',' : '' }}
                        @endforeach
                    </div>
                </div>

                <!-- Nomor Resi -->
                <div>
                    <label for="nomor_resi" class="block text-sm font-bold text-slate-800 mb-2">
                        Nomor Resi Transit
                    </label>
                    <input type="text" name="nomor_resi" id="nomor_resi" value="{{ old('nomor_resi', $distribution->nomor_resi) }}"
                           placeholder="Contoh: JKT-TRN-20261119-001"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                    @error('nomor_resi')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catatan -->
                <div>
                    <label for="catatan" class="block text-sm font-bold text-slate-800 mb-2">
                        Catatan
                    </label>
                    <textarea name="catatan" id="catatan" rows="4" placeholder="Tambahkan catatan terkait pembaruan status penyaluran..."
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none resize-none transition-all">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PBI-014: Upload Bukti Foto (muncul saat status = Disalurkan) -->
                <div id="proofUploadSection" class="hidden">
                    <div class="border-t border-slate-100 pt-6">
                        <label class="block text-sm font-bold text-slate-800 mb-2">
                            Bukti Foto Serah Terima
                        </label>
                        <p class="text-xs text-slate-500 mb-3">Unggah foto bukti serah terima barang donasi kepada penerima manfaat</p>

                        <div class="border-2 border-dashed border-slate-200 rounded-xl p-6 text-center hover:border-emerald-400 transition-colors" id="dropZone">
                            <svg class="w-10 h-10 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <input type="file" name="bukti_foto" accept="image/jpeg,image/jpg,image/png"
                                   class="w-full text-sm text-slate-500 file:mr-3 file:px-4 file:py-2 file:rounded-lg file:border-0 file:bg-emerald-50 file:text-emerald-700 file:font-semibold file:text-xs"
                                   onchange="previewImage(event)">
                            <p class="text-[11px] text-slate-400 mt-2">Format: JPG, JPEG, PNG &bull; Ukuran maks: 2MB</p>
                        </div>

                        @error('bukti_foto')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Preview Image -->
                        <div id="imagePreview" class="mt-4 hidden">
                            <div class="relative inline-block">
                                <img id="previewImg" src="" alt="Preview" class="h-40 rounded-xl border border-slate-200 object-cover shadow-sm">
                                <button type="button" onclick="clearPreview()" class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-500 text-white flex items-center justify-center text-xs hover:bg-red-600 shadow">
                                    ✕
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="p-6 bg-slate-50 border-t border-slate-100 flex items-center justify-between gap-3">
                <a href="{{ route('admin.distributions.show', $distribution->id) }}"
                   class="px-5 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-white transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 shadow-sm shadow-emerald-600/20 transition-all">
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
        if (value === 'Disalurkan') {
            section.classList.remove('hidden');
        } else {
            section.classList.add('hidden');
        }
    }

    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            // Validasi ukuran
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran foto melebihi batas 2MB. Silakan pilih foto lain.');
                event.target.value = '';
                return;
            }
            // Validasi tipe
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

    // On page load, check if status is already selected
    const statusSelect = document.getElementById('status');
    if (statusSelect && statusSelect.value) {
        toggleProofUpload(statusSelect.value);
    }
</script>
@endpush
@endsection
