<?php

namespace Database\Seeders;

use App\Models\DonationItem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Administrator PojokBerbagi
        $admin = User::firstOrCreate(
            ['email' => 'admin@pojokberbagi.id'],
            [
                'name' => 'Administrator PojokBerbagi',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // 2. Akun Donatur
        $donor = User::firstOrCreate(
            ['email' => 'donatur@pojokberbagi.id'],
            [
                'name' => 'Budi Pratama (Donatur)',
                'password' => Hash::make('password123'),
                'role' => 'donor',
            ]
        );

        // 3. Akun Penerima Manfaat
        $beneficiary = User::firstOrCreate(
            ['email' => 'penerima@pojokberbagi.id'],
            [
                'name' => 'Siti Rahma (Penerima Manfaat)',
                'password' => Hash::make('password123'),
                'role' => 'beneficiary',
            ]
        );

        // 4. Sample Barang Donasi Pendidikan
        $sampleItems = [
            [
                'user_id' => $donor->id,
                'nama_barang' => 'Paket Buku Tematik SD Kelas 4-6 (Lengkap)',
                'kategori' => 'Buku Pelajaran & Referensi',
                'deskripsi' => 'Kumpulan buku pelajaran tematik lengkap untuk jenjang SD kelas 4, 5, dan 6. Halaman masih utuh, bersih, dan sangat layak digunakan untuk mendukung kegiatan belajar mengajar siswa.',
                'kondisi' => 'Sangat Baik',
                'jumlah' => 5,
                'foto' => null,
                'lokasi_posko' => 'Posko Transit Pusat (Jl. Pendidikan No. 45, Bandung)',
                'jadwal_penyerahan' => now()->addDays(2)->format('Y-m-d'),
                'status' => 'Menunggu Verifikasi Transit',
            ],
            [
                'user_id' => $donor->id,
                'nama_barang' => 'Seragam Sekolah Merah Putih Ukuran M',
                'kategori' => 'Seragam & Sepatu Sekolah',
                'deskripsi' => '3 stel seragam SD merah putih baru belum pernah dipakai, lengkap dengan kemeja putih berlengan pendek dan celana/rok merah serta topi sekolah.',
                'kondisi' => 'Baru',
                'jumlah' => 3,
                'foto' => null,
                'lokasi_posko' => 'Posko Transit Dago (Jl. Ir. H. Juanda No. 120, Bandung)',
                'jadwal_penyerahan' => now()->addDays(3)->format('Y-m-d'),
                'status' => 'Menunggu Verifikasi Transit',
            ],
            [
                'user_id' => $donor->id,
                'nama_barang' => 'Kalkulator Ilmiah & Paket Busur Jangka Geometri',
                'kategori' => 'Alat Peraga & Praktikum',
                'deskripsi' => 'Kalkulator ilmiah scientific dan 1 set alat ukur geometri (jangka, busur, segitiga) untuk siswa SMP/SMA belajar matematika dan sains.',
                'kondisi' => 'Layak Pakai',
                'jumlah' => 2,
                'foto' => null,
                'lokasi_posko' => 'Posko Transit Buah Batu (Jl. Buah Batu No. 88, Bandung)',
                'jadwal_penyerahan' => now()->subDay()->format('Y-m-d'),
                'status' => 'tersedia',
            ],
            [
                'user_id' => $donor->id,
                'nama_barang' => 'Paket Perlengkapan Alat Tulis & Buku Tulis',
                'kategori' => 'Buku & Alat Tulis',
                'deskripsi' => 'Paket donasi berisi 2 pack buku tulis (isi 10 buku per pack), 1 kotak pulpen gel, pensil 2B, rautan, penghapus, dan 1 set pewarna krayon.',
                'kondisi' => 'Baru',
                'jumlah' => 10,
                'foto' => null,
                'lokasi_posko' => 'Posko Transit Sukajadi (Jl. Sukajadi No. 15, Bandung)',
                'jadwal_penyerahan' => now()->subDays(2)->format('Y-m-d'),
                'status' => 'tersedia',
            ],
        ];

        foreach ($sampleItems as $item) {
            DonationItem::firstOrCreate(
                ['nama_barang' => $item['nama_barang'], 'user_id' => $item['user_id']],
                $item
            );
        }
    }
}
