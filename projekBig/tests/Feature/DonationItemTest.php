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

    public function test_donor_can_view_item_creation_form(): void
    {
        $response = $this->actingAs($this->donor)->get('/items/create');
        $response->assertStatus(200);
        $response->assertSee('Posting Barang Donasi Pendidikan');
    }

    public function test_beneficiary_cannot_access_item_creation_form(): void
    {
        $response = $this->actingAs($this->beneficiary)->get('/items/create');
        $response->assertStatus(403);
    }

    /**
     * Pengujian 8 & 9: Donatur dapat mengisi dan mengirim form posting barang,
     * serta data tersimpan di database.
     */
    public function test_donor_can_post_donation_item_and_persisted_in_database(): void
    {
        $itemData = [
            'nama_barang' => 'Kamus Lengkap Bahasa Indonesia',
            'kategori' => 'Buku Pelajaran & Referensi',
            'deskripsi' => 'Kamus edisi terbaru, kondisi sangat terawat dan siap pakai.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 3,
        ];

        $response = $this->actingAs($this->donor)->post('/items', $itemData);

        // Data barang berhasil tersimpan di database
        $this->assertDatabaseHas('donation_items', [
            'user_id' => $this->donor->id,
            'nama_barang' => 'Kamus Lengkap Bahasa Indonesia',
            'kategori' => 'Buku Pelajaran & Referensi',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 3,
            'status' => 'Menunggu Verifikasi Transit',
        ]);

        $item = DonationItem::where('nama_barang', 'Kamus Lengkap Bahasa Indonesia')->first();
        $this->assertNotNull($item);

        // Diarahkan ke halaman detail barang
        $response->assertRedirect(route('items.show', $item->id));
        $response->assertSessionHas('success');
    }

    /**
     * Pengujian 10: Foto barang berhasil diunggah dan disimpan di Laravel Storage.
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
     * Pengujian 11: Detail barang berhasil menampilkan data sesuai ID.
     */
    public function test_item_detail_displays_correct_data_by_id(): void
    {
        $item = DonationItem::create([
            'user_id' => $this->donor->id,
            'nama_barang' => 'Atlas Dunia Indonesia & Mancanegara',
            'kategori' => 'Buku Pelajaran & Referensi',
            'deskripsi' => 'Atlas edisi terbaru warna-warni untuk pelajaran Geografi.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 2,
            'status' => 'tersedia',
        ]);

        $response = $this->actingAs($this->beneficiary)->get('/items/' . $item->id);

        $response->assertStatus(200);
        $response->assertSee('Atlas Dunia Indonesia & Mancanegara');
        $response->assertSee('Buku Pelajaran & Referensi');
        $response->assertSee('Sangat Baik');
        $response->assertSee('Donatur Test');
    }

    public function test_item_detail_returns_404_when_item_does_not_exist(): void
    {
        $response = $this->actingAs($this->beneficiary)->get('/items/999999');
        $response->assertStatus(404);
    }

    public function test_validation_fails_when_required_fields_are_empty(): void
    {
        $response = $this->actingAs($this->donor)->post('/items', []);

        $response->assertSessionHasErrors([
            'nama_barang',
            'kategori',
            'deskripsi',
            'kondisi',
            'jumlah',
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
        // 1. Uji validasi field wajib
        $emptyResponse = $this->actingAs($this->donor)->post('/items', []);
        $emptyResponse->assertSessionHasErrors([
            'nama_barang',
            'kategori',
            'deskripsi',
            'kondisi',
            'jumlah',
        ]);

        // 2. Uji validasi nilai tidak valid (jumlah < 1, kondisi tidak valid)
        $invalidResponse = $this->actingAs($this->donor)->post('/items', [
            'nama_barang' => 'Buku Matematika',
            'kategori' => 'Buku Pelajaran & Referensi',
            'deskripsi' => 'Buku bagus',
            'kondisi' => 'Kondisi Rusak',
            'jumlah' => 0,
        ]);
        $invalidResponse->assertSessionHasErrors(['kondisi', 'jumlah']);

        // 3. Uji penyimpanan data lengkap: pastikan status awal otomatis "Menunggu Verifikasi Transit"
        $validData = [
            'nama_barang' => 'Ensiklopedia Sains Anak Bergambar',
            'kategori' => 'Buku Pelajaran & Referensi',
            'deskripsi' => '1 set ensiklopedia sains lengkap 5 jilid kondisi sangat bagus.',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 1,
        ];

        $storeResponse = $this->actingAs($this->donor)->post('/items', $validData);

        // Pastikan tersimpan dengan status 'Menunggu Verifikasi Transit'
        $this->assertDatabaseHas('donation_items', [
            'user_id' => $this->donor->id,
            'nama_barang' => 'Ensiklopedia Sains Anak Bergambar',
            'kategori' => 'Buku Pelajaran & Referensi',
            'kondisi' => 'Sangat Baik',
            'jumlah' => 1,
            'status' => 'Menunggu Verifikasi Transit',
        ]);

        $item = DonationItem::where('nama_barang', 'Ensiklopedia Sains Anak Bergambar')->first();
        $this->assertEquals('Menunggu Verifikasi Transit', $item->status);
        $storeResponse->assertRedirect(route('items.show', $item->id));
        $storeResponse->assertSessionHas('success');
    }
}
