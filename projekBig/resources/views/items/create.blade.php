@extends('layouts.app')

@section('title', 'Form Posting Barang Donasi')

@section('content')
<div class="max-w-5xl mx-auto px-5 sm:px-8 py-10">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-warm mb-6">
        <a href="{{ route('donor.dashboard') }}" class="hover:text-forest transition-colors">Dashboard Donatur</a>
        <span>/</span>
        <span class="text-ink font-semibold">Posting Barang Donasi</span>
    </nav>

    <!-- Page Header -->
    <div class="mb-8 rise">
        <p class="flex items-center gap-3 text-[11px] font-semibold uppercase tracking-[.18em] text-ochre mb-2.5">
            <span class="h-px w-8 bg-ochre"></span>
            Posting Barang Donasi Pendidikan
        </p>
        <h1 class="font-display text-4xl sm:text-[2.75rem] leading-[1.04] tracking-tight text-ink">
            Bagikan perlengkapan <em class="text-ochre">belajar.</em>
        </h1>
        <p class="text-sm text-warm mt-2">Salurkan buku, seragam, atau alat tulis layak pakai untuk siswa yang membutuhkan.</p>
    </div>

    @if ($errors->any())
        <div class="p-4 rounded-xl bg-red-50/80 border border-red-200 mb-6 text-sm text-red-900">
            <div class="font-semibold mb-1 text-xs uppercase tracking-wider">Terdapat beberapa isian yang perlu diperiksa:</div>
            <ul class="list-disc list-inside space-y-0.5 text-xs text-red-800">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8">
                <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Nama Barang -->
                    <div>
                        <label for="nama_barang" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
                            Nama Barang Donasi <span class="text-ochre">*</span>
                        </label>
                        <input
                            type="text"
                            name="nama_barang"
                            id="nama_barang"
                            value="{{ old('nama_barang') }}"
                            required
                            placeholder="Contoh: Paket Buku Tematik SD Kelas 5 Lengkap"
                            class="block w-full px-4 py-2.5 bg-paper border @error('nama_barang') border-red-300 ring-1 ring-red-300 @else border-stone-200 @enderror rounded-xl text-sm text-ink placeholder:text-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest transition-all"
                        >
                        @error('nama_barang')
                            <p class="text-xs text-red-700 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori Barang -->
                    <div>
                        <label for="kategori" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
                            Kategori Barang <span class="text-ochre">*</span>
                        </label>
                        <select
                            name="kategori"
                            id="kategori"
                            required
                            class="block w-full px-4 py-2.5 bg-paper border @error('kategori') border-red-300 ring-1 ring-red-300 @else border-stone-200 @enderror rounded-xl text-sm text-ink focus:bg-white focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest transition-all"
                        >
                            <option value="">-- Pilih Kategori Perlengkapan --</option>
                            @foreach ($kategoriList as $kat)
                                <option value="{{ $kat }}" {{ old('kategori') === $kat ? 'selected' : '' }}>
                                    {{ $kat }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <p class="text-xs text-red-700 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi Barang -->
                    <div>
                        <label for="deskripsi" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
                            Deskripsi Barang <span class="text-ochre">*</span>
                        </label>
                        <textarea
                            name="deskripsi"
                            id="deskripsi"
                            rows="4"
                            required
                            placeholder="Tuliskan detail barang donasi, misalnya jenjang kelas, isi paket, kelengkapan, dan catatan penting lainnya..."
                            class="block w-full px-4 py-2.5 bg-paper border @error('deskripsi') border-red-300 ring-1 ring-red-300 @else border-stone-200 @enderror rounded-xl text-sm text-ink placeholder:text-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest transition-all"
                        >{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-xs text-red-700 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kondisi Barang -->
                    <div>
                        <label class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
                            Kondisi Barang <span class="text-ochre">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            @foreach ($kondisiList as $k)
                                <label class="flex items-center gap-3 p-3.5 border border-stone-200 bg-paper rounded-xl cursor-pointer hover:border-forest/50 has-[:checked]:border-forest has-[:checked]:bg-cream/60 has-[:checked]:ring-1 has-[:checked]:ring-forest transition-all">
                                    <input
                                        type="radio"
                                        name="kondisi"
                                        value="{{ $k }}"
                                        {{ old('kondisi', 'Sangat Baik') === $k ? 'checked' : '' }}
                                        class="w-4 h-4 text-forest border-stone-300 focus:ring-forest accent-forest"
                                        required
                                    >
                                    <div>
                                        <div class="text-sm font-semibold text-ink">{{ $k }}</div>
                                        <div class="text-[11px] text-warm">
                                            @if($k === 'Baru')
                                                Belum pernah dipakai
                                            @elseif($k === 'Sangat Baik')
                                                Bekas seperti baru
                                            @else
                                                Bekas layak fungsi
                                            @endif
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('kondisi')
                            <p class="text-xs text-red-700 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Barang -->
                    <div>
                        <label for="jumlah" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
                            Jumlah Barang (Pcs / Paket) <span class="text-ochre">*</span>
                        </label>
                        <div class="w-full sm:w-48">
                            <input
                                type="number"
                                name="jumlah"
                                id="jumlah"
                                min="1"
                                max="10000"
                                value="{{ old('jumlah', 1) }}"
                                required
                                class="block w-full px-4 py-2.5 bg-paper border @error('jumlah') border-red-300 ring-1 ring-red-300 @else border-stone-200 @enderror rounded-xl text-sm text-ink focus:bg-white focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest transition-all"
                            >
                        </div>
                        @error('jumlah')
                            <p class="text-xs text-red-700 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Foto Barang -->
                    <div>
                        <label for="foto" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
                            Foto Barang Donasi
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border border-dashed border-stone-300 rounded-xl hover:border-forest transition-colors bg-paper">
                            <div class="space-y-2 text-center">
                                <div id="preview-container" class="hidden mb-3">
                                    <img id="image-preview" src="#" alt="Pratinjau Foto" class="max-h-48 mx-auto rounded-xl border border-stone-200 object-cover">
                                </div>
                                <div id="upload-icon" class="flex justify-center text-stone-400">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="text-xs text-warm">
                                    <label for="foto" class="relative cursor-pointer font-semibold text-forest hover:text-ochre transition-colors">
                                        <span>Unggah foto barang</span>
                                        <input id="foto" name="foto" type="file" accept="image/jpeg,image/png,image/jpg,image/webp" class="sr-only" onchange="previewImage(event)">
                                    </label>
                                    <span class="pl-1">atau pilih dari perangkat</span>
                                </div>
                                <p class="text-[11px] text-stone-400">Format JPG, PNG, atau WEBP (Maksimal 2MB)</p>
                            </div>
                        </div>
                        @error('foto')
                            <p class="text-xs text-red-700 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Actions -->
                    <div class="pt-5 border-t border-stone-200 flex items-center justify-end gap-3">
                        <a href="{{ route('donor.dashboard') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-warm hover:text-ink hover:bg-stone-100 transition-colors">
                            Batal
                        </a>
                        <button
                            type="submit"
                            class="group inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold text-paper bg-forest hover:bg-forest-soft transition duration-300 active:scale-95 cursor-pointer"
                        >
                            Posting Barang Donasi
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar Guidelines -->
        <div class="space-y-5">
            <div class="bg-cream/80 rounded-2xl border border-stone-200 p-6">
                <p class="text-[11px] font-semibold uppercase tracking-[.16em] text-ochre mb-2">Panduan</p>
                <h3 class="font-display text-2xl text-ink mb-4">Standar Kelayakan Donasi</h3>
                <ul class="space-y-3.5 text-xs text-warm leading-relaxed">
                    <li class="flex items-start gap-2.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-forest mt-1.5 shrink-0"></span>
                        <span><strong class="text-ink">Layak Pakai:</strong> Pastikan buku atau perlengkapan masih utuh, bersih, dan tidak rusak parah.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-forest mt-1.5 shrink-0"></span>
                        <span><strong class="text-ink">Foto Jelas:</strong> Ambil foto dengan pencahayaan baik agar tim transit dan penerima dapat melihat kondisi barang secara jujur.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-forest mt-1.5 shrink-0"></span>
                        <span><strong class="text-ink">Deskripsi Rinci:</strong> Sertakan informasi jenjang pendidikan (SD/SMP/SMA) atau spesifikasi jika berupa perangkat elektronik.</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white rounded-2xl border border-stone-200 p-6 text-xs text-warm">
                <div class="text-[11px] font-semibold uppercase tracking-[.14em] text-warm mb-1">Identitas Donatur</div>
                <p>Postingan ini akan tercatat atas nama akun Anda:</p>
                <div class="mt-3 p-3.5 rounded-xl bg-paper border border-stone-200 text-ink">
                    <div class="font-semibold">{{ auth()->user()->name }}</div>
                    <div class="text-[11px] text-warm mt-0.5">{{ auth()->user()->email }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                const container = document.getElementById('preview-container');
                preview.src = e.target.result;
                container.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
