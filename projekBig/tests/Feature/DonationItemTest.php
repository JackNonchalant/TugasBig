<?php

namespace Tests\Feature;

use App\Models\DonationItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DonationItemTest extends TestCase
{
    use RefreshDatabase;

    protected User $donor;
    protected User $beneficiary;
    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->donor = User::create([
            'name' => 'Donatur Test',
            'email' => 'donor@test.com',
            'password' => Hash::make('password123'),
            'role' => 'donor',
        ]);

        $this->beneficiary = User::create([
            'name' => 'Penerima Test',
            'email' => 'beneficiary@test.com',
            'password' => Hash::make('password123'),
            'role' => 'beneficiary',
        ]);

        $this->admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
    }

    /**
     * Checklist 1 & 2:
     * - Buat komponen pemilihan lokasi posko transit dan tanggal penyerahan.
     * - Ambil dan tampilkan daftar lokasi posko transit yang dapat dipilih.
     */
    public function test_donor_can_view_item_creation_form_with_posko_and_date(): void
    {
        $response = $this->actingAs($this->donor)->get('/items/create');
        $response->assertStatus(200);
        $response->assertSee('Posting Barang Donasi Pendidikan');
        $response->assertSee('Pilih Posko Transit');
        $response->assertSee('Tanggal Penyerahan');
        $response->assertSee('Posko Transit Pusat (Jl. Pendidikan No. 45, Bandung)');
        $response->assertSee('Posko Transit Dago (Jl. Ir. H. Juanda No. 120, Bandung)');
    }

    public function test_beneficiary_cannot_access_item_creation_form(): void
    {
        $response = $this->actingAs($this->beneficiary)->get('/items/create');
        $response->assertStatus(403);
    }

    /**
     * Checklist 3 & 4:
     * - Buat field penyimpanan lokasi posko dan jadwal penyerahan pada basis data.
     * - Buat endpoint untuk menyimpan serta mengambil lokasi dan jadwal posting.
     */
    public function test_donor_can_post_donation_item_and_persisted_in_database(): void
    {
        $itemData = [
            'nama_barang' => 'Kamus Lengkap Bahasa Indonesia',
            'kategori' => 'Buku Pelajaran & Referensi',
            'deskripsi' => 'Kamus edisi terbaru, kondisi sangat terawat dan siap pakai.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 3,
            'lokasi_posko' => 'Posko Transit Pusat (Jl. Pendidikan No. 45, Bandung)',
            'jadwal_penyerahan' => now()->addDay()->format('Y-m-d'),
        ];

        $response = $this->actingAs($this->donor)->post('/items', $itemData);

        // Data barang berhasil tersimpan di database dengan lokasi dan jadwal penyerahan
        $this->assertDatabaseHas('donation_items', [
            'user_id' => $this->donor->id,
            'nama_barang' => 'Kamus Lengkap Bahasa Indonesia',
            'kategori' => 'Buku Pelajaran & Referensi',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 3,
            'lokasi_posko' => 'Posko Transit Pusat (Jl. Pendidikan No. 45, Bandung)',
            'status' => 'Menunggu Verifikasi Transit',
        ]);

        $item = DonationItem::where('nama_barang', 'Kamus Lengkap Bahasa Indonesia')->first();
        $this->assertNotNull($item);
        $this->assertNotNull($item->jadwal_penyerahan);
        $this->assertEquals(now()->addDay()->format('Y-m-d'), $item->jadwal_penyerahan->format('Y-m-d'));

        // Diarahkan ke halaman detail barang
        $response->assertRedirect(route('items.show', $item->id));
        $response->assertSessionHas('success');
    }

    /**
     * Pengujian foto barang berhasil diunggah dan disimpan di Laravel Storage.
     */
    public function test_item_photo_can_be_uploaded_and_saved_to_storage(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('buku_tematik.jpg', 600, 600);

        $response = $this->actingAs($this->donor)->post('/items', [
            'nama_barang' => 'Buku Tematik SD Kelas 1',
            'kategori' => 'Buku Pelajaran & Referensi',
            'deskripsi' => 'Buku kurikulum merdeka SD kelas 1 lengkap.',
            'kondisi' => 'Baru',
            'jumlah' => 5,
            'lokasi_posko' => 'Posko Transit Dago (Jl. Ir. H. Juanda No. 120, Bandung)',
            'jadwal_penyerahan' => now()->addDays(2)->format('Y-m-d'),
            'foto' => $file,
        ]);

        $item = DonationItem::where('nama_barang', 'Buku Tematik SD Kelas 1')->first();
        $this->assertNotNull($item);
        $this->assertNotNull($item->foto);

        // Assert file exists in storage disk
        Storage::disk('public')->assertExists($item->foto);
        $response->assertRedirect(route('items.show', $item->id));
    }

    /**
     * Checklist 6:
     * - Uji apakah lokasi dan jadwal tersimpan serta tampil pada detail postingan.
     */
    public function test_item_detail_displays_correct_data_and_posko_and_schedule(): void
    {
        $item = DonationItem::create([
            'user_id' => $this->donor->id,
            'nama_barang' => 'Atlas Dunia Indonesia & Mancanegara',
            'kategori' => 'Buku Pelajaran & Referensi',
            'deskripsi' => 'Atlas edisi terbaru warna-warni untuk pelajaran Geografi.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 2,
            'lokasi_posko' => 'Posko Transit Dago (Jl. Ir. H. Juanda No. 120, Bandung)',
            'jadwal_penyerahan' => now()->addDays(3)->format('Y-m-d'),
            'status' => 'Menunggu Verifikasi Transit',
        ]);

        $response = $this->actingAs($this->beneficiary)->get('/items/' . $item->id);

        $response->assertStatus(200);
        $response->assertSee('Atlas Dunia Indonesia & Mancanegara');
        $response->assertSee('Buku Pelajaran & Referensi');
        $response->assertSee('Sangat Baik');
        $response->assertSee('Donatur Test');
        // Lokasi posko dan jadwal penyerahan tampil pada detail postingan
        $response->assertSee('Posko Transit Dago (Jl. Ir. H. Juanda No. 120, Bandung)');
        $response->assertSee(now()->addDays(3)->format('d M Y'));
    }

    public function test_item_detail_returns_404_when_item_does_not_exist(): void
    {
        $response = $this->actingAs($this->beneficiary)->get('/items/999999');
        $response->assertStatus(404);
    }

    /**
     * Checklist 5:
     * - Validasi tanggal penyerahan dan pilihan lokasi sebelum data dikirim.
     */
    public function test_validation_fails_when_required_fields_are_empty(): void
    {
        $response = $this->actingAs($this->donor)->post('/items', []);

        $response->assertSessionHasErrors([
            'nama_barang',
            'kategori',
            'deskripsi',
            'kondisi',
            'jumlah',
            'lokasi_posko',
            'jadwal_penyerahan',
        ]);
    }

    /**
     * Checklist 5:
     * - Validasi pilihan lokasi posko tidak valid dan tanggal penyerahan di masa lalu.
     */
    public function test_validation_rejects_invalid_posko_and_past_schedule_date(): void
    {
        $response = $this->actingAs($this->donor)->post('/items', [
            'nama_barang' => 'Alat Musik Pianika Sekolah',
            'kategori' => 'Alat Peraga & Praktikum',
            'deskripsi' => 'Pianika lengkap dengan selang dan tas tiup.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 1,
            'lokasi_posko' => 'Posko Antah Berantah Tidak Terdaftar',
            'jadwal_penyerahan' => now()->subDays(2)->format('Y-m-d'), // tanggal masa lalu!
        ]);

        $response->assertSessionHasErrors([
            'lokasi_posko',
            'jadwal_penyerahan',
        ]);
    }

    /**
     * Acceptance Criteria:
     * 1. Tetapkan status awal posting menjadi "Menunggu Verifikasi Transit".
     * 2. Uji penyimpanan data ke database.
     * 3. Uji validasi field wajib berdasarkan Acceptance Criteria.
     */
    public function test_initial_status_is_menunggu_verifikasi_transit_and_validates_required_fields(): void
    {
        $validData = [
            'nama_barang' => 'Ensiklopedia Sains Anak Bergambar',
            'kategori' => 'Buku Pelajaran & Referensi',
            'deskripsi' => '1 set ensiklopedia sains lengkap 5 jilid kondisi sangat bagus.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 1,
            'lokasi_posko' => 'Posko Transit Pusat (Jl. Pendidikan No. 45, Bandung)',
            'jadwal_penyerahan' => now()->addDays(2)->format('Y-m-d'),
        ];

        $storeResponse = $this->actingAs($this->donor)->post('/items', $validData);

        // Pastikan tersimpan dengan status 'Menunggu Verifikasi Transit'
        $this->assertDatabaseHas('donation_items', [
            'user_id' => $this->donor->id,
            'nama_barang' => 'Ensiklopedia Sains Anak Bergambar',
            'kategori' => 'Buku Pelajaran & Referensi',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 1,
            'lokasi_posko' => 'Posko Transit Pusat (Jl. Pendidikan No. 45, Bandung)',
            'status' => 'Menunggu Verifikasi Transit',
        ]);

        $item = DonationItem::where('nama_barang', 'Ensiklopedia Sains Anak Bergambar')->first();
        $this->assertEquals('Menunggu Verifikasi Transit', $item->status);
        $this->assertNotNull($item->jadwal_penyerahan);
        $storeResponse->assertRedirect(route('items.show', $item->id));
        $storeResponse->assertSessionHas('success');
    }

    /**
     * Pengujian formulir pengajuan permintaan barang oleh penerima manfaat.
     */
    public function test_beneficiary_can_view_claim_form_and_submit_claim(): void
    {
        $item = DonationItem::create([
            'user_id' => $this->donor->id,
            'nama_barang' => 'Kamus Lengkap Bahasa Inggris',
            'kategori' => 'Buku Pelajaran & Referensi',
            'deskripsi' => 'Kamus tebal kondisi sangat baik.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 3,
            'lokasi_posko' => 'Posko Transit Pusat (Jl. Pendidikan No. 45, Bandung)',
            'jadwal_penyerahan' => now()->addDays(2)->format('Y-m-d'),
            'status' => 'tersedia',
        ]);

        $viewResponse = $this->actingAs($this->beneficiary)->get(route('items.claim', $item->id));
        $viewResponse->assertStatus(200);
        $viewResponse->assertSee('Formulir Pengajuan Permintaan Barang');
        $viewResponse->assertSee('Kamus Lengkap Bahasa Inggris');

        $submitResponse = $this->actingAs($this->beneficiary)->post(route('items.claim.submit', $item->id), [
            'jumlah' => 2,
            'alasan_kebutuhan' => 'Untuk mendukung perpustakaan sekolah panti asuhan.',
        ]);

        $submitResponse->assertRedirect(route('permintaan.index'));
        $submitResponse->assertSessionHas('success');
    }

    /**
     * Verifikasi Posko Transit:
     * - Admin dapat melihat antrean verifikasi barang donasi.
     * - Admin dapat menyetujui barang menjadi 'tersedia'.
     * - Admin dapat menolak barang donasi dengan alasan wajib.
     */
    public function test_admin_can_access_verification_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.verifikasi'));
        $response->assertStatus(200);
        $response->assertSee('Verifikasi Barang Donasi');
        $response->assertSee('Posko Transit • Kurasi Kualitas Barang');
    }

    public function test_admin_can_access_inventory_catalog_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Manajemen Katalog Barang');
        $response->assertSee('Total di Katalog');
    }

    public function test_admin_can_approve_donation_item(): void
    {
        $item = DonationItem::create([
            'user_id' => $this->donor->id,
            'nama_barang' => 'Seragam Pramuka Penggalang',
            'kategori' => 'Seragam & Sepatu Sekolah',
            'deskripsi' => 'Seragam bersih lengkap atribut.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 2,
            'lokasi_posko' => 'Posko Transit Pusat (Jl. Pendidikan No. 45, Bandung)',
            'jadwal_penyerahan' => now()->addDay()->format('Y-m-d'),
            'status' => 'Menunggu Verifikasi Transit',
        ]);

        $response = $this->actingAs($this->admin)->post(route('admin.items.verify', $item->id), [
            'action' => 'approve',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $item->refresh();
        $this->assertEquals('tersedia', $item->status);
    }

    public function test_admin_can_reject_donation_item_with_mandatory_reason(): void
    {
        $item = DonationItem::create([
            'user_id' => $this->donor->id,
            'nama_barang' => 'Buku Cetak Matematika Sobek',
            'kategori' => 'Buku Pelajaran & Referensi',
            'deskripsi' => 'Buku bekas.',
            'kondisi' => 'Layak Pakai',
            'jumlah' => 1,
            'lokasi_posko' => 'Posko Transit Dago (Jl. Ir. H. Juanda No. 120, Bandung)',
            'jadwal_penyerahan' => now()->addDay()->format('Y-m-d'),
            'status' => 'Menunggu Verifikasi Transit',
        ]);

        // Gagal jika alasan kosong
        $failResponse = $this->actingAs($this->admin)->post(route('admin.items.verify', $item->id), [
            'action' => 'reject',
            'rejection_reason' => '',
        ]);
        $failResponse->assertSessionHasErrors('rejection_reason');

        // Berhasil jika alasan diisi
        $successResponse = $this->actingAs($this->admin)->post(route('admin.items.verify', $item->id), [
            'action' => 'reject',
            'rejection_reason' => 'Kondisi buku memiliki lembar halaman bab 3 dan 4 yang hilang.',
        ]);

        $successResponse->assertRedirect();
        $successResponse->assertSessionHas('warning');

        $item->refresh();
        $this->assertEquals('ditolak', $item->status);
        $this->assertEquals('Kondisi buku memiliki lembar halaman bab 3 dan 4 yang hilang.', $item->alasan_penolakan);
    }

    public function test_donor_cannot_verify_items(): void
    {
        $item = DonationItem::create([
            'user_id' => $this->donor->id,
            'nama_barang' => 'Tas Sekolah Eiger',
            'kategori' => 'Tas & Perlengkapan Belajar',
            'deskripsi' => 'Tas ransel kuat.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 1,
            'lokasi_posko' => 'Posko Transit Pusat (Jl. Pendidikan No. 45, Bandung)',
            'jadwal_penyerahan' => now()->addDay()->format('Y-m-d'),
            'status' => 'Menunggu Verifikasi Transit',
        ]);

        $response = $this->actingAs($this->donor)->post(route('admin.items.verify', $item->id), [
            'action' => 'approve',
        ]);

        $response->assertStatus(403);
    }
}
