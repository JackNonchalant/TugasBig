<?php

namespace Tests\Feature;

use App\Models\DonationItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonationHistoryFilterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * TC-01: Filter 'Semua' menampilkan seluruh data donasi milik donatur.
     */
    public function test_filter_semua_displays_all_donations(): void
    {
        $donor = User::factory()->create(['role' => 'donor']);

        DonationItem::create([
            'user_id' => $donor->id,
            'nama_barang' => 'Buku Ensiklopedia Anak',
            'kategori' => 'Buku & Alat Tulis',
            'deskripsi' => 'Koleksi ensiklopedia sains lengkap.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 1,
            'status' => 'Menunggu Verifikasi Transit',
        ]);

        DonationItem::create([
            'user_id' => $donor->id,
            'nama_barang' => 'Seragam Pramuka Siaga',
            'kategori' => 'Seragam & Sepatu Sekolah',
            'deskripsi' => 'Ukuran M siap pakai.',
            'kondisi' => 'Baru',
            'jumlah' => 2,
            'status' => 'diproses',
        ]);

        DonationItem::create([
            'user_id' => $donor->id,
            'nama_barang' => 'Tas Ransel Sekolah',
            'kategori' => 'Tas & Perlengkapan Belajar',
            'deskripsi' => 'Tas punggung anti air.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 1,
            'status' => 'disalurkan',
        ]);

        $response = $this->actingAs($donor)->get(route('donor.my-donations', ['status' => 'semua']));

        $response->assertStatus(200);
        $response->assertSee('Buku Ensiklopedia Anak');
        $response->assertSee('Seragam Pramuka Siaga');
        $response->assertSee('Tas Ransel Sekolah');
    }

    /**
     * TC-02: Filter 'Menunggu' hanya menampilkan donasi berstatus Menunggu Verifikasi.
     */
    public function test_filter_menunggu_only_displays_pending_donations(): void
    {
        $donor = User::factory()->create(['role' => 'donor']);

        DonationItem::create([
            'user_id' => $donor->id,
            'nama_barang' => 'Modul Belajar Fisika',
            'kategori' => 'Buku Pelajaran & Referensi',
            'deskripsi' => 'Kumpulan soal fisika SMA.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 1,
            'status' => 'Menunggu Verifikasi Transit',
        ]);

        DonationItem::create([
            'user_id' => $donor->id,
            'nama_barang' => 'Kamus Oxford Junior',
            'kategori' => 'Buku Pelajaran & Referensi',
            'deskripsi' => 'Kamus bahasa inggris pemula.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 1,
            'status' => 'disalurkan',
        ]);

        $response = $this->actingAs($donor)->get(route('donor.my-donations', ['status' => 'menunggu']));

        $response->assertStatus(200);
        $response->assertSee('Modul Belajar Fisika');
        $response->assertDontSee('Kamus Oxford Junior');
    }

    /**
     * TC-03: Filter 'Diproses' hanya menampilkan donasi berstatus diproses/tersedia.
     */
    public function test_filter_diproses_only_displays_processing_donations(): void
    {
        $donor = User::factory()->create(['role' => 'donor']);

        DonationItem::create([
            'user_id' => $donor->id,
            'nama_barang' => 'Kotak Pensil Kayu',
            'kategori' => 'Buku & Alat Tulis',
            'deskripsi' => 'Kotak pensil estetik.',
            'kondisi' => 'Baru',
            'jumlah' => 3,
            'status' => 'diproses',
        ]);

        DonationItem::create([
            'user_id' => $donor->id,
            'nama_barang' => 'Sepatu Sneaker Anak',
            'kategori' => 'Seragam & Sepatu Sekolah',
            'deskripsi' => 'Ukuran 34.',
            'kondisi' => 'Layak Pakai',
            'jumlah' => 1,
            'status' => 'Menunggu Verifikasi Transit',
        ]);

        $response = $this->actingAs($donor)->get(route('donor.my-donations', ['status' => 'diproses']));

        $response->assertStatus(200);
        $response->assertSee('Kotak Pensil Kayu');
        $response->assertDontSee('Sepatu Sneaker Anak');
    }

    /**
     * TC-04: Filter 'Selesai' hanya menampilkan donasi berstatus disalurkan.
     */
    public function test_filter_selesai_only_displays_completed_donations(): void
    {
        $donor = User::factory()->create(['role' => 'donor']);

        DonationItem::create([
            'user_id' => $donor->id,
            'nama_barang' => 'Paket Buku Tulis 10 Pcs',
            'kategori' => 'Buku & Alat Tulis',
            'deskripsi' => 'Buku tulis bergaris 38 lembar.',
            'kondisi' => 'Baru',
            'jumlah' => 2,
            'status' => 'disalurkan',
        ]);

        DonationItem::create([
            'user_id' => $donor->id,
            'nama_barang' => 'Meja Lipat Belajar',
            'kategori' => 'Alat Peraga & Praktikum',
            'deskripsi' => 'Meja lipat karakter anak.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 1,
            'status' => 'Menunggu Verifikasi Transit',
        ]);

        $response = $this->actingAs($donor)->get(route('donor.my-donations', ['status' => 'selesai']));

        $response->assertStatus(200);
        $response->assertSee('Paket Buku Tulis 10 Pcs');
        $response->assertDontSee('Meja Lipat Belajar');
    }

    /**
     * TC-05: Empty state kontekstual saat status tertentu tidak memiliki data.
     */
    public function test_shows_filter_specific_empty_state_when_status_has_no_items(): void
    {
        $donor = User::factory()->create(['role' => 'donor']);

        // Donatur hanya punya donasi status Menunggu
        DonationItem::create([
            'user_id' => $donor->id,
            'nama_barang' => 'Krayon Warna 24 Warna',
            'kategori' => 'Buku & Alat Tulis',
            'deskripsi' => 'Lengkap tanpa patah.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 1,
            'status' => 'Menunggu Verifikasi Transit',
        ]);

        // Cek filter Selesai yang kosong
        $response = $this->actingAs($donor)->get(route('donor.my-donations', ['status' => 'selesai']));

        $response->assertStatus(200);
        $response->assertSee('Tidak Ada Donasi dengan Status');
        $response->assertSee('Lihat Semua Riwayat Donasi');
    }

    /**
     * TC-06: Empty state global saat akun belum pernah donasi sama sekali.
     */
    public function test_shows_global_empty_state_when_donor_has_zero_donations(): void
    {
        $newDonor = User::factory()->create(['role' => 'donor']);

        $response = $this->actingAs($newDonor)->get(route('donor.my-donations'));

        $response->assertStatus(200);
        $response->assertSee('Belum Ada Riwayat Donasi');
        $response->assertSee('Mulai Donasi Sekarang');
    }

    /**
     * TC-07: Isolasi akun: data donatur lain tidak pernah bocor.
     */
    public function test_donor_cannot_see_other_donors_data_under_same_filter(): void
    {
        $donorA = User::factory()->create(['role' => 'donor']);
        $donorB = User::factory()->create(['role' => 'donor']);

        DonationItem::create([
            'user_id' => $donorA->id,
            'nama_barang' => 'Laptop Donatur A',
            'kategori' => 'Perangkat Elektronik & Belajar',
            'deskripsi' => 'Laptop untuk Donatur A.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 1,
            'status' => 'diproses',
        ]);

        DonationItem::create([
            'user_id' => $donorB->id,
            'nama_barang' => 'Laptop Donatur B (Rahasia)',
            'kategori' => 'Perangkat Elektronik & Belajar',
            'deskripsi' => 'Milik donatur B.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 1,
            'status' => 'diproses',
        ]);

        $response = $this->actingAs($donorA)->get(route('donor.my-donations', ['status' => 'diproses']));

        $response->assertStatus(200);
        $response->assertSee('Laptop Donatur A');
        $response->assertDontSee('Laptop Donatur B (Rahasia)');
    }

    /**
     * TC-08: Parameter status ilegal ditangani secara graceful tanpa error 500.
     */
    public function test_invalid_status_parameter_falls_back_gracefully(): void
    {
        $donor = User::factory()->create(['role' => 'donor']);

        DonationItem::create([
            'user_id' => $donor->id,
            'nama_barang' => 'Barang Valid',
            'kategori' => 'Buku & Alat Tulis',
            'deskripsi' => 'Barang donasi pengujian.',
            'kondisi' => 'Baru',
            'jumlah' => 1,
            'status' => 'Menunggu Verifikasi Transit',
        ]);

        $response = $this->actingAs($donor)->get(route('donor.my-donations', ['status' => 'status_ilegal_123']));

        $response->assertStatus(200);
        $response->assertSee('Barang Valid');
    }
}
