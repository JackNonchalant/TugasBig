<?php

namespace Tests\Feature;

use App\Models\DonationItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminItemVerificationTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $donor;
    protected User $beneficiary;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'name'        => 'Admin Posko',
            'email'       => 'admin.verify@test.com',
            'password'    => Hash::make('password123'),
            'role'        => 'admin',
            'status_akun' => 'aktif',
        ]);

        $this->donor = User::create([
            'name'        => 'Donatur Verif',
            'email'       => 'donor.verify@test.com',
            'password'    => Hash::make('password123'),
            'role'        => 'donor',
            'status_akun' => 'aktif',
        ]);

        $this->beneficiary = User::create([
            'name'        => 'Penerima Verif',
            'email'       => 'beneficiary.verify@test.com',
            'password'    => Hash::make('password123'),
            'role'        => 'beneficiary',
            'status_akun' => 'aktif',
        ]);
    }

    public function test_non_admin_cannot_access_or_verify_items(): void
    {
        $item = DonationItem::create([
            'user_id'     => $this->donor->id,
            'nama_barang' => 'Buku Bahasa Inggris',
            'kategori'    => 'Buku Pelajaran & Referensi',
            'deskripsi'   => 'Buku SMA kelas 10.',
            'kondisi'     => 'Sangat Baik',
            'jumlah'      => 2,
            'status'      => 'Menunggu Verifikasi Transit',
        ]);

        $this->actingAs($this->donor)->get(route('admin.items.index'))->assertStatus(403);
        $this->actingAs($this->donor)->patch(route('admin.items.approve', $item->id))->assertStatus(403);
        $this->actingAs($this->beneficiary)->patch(route('admin.items.reject', $item->id))->assertStatus(403);
    }

    public function test_admin_can_approve_item_and_it_becomes_visible_in_catalog(): void
    {
        $item = DonationItem::create([
            'user_id'     => $this->donor->id,
            'nama_barang' => 'Paket Geometri SMP',
            'kategori'    => 'Alat Peraga & Praktikum',
            'deskripsi'   => 'Penggaris, busur, jangka lengkap.',
            'kondisi'     => 'Baru',
            'jumlah'      => 5,
            'status'      => 'Menunggu Verifikasi Transit',
        ]);

        // Sebelum diverifikasi -> tidak tampil di katalog
        $this->get(route('katalog.index'))->assertDontSee('Paket Geometri SMP');

        // Admin membuka daftar verifikasi & menyetujui barang
        $this->actingAs($this->admin)
            ->get(route('admin.items.index'))
            ->assertStatus(200)
            ->assertSee('Paket Geometri SMP');

        $response = $this->actingAs($this->admin)
            ->patch(route('admin.items.approve', $item->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('donation_items', [
            'id'     => $item->id,
            'status' => 'tersedia',
        ]);

        // Notifikasi terkirim ke donatur
        $this->assertDatabaseHas('notifications', [
            'user_id' => $this->donor->id,
            'title'   => 'Barang Donasi Lolos Verifikasi',
            'type'    => 'success',
        ]);

        // Sesudah diverifikasi -> langsung tampil di katalog & pencarian
        $this->get(route('katalog.index', ['search' => 'Geometri']))
            ->assertStatus(200)
            ->assertSee('Paket Geometri SMP');
    }

    public function test_admin_can_reject_item_with_reason_and_item_stays_hidden(): void
    {
        $item = DonationItem::create([
            'user_id'     => $this->donor->id,
            'nama_barang' => 'Buku Sobek Parah',
            'kategori'    => 'Buku & Alat Tulis',
            'deskripsi'   => 'Banyak halaman hilang.',
            'kondisi'     => 'Layak Pakai',
            'jumlah'      => 1,
            'status'      => 'Menunggu Verifikasi Transit',
        ]);

        $response = $this->actingAs($this->admin)
            ->patch(route('admin.items.reject', $item->id), [
                'alasan' => 'Halaman buku tidak lengkap untuk dipakai belajar.',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('donation_items', [
            'id'     => $item->id,
            'status' => 'ditolak',
        ]);

        $this->assertDatabaseHas('notifications', [
            'user_id' => $this->donor->id,
            'title'   => 'Barang Donasi Belum Lolos Verifikasi',
            'type'    => 'warning',
        ]);

        // Cek sebagai penerima manfaat (sesi berbeda tanpa flash admin) -> barang tidak tampil di katalog
        $this->flushSession();
        $this->actingAs($this->beneficiary)
            ->get(route('katalog.index'))
            ->assertDontSee('Buku Sobek Parah');
    }

    public function test_cannot_reverify_already_approved_item(): void
    {
        $item = DonationItem::create([
            'user_id'     => $this->donor->id,
            'nama_barang' => 'Tas Sekolah SD',
            'kategori'    => 'Tas & Perlengkapan Belajar',
            'deskripsi'   => 'Sudah tersedia.',
            'kondisi'     => 'Sangat Baik',
            'jumlah'      => 2,
            'status'      => 'tersedia',
        ]);

        $response = $this->actingAs($this->admin)
            ->patch(route('admin.items.reject', $item->id));

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('donation_items', [
            'id'     => $item->id,
            'status' => 'tersedia',
        ]);
    }
}
