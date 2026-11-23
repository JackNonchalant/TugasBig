<?php

namespace App\Http\Controllers;

use App\Models\DonationItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DonationItemController extends Controller
{
    /**
     * Show the form for creating a new donation item.
     * Only accessible to Donors.
     */
    public function create(): View
    {
        $kategoriList = [
            'Buku & Alat Tulis',
            'Buku Pelajaran & Referensi',
            'Seragam & Sepatu Sekolah',
            'Perangkat Elektronik & Belajar',
            'Tas & Perlengkapan Belajar',
            'Alat Peraga & Praktikum',
            'Lainnya',
        ];

        $kondisiList = [
            'Baru',
            'Sangat Baik',
            'Layak Pakai',
        ];

        $poskoTransitList = DonationItem::getPoskoTransitList();

        return view('items.create', compact('kategoriList', 'kondisiList', 'poskoTransitList'));
    }

    /**
     * Store a newly created donation item in storage.
     * Only accessible to Donors.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_barang' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'deskripsi' => ['required', 'string'],
            'kondisi' => ['required', 'string', 'in:Baru,Sangat Baik,Layak Pakai'],
            'jumlah' => ['required', 'integer', 'min:1', 'max:10000'],
            'lokasi_posko' => ['required', 'string', 'max:255', Rule::in(DonationItem::getPoskoTransitList())],
            'jadwal_penyerahan' => ['required', 'date', 'after_or_equal:today'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'nama_barang.required' => 'Nama barang donasi wajib diisi.',
            'kategori.required' => 'Kategori barang wajib dipilih.',
            'deskripsi.required' => 'Deskripsi barang wajib diisi secara jelas.',
            'kondisi.required' => 'Kondisi barang wajib dipilih.',
            'kondisi.in' => 'Kondisi barang harus Baru, Sangat Baik, atau Layak Pakai.',
            'jumlah.required' => 'Jumlah barang wajib diisi.',
            'jumlah.integer' => 'Jumlah barang harus berupa angka.',
            'jumlah.min' => 'Jumlah barang minimal 1 buah/paket.',
            'lokasi_posko.required' => 'Lokasi posko transit wajib dipilih.',
            'lokasi_posko.in' => 'Pilihan lokasi posko transit tidak valid.',
            'jadwal_penyerahan.required' => 'Tanggal jadwal penyerahan barang wajib ditentukan.',
            'jadwal_penyerahan.date' => 'Format tanggal jadwal penyerahan tidak valid.',
            'jadwal_penyerahan.after_or_equal' => 'Jadwal penyerahan minimal hari ini atau tanggal setelahnya.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format foto harus berupa jpeg, jpg, png, atau webp.',
            'foto.max' => 'Ukuran foto maksimal adalah 2MB.',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('donations', 'public');
        }

        $item = DonationItem::create([
            'user_id' => Auth::id(),
            'nama_barang' => $validated['nama_barang'],
            'kategori' => $validated['kategori'],
            'deskripsi' => $validated['deskripsi'],
            'kondisi' => $validated['kondisi'],
            'jumlah' => $validated['jumlah'],
            'lokasi_posko' => $validated['lokasi_posko'],
            'jadwal_penyerahan' => $validated['jadwal_penyerahan'],
            'foto' => $fotoPath,
            'status' => 'Menunggu Verifikasi Transit',
        ]);

        return redirect()
            ->route('items.show', $item->id)
            ->with('success', 'Barang donasi pendidikan berhasil diposting!');
    }

    /**
     * Display the specified donation item detail.
     */
    public function show($id): View
    {
        $item = DonationItem::with('donor')->findOrFail($id);

        return view('items.show', compact('item'));
    }
}
