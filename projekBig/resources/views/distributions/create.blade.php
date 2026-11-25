@extends('layouts.admin')
@section('page-title', 'Buat Penyaluran Baru')

@section('title', 'Buat Penyaluran Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs text-warm mb-6">
        <a href="{{ route('admin.distributions.index') }}" class="hover:text-forest transition-colors">Penyaluran</a>
        <span>/</span>
        <span class="text-ink font-semibold">Buat Penyaluran Baru</span>
    </div>

    <!-- Header -->
    <div class="mb-8 rise">
        <p class="flex items-center gap-3 text-[11px] font-semibold uppercase tracking-[.18em] text-ochre mb-2">
            <span class="h-px w-8 bg-ochre"></span>
            Formulir Penyaluran
        </p>
        <h1 class="font-display text-3xl sm:text-4xl tracking-tight text-ink">Buat penyaluran baru.</h1>
        <p class="text-sm text-warm mt-1.5">Pilih barang donasi yang tersedia dan tentukan penerima manfaat untuk proses penyaluran.</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('admin.distributions.store') }}"
          class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
        @csrf

        <div class="p-6 border-b border-stone-200">
            <h2 class="font-display text-2xl text-ink">Data Penyaluran</h2>
        </div>

        <div class="p-6 space-y-6">
            <!-- Pilih Barang Donasi -->
            <div>
                <label for="donation_item_id" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
                    Barang Donasi <span class="text-ochre">*</span>
                </label>
                @if ($items->isEmpty())
                    <div class="p-4 rounded-xl bg-amber-50/80 border border-amber-200 text-sm text-amber-900">
                        Tidak ada barang donasi dengan status "tersedia" saat ini.
                    </div>
                @else
                    <select name="donation_item_id" id="donation_item_id" required
                            class="w-full px-4 py-2.5 bg-paper rounded-xl border border-stone-200 text-sm text-ink focus:bg-white focus:ring-2 focus:ring-forest/20 focus:border-forest outline-none transition-all">
                        <option value="">— Pilih Barang Donasi —</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}" {{ old('donation_item_id', $selectedItemId) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_barang }} — {{ $item->kategori }} ({{ $item->jumlah }} item) — Donatur: {{ $item->donor->name ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                @endif
                @error('donation_item_id')
                    <p class="text-xs text-red-700 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pilih Penerima Manfaat -->
            <div>
                <label for="beneficiary_id" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">
                    Penerima Manfaat
                </label>
                <select name="beneficiary_id" id="beneficiary_id"
                        class="w-full px-4 py-2.5 bg-paper rounded-xl border border-stone-200 text-sm text-ink focus:bg-white focus:ring-2 focus:ring-forest/20 focus:border-forest outline-none transition-all">
                    <option value="">— Belum ditentukan (opsional) —</option>
                    @foreach ($beneficiaries as $b)
                        <option value="{{ $b->id }}" {{ old('beneficiary_id') == $b->id ? 'selected' : '' }}>
                            {{ $b->name }} ({{ $b->email }})
                        </option>
                    @endforeach
                </select>
                @error('beneficiary_id')
                    <p class="text-xs text-red-700 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catatan -->
            <div>
                <label for="catatan" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-2">Catatan</label>
                <textarea name="catatan" id="catatan" rows="4"
                          placeholder="Tambahkan catatan terkait penyaluran..."
                          class="w-full px-4 py-2.5 bg-paper rounded-xl border border-stone-200 text-sm text-ink focus:bg-white focus:ring-2 focus:ring-forest/20 focus:border-forest outline-none resize-none transition-all">{{ old('catatan') }}</textarea>
                @error('catatan')
                    <p class="text-xs text-red-700 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="p-6 bg-paper border-t border-stone-200 flex items-center justify-between gap-3">
            <a href="{{ route('admin.distributions.index') }}"
               class="px-5 py-2.5 rounded-xl border border-stone-200 bg-white text-sm font-semibold text-warm hover:text-ink hover:bg-cream transition-colors">
                Batal
            </a>
            <button type="submit" {{ $items->isEmpty() ? 'disabled' : '' }}
                    class="px-6 py-2.5 rounded-xl bg-forest text-paper text-sm font-semibold hover:bg-forest-soft transition duration-300 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer">
                Buat Penyaluran
            </button>
        </div>
    </form>
</div>
@endsection
