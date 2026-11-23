@extends('layouts.app')

@section('title', 'Form Posting Barang Donasi')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-slate-500 mb-6">
        <a href="{{ route('donor.dashboard') }}" class="hover:text-emerald-600 transition-colors">Dashboard Donatur</a>
        <span>/</span>
        <span class="text-slate-800 font-semibold">Posting Barang Donasi</span>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold uppercase tracking-wider mb-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            PojokBerbagi Donasi Pendidikan
        </div>
        <h1 class="text-3xl font-bold tracking-tight text-slate-900">Posting Barang Donasi Pendidikan</h1>
        <p class="text-sm text-slate-500 mt-1">Salurkan perlengkapan belajar yang Anda miliki untuk adik-adik dan sekolah yang membutuhkan.</p>
    </div>

    @if ($errors->any())
        <div class="p-4 rounded-xl bg-red-50 border border-red-200 mb-6 text-sm text-red-700">
            <div class="font-semibold mb-1 flex items-center gap-2">
                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                Terdapat beberapa isian yang perlu diperiksa kembali:
            </div>
            <ul class="list-disc list-inside space-y-0.5 text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
                <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Nama Barang -->
                    <div>
                        <label for="nama_barang" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nama Barang Donasi <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="nama_barang"
                            id="nama_barang"
                            value="{{ old('nama_barang') }}"
                            required
                            placeholder="Contoh: Paket Buku Tematik SD Kelas 5 Lengkap"
                            class="block w-full px-4 py-2.5 bg-slate-50 border @error('nama_barang') border-red-300 ring-1 ring-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                        >
                        @error('nama_barang')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori Barang -->
                    <div>
                        <label for="kategori" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                            Kategori Barang <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="kategori"
                            id="kategori"
                            required
                            class="block w-full px-4 py-2.5 bg-slate-50 border @error('kategori') border-red-300 ring-1 ring-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                        >
                            <option value="">-- Pilih Kategori Perlengkapan --</option>
                            @foreach ($kategoriList as $kat)
                                <option value="{{ $kat }}" {{ old('kategori') === $kat ? 'selected' : '' }}>
                                    {{ $kat }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi Barang -->
                    <div>
                        <label for="deskripsi" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                            Deskripsi Barang <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            name="deskripsi"
                            id="deskripsi"
                            rows="4"
                            required
                            placeholder="Tuliskan detail barang donasi, misalnya jenjang kelas, isi paket, kelengkapan, dan catatan penting lainnya..."
                            class="block w-full px-4 py-2.5 bg-slate-50 border @error('deskripsi') border-red-300 ring-1 ring-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                        >{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kondisi Barang (Radio / Badges) -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                            Kondisi Barang <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            @foreach ($kondisiList as $k)
                                <label class="flex items-center gap-3 p-3.5 border rounded-xl cursor-pointer hover:border-emerald-400 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50 has-[:checked]:ring-1 has-[:checked]:ring-emerald-500 transition-all">
                                    <input
                                        type="radio"
                                        name="kondisi"
                                        value="{{ $k }}"
                                        {{ old('kondisi', 'Sangat Baik') === $k ? 'checked' : '' }}
                                        class="w-4 h-4 text-emerald-600 border-slate-300 focus:ring-emerald-500"
                                        required
                                    >
                                    <div>
                                        <div class="text-sm font-semibold text-slate-800">{{ $k }}</div>
                                        <div class="text-[11px] text-slate-500">
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
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Barang -->
                    <div>
                        <label for="jumlah" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                            Jumlah Barang (Pcs / Paket) <span class="text-red-500">*</span>
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
                                class="block w-full px-4 py-2.5 bg-slate-50 border @error('jumlah') border-red-300 ring-1 ring-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                            >
                        </div>
                        @error('jumlah')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pemilihan Lokasi Posko Transit & Tanggal Penyerahan -->
                    <div class="p-5 rounded-2xl bg-amber-50/60 border border-amber-200 space-y-5">
                        <div class="flex items-center gap-2 pb-3 border-b border-amber-200/80">
                            <div class="w-8 h-8 rounded-lg bg-amber-500 text-white flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-900">Lokasi Posko Transit & Jadwal Penyerahan</h3>
                                <p class="text-[11px] text-slate-500">Tentukan posko transit terdekat dan tanggal serah terima barang untuk verifikasi</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Lokasi Posko Transit -->
                            <div>
                                <label for="lokasi_posko" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                                    Pilih Posko Transit <span class="text-red-500">*</span>
                                </label>
                                <select
                                    name="lokasi_posko"
                                    id="lokasi_posko"
                                    required
                                    class="block w-full px-4 py-2.5 bg-white border @error('lokasi_posko') border-red-300 ring-1 ring-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                                >
                                    <option value="">-- Pilih Posko Transit --</option>
                                    @foreach ($poskoTransitList as $posko)
                                        <option value="{{ $posko }}" {{ old('lokasi_posko') === $posko ? 'selected' : '' }}>
                                            {{ $posko }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('lokasi_posko')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Penyerahan -->
                            <div>
                                <label for="jadwal_penyerahan" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                                    Tanggal Penyerahan <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="date"
                                    name="jadwal_penyerahan"
                                    id="jadwal_penyerahan"
                                    min="{{ date('Y-m-d') }}"
                                    value="{{ old('jadwal_penyerahan', date('Y-m-d', strtotime('+1 day'))) }}"
                                    required
                                    class="block w-full px-4 py-2.5 bg-white border @error('jadwal_penyerahan') border-red-300 ring-1 ring-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                                >
                                @error('jadwal_penyerahan')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <p class="text-[11px] text-amber-800/80 bg-amber-100/60 p-2.5 rounded-lg">
                            Barang yang diserahkan ke posko transit akan diperiksa fisiknya oleh petugas sebelum disalurkan ke penerima manfaat.
                        </p>
                    </div>

                    <!-- Foto Barang -->
                    <div>
                        <label for="foto" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                            Foto Barang Donasi
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-xl hover:border-emerald-400 transition-colors bg-slate-50/50">
                            <div class="space-y-2 text-center">
                                <div id="preview-container" class="hidden mb-3">
                                    <img id="image-preview" src="#" alt="Pratinjau Foto" class="max-h-48 mx-auto rounded-lg shadow-sm border border-slate-200 object-cover">
                                </div>
                                <div id="upload-icon" class="flex justify-center text-slate-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="text-xs text-slate-600">
                                    <label for="foto" class="relative cursor-pointer rounded-md font-semibold text-emerald-600 hover:text-emerald-500 focus-within:outline-none">
                                        <span>Unggah foto barang</span>
                                        <input id="foto" name="foto" type="file" accept="image/jpeg,image/png,image/jpg,image/webp" class="sr-only" onchange="previewImage(event)">
                                    </label>
                                    <span class="pl-1">atau tarik file ke sini</span>
                                </div>
                                <p class="text-[11px] text-slate-400">Format JPG, PNG, atau WEBP (Maksimal 2MB)</p>
                            </div>
                        </div>
                        @error('foto')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Actions -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                        <a href="{{ route('donor.dashboard') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100 transition-colors">
                            Batal
                        </a>
                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 shadow-md shadow-emerald-600/25 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all cursor-pointer"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Posting Barang Donasi
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar Guidelines -->
        <div class="space-y-6">
            <div class="bg-gradient-to-br from-emerald-50 to-teal-50/40 rounded-2xl border border-emerald-100 p-6">
                <h3 class="font-bold text-slate-900 text-sm mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Panduan Donasi Pendidikan
                </h3>
                <ul class="space-y-3 text-xs text-slate-600 leading-relaxed">
                    <li class="flex items-start gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>
                        <span><strong>Layak Pakai:</strong> Pastikan buku atau perlengkapan masih utuh, bersih, dan tidak rusak parah.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>
                        <span><strong>Foto Jelas:</strong> Ambil foto dengan pencahayaan baik agar calon penerima dapat melihat kondisi barang secara jujur.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>
                        <span><strong>Deskripsi Rinci:</strong> Sertakan informasi jenjang pendidikan (SD/SMP/SMA) atau spesifikasi jika berupa perangkat elektronik.</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 text-xs text-slate-500">
                <div class="font-semibold text-slate-800 mb-1">Identitas Donatur</div>
                <p>Postingan ini akan terhubung dengan akun Anda:</p>
                <div class="mt-3 p-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-700">
                    <div class="font-bold">{{ auth()->user()->name }}</div>
                    <div class="text-[11px] text-slate-400">{{ auth()->user()->email }}</div>
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
