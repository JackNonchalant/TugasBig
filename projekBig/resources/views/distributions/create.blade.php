@extends('layouts.admin')
@section('page-title', 'Buat Penyaluran Baru')

@section('title', 'Buat Penyaluran Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs text-slate-500 mb-6">
        <a href="{{ route('admin.distributions.index') }}" class="hover:text-emerald-600 transition-colors">Penyaluran</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-slate-800 font-semibold">Buat Penyaluran Baru</span>
    </div>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Buat Penyaluran Baru</h1>
        <p class="text-sm text-slate-500 mt-1">Pilih barang donasi yang tersedia dan tentukan penerima manfaat untuk proses penyaluran</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('admin.distributions.store') }}"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @csrf

        <div class="p-6 border-b border-slate-100">
            <h2 class="text-lg font-bold text-slate-900">Data Penyaluran</h2>
        </div>

        <div class="p-6 space-y-6">
            <!-- Pilih Barang Donasi -->
            <div>
                <label for="donation_item_id" class="block text-sm font-bold text-slate-800 mb-2">
                    Barang Donasi <span class="text-red-500">*</span>
                </label>
                @if ($items->isEmpty())
                    <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-sm text-amber-800">
                        Tidak ada barang donasi dengan status "tersedia" saat ini.
                    </div>
                @else
                    <select name="donation_item_id" id="donation_item_id" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none bg-white transition-all">
                        <option value="">— Pilih Barang Donasi —</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}" {{ old('donation_item_id', $selectedItemId) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_barang }} — {{ $item->kategori }} ({{ $item->jumlah }} item) — Donatur: {{ $item->donor->name ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                @endif
                @error('donation_item_id')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pilih Penerima Manfaat -->
            <div>
                <label for="beneficiary_id" class="block text-sm font-bold text-slate-800 mb-2">
                    Penerima Manfaat
                </label>
                <select name="beneficiary_id" id="beneficiary_id"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none bg-white transition-all">
                    <option value="">— Belum ditentukan (opsional) —</option>
                    @foreach ($beneficiaries as $b)
                        <option value="{{ $b->id }}" {{ old('beneficiary_id') == $b->id ? 'selected' : '' }}>
                            {{ $b->name }} ({{ $b->email }})
                        </option>
                    @endforeach
                </select>
                @error('beneficiary_id')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catatan -->
            <div>
                <label for="catatan" class="block text-sm font-bold text-slate-800 mb-2">Catatan</label>
                <textarea name="catatan" id="catatan" rows="4"
                          placeholder="Tambahkan catatan terkait penyaluran..."
                          class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none resize-none transition-all">{{ old('catatan') }}</textarea>
                @error('catatan')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="p-6 bg-slate-50 border-t border-slate-100 flex items-center justify-between gap-3">
            <a href="{{ route('admin.distributions.index') }}"
               class="px-5 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-white transition-colors">
                Batal
            </a>
            <button type="submit" {{ $items->isEmpty() ? 'disabled' : '' }}
                    class="px-6 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 shadow-sm shadow-emerald-600/20 transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                Buat Penyaluran
            </button>
        </div>
    </form>
</div>
@endsection
