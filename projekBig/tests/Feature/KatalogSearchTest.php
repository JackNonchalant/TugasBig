<?php

namespace Tests\Feature;

use App\Models\DonationItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class KatalogSearchTest extends TestCase
{
    use RefreshDatabase;

    protected User $donor;
    protected User $beneficiary;

    protected function setUp(): void
    {
        parent::setUp();

        $this->donor = User::create([
            'name'        => 'Donatur Uji',
            'email'       => 'donatur.search@test.com',
            'password'    => Hash::make('password123'),
            'role'        => 'donor',
            'status_akun' => 'aktif',
        ]);

        $this->beneficiary = User::create([
            'name'        => 'Penerima Uji',
            'email'       => 'penerima.search@test.com',
            'password'    => Hash::make('password123'),
            'role'        => 'beneficiary',
            'status_akun' => 'aktif',
        ]);
    }

    /**
     * PBI-007: Pencarian cocok pada nama barang, deskripsi, dan sebagian kata.
     */
    public function test_search_matches_exact_partial_name_and_description(): void
    {
        DonationItem::create([
            'user_id'     => $this->donor->id,
            'nama_barang' => 'Paket Buku Tematik SD Kelas 5',
            'kategori'    => 'Buku Pelajaran & Referensi',
            'deskripsi'   => 'Buku kurikulum merdeka lengkap dengan lembar latihan matematika.',
            'kondisi'     => 'Sangat Baik',
            'jumlah'      => 4,
            'status'      => 'tersedia',
        ]);

        DonationItem::create([
            'user_id'     => $this->donor->id,
            'nama_barang' => 'Seragam Pramuka Penggalang',
            'kategori'    => 'Seragam & Sepatu Sekolah',
            'deskripsi'   => 'Seragam ukuran M bersih dan rapi.',
            'kondisi'     => 'Layak Pakai',
            'jumlah'      => 2,
            'status'      => 'tersedia',
        ]);

        // Cocok berdasarkan nama (sebagian kata)
        $byName = $this->get(route('katalog.index', ['search' => 'Tematik']));
        $byName->assertStatus(200);
        $byName->assertSee('Paket Buku Tematik SD Kelas 5');
        $byName->assertDontSee('Seragam Pramuka Penggalang');

        // Cocok berdasarkan deskripsi
        $byDesc = $this->get(route('katalog.index', ['search' => 'matematika']));
        $byDesc->assertStatus(200);
        $byDesc->assertSee('Paket Buku Tematik SD Kelas 5');
        $byDesc->assertDontSee('Seragam Pramuka Penggalang');

        // Dashboard penerima juga mendukung pencarian yang sama
        $beneficiarySearch = $this->actingAs($this->beneficiary)
            ->get(route('beneficiary.dashboard', ['search' => 'Pramuka']));
        $beneficiarySearch->assertStatus(200);
        $beneficiarySearch->assertSee('Seragam Pramuka Penggalang');
        $beneficiarySearch->assertDontSee('Paket Buku Tematik SD Kelas 5');
    }

    /**
     * PBI-007: Tampilan menunjukkan pesan informasi jelas jika barang tidak ditemukan.
     */
    public function test_search_shows_clear_empty_message_when_no_items_match(): void
    {
        DonationItem::create([
            'user_id'     => $this->donor->id,
            'nama_barang' => 'Kalkulator Ilmiah',
            'kategori'    => 'Alat Peraga & Praktikum',
            'deskripsi'   => 'Kalkulator SMA berfungsi normal.',
            'kondisi'     => 'Sangat Baik',
            'jumlah'      => 1,
            'status'      => 'tersedia',
        ]);

        $response = $this->get(route('katalog.index', ['search' => 'MikroskopElektronXYZ']));
        $response->assertStatus(200);
        $response->assertSee('Barang tidak ditemukan.');
        $response->assertSee('MikroskopElektronXYZ');
        $response->assertSee('Reset Pencarian');
    }

    /**
     * PBI-007: Parameter query aman terhadap SQL injection & wildcard LIKE injection.
     */
    public function test_search_is_safe_against_sql_and_like_wildcard_injection(): void
    {
        DonationItem::create([
            'user_id'     => $this->donor->id,
            'nama_barang' => 'Tas Sekolah Kanvas',
            'kategori'    => 'Tas & Perlengkapan Belajar',
            'deskripsi'   => 'Tas kuat untuk anak SD.',
            'kondisi'     => 'Baru',
            'jumlah'      => 3,
            'status'      => 'tersedia',
        ]);

        // SQL injection attempt
        $sqli = $this->get(route('katalog.index', ['search' => "' OR '1'='1"]));
        $sqli->assertStatus(200);
        $sqli->assertDontSee('Tas Sekolah Kanvas');
        $sqli->assertSee('Barang tidak ditemukan.');

        // Raw '%' wildcard should be escaped and not match everything
        $wildcard = $this->get(route('katalog.index', ['search' => '%']));
        $wildcard->assertStatus(200);
        $wildcard->assertDontSee('Tas Sekolah Kanvas');
    }

    /**
     * PBI-008: Hanya menampilkan barang berstatus aktif/tersedia (jumlah > 0),
     * dan donatur dapat menguji pencarian untuk memastikan barangnya mudah ditemukan.
     */
    public function test_search_only_returns_active_available_items(): void
    {
        DonationItem::create([
            'user_id'     => $this->donor->id,
            'nama_barang' => 'Ensiklopedia Sains Aktif',
            'kategori'    => 'Buku Pelajaran & Referensi',
            'deskripsi'   => 'Ensiklopedia lengkap.',
            'kondisi'     => 'Baru',
            'jumlah'      => 2,
            'status'      => 'tersedia',
        ]);

        DonationItem::create([
            'user_id'     => $this->donor->id,
            'nama_barang' => 'Ensiklopedia Sains Menunggu',
            'kategori'    => 'Buku Pelajaran & Referensi',
            'deskripsi'   => 'Belum diverifikasi.',
            'kondisi'     => 'Baru',
            'jumlah'      => 2,
            'status'      => 'Menunggu Verifikasi Transit',
        ]);

        DonationItem::create([
            'user_id'     => $this->donor->id,
            'nama_barang' => 'Ensiklopedia Sains Disalurkan',
            'kategori'    => 'Buku Pelajaran & Referensi',
            'deskripsi'   => 'Sudah disalurkan.',
            'kondisi'     => 'Baru',
            'jumlah'      => 2,
            'status'      => 'Disalurkan',
        ]);

        DonationItem::create([
            'user_id'     => $this->donor->id,
            'nama_barang' => 'Ensiklopedia Sains Stok Habis',
            'kategori'    => 'Buku Pelajaran & Referensi',
            'deskripsi'   => 'Stok kosong.',
            'kondisi'     => 'Baru',
            'jumlah'      => 0,
            'status'      => 'tersedia',
        ]);

        $response = $this->actingAs($this->donor)
            ->get(route('katalog.index', ['search' => 'Ensiklopedia Sains']));

        $response->assertStatus(200);
        $response->assertSee('Ensiklopedia Sains Aktif');
        $response->assertDontSee('Ensiklopedia Sains Menunggu');
        $response->assertDontSee('Ensiklopedia Sains Disalurkan');
        $response->assertDontSee('Ensiklopedia Sains Stok Habis');
    }

    /**
     * PBI-008: Uji performa waktu respons pencarian < 3 detik pada dataset pengujian.
     */
    public function test_search_response_time_is_under_three_seconds(): void
    {
        $rows = [];
        $now = now();
        for ($i = 1; $i <= 150; $i++) {
            $isTarget = $i === 74;
            $rows[] = [
                'user_id'     => $this->donor->id,
                'nama_barang' => $isTarget ? 'Kamus Besar Bahasa Indonesia Target' : "Buku Pelajaran Seri #{$i}",
                'kategori'    => 'Buku Pelajaran & Referensi',
                'deskripsi'   => "Deskripsi lengkap perlengkapan belajar nomor {$i}.",
                'kondisi'     => 'Sangat Baik',
                'jumlah'      => $isTarget ? 3 : ($i % 5 === 0 ? 0 : 3),
                'status'      => $isTarget ? 'tersedia' : ($i % 3 === 0 ? 'Menunggu Verifikasi Transit' : 'tersedia'),
                'created_at'  => $now,
                'updated_at'  => $now,
            ];
        }
        DonationItem::insert($rows);

        $start = hrtime(true);
        $response = $this->get(route('katalog.index', ['search' => 'Kamus Besar']));
        $elapsedSeconds = (hrtime(true) - $start) / 1e9;

        $response->assertStatus(200);
        $response->assertSee('Kamus Besar Bahasa Indonesia Target');
        $this->assertLessThan(3.0, $elapsedSeconds, "Waktu respons pencarian melebihi 3 detik ({$elapsedSeconds}s).");
    }

    /**
     * PBI-009: Reset pencarian mengosongkan kata kunci dan memuat ulang seluruh katalog aktif
     * baik setelah pencarian berhasil maupun setelah hasil pencarian kosong.
     */
    public function test_reset_search_reloads_full_active_catalog(): void
    {
        DonationItem::create([
            'user_id'     => $this->donor->id,
            'nama_barang' => 'Buku Fisika SMA',
            'kategori'    => 'Buku Pelajaran & Referensi',
            'deskripsi'   => 'Buku fisika kelas 11.',
            'kondisi'     => 'Sangat Baik',
            'jumlah'      => 3,
            'status'      => 'tersedia',
        ]);

        DonationItem::create([
            'user_id'     => $this->donor->id,
            'nama_barang' => 'Sepatu Sekolah Hitam',
            'kategori'    => 'Seragam & Sepatu Sekolah',
            'deskripsi'   => 'Sepatu ukuran 39.',
            'kondisi'     => 'Layak Pakai',
            'jumlah'      => 1,
            'status'      => 'tersedia',
        ]);

        // 1. Setelah pencarian berhasil -> tombol Reset tampil
        $found = $this->get(route('katalog.index', ['search' => 'Fisika']));
        $found->assertStatus(200);
        $found->assertSee('Buku Fisika SMA');
        $found->assertDontSee('Sepatu Sekolah Hitam');
        $found->assertSee('Reset');

        // 2. Setelah pencarian kosong -> tombol Reset tampil
        $empty = $this->get(route('katalog.index', ['search' => 'TidakAdaBarangIni']));
        $empty->assertStatus(200);
        $empty->assertSee('Barang tidak ditemukan.');
        $empty->assertSee('Reset');

        // 3. Memanggil ulang endpoint katalog tanpa parameter (aksi tombol Reset)
        $reset = $this->get(route('katalog.index'));
        $reset->assertStatus(200);
        $reset->assertSee('Buku Fisika SMA');
        $reset->assertSee('Sepatu Sekolah Hitam');
        $reset->assertDontSee('Hasil pencarian untuk');
    }
}
