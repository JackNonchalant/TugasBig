<?php

namespace Tests\Feature;

use App\Models\DonationItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonationHistoryDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_view_donation_detail_with_recipient_and_receipt(): void
    {
        $donor = User::factory()->create(['name' => 'Budi Donatur', 'role' => 'donor']);

        $donation = DonationItem::create([
            'user_id'            => $donor->id,
            'nama_barang'        => 'Paket Buku Ensiklopedia',
            'kategori'           => 'Buku Pelajaran & Referensi',
            'deskripsi'          => '15 buku ensiklopedia kondisi sangat baik.',
            'kondisi'            => 'Sangat Baik',
            'jumlah'             => 15,
            'status'             => 'disalurkan',
            'recipient_name'     => 'Taman Baca Harapan Bangsa',
            'recipient_contact'  => 'Ibu Siti Aminah',
            'recipient_address'  => 'Jl. Melati No. 18, Bandung',
            'received_at'        => now(),
            'receipt_photo'      => 'receipts/foto-serah-terima.jpg',
            'receipt_document'   => 'receipts/bast-0041.pdf',
            'distribution_notes' => 'Diterima lengkap di rak baca anak.',
        ]);

        $response = $this->actingAs($donor)->get(route('donor.my-donations.show', $donation->id));

        $response->assertStatus(200);
        $response->assertSee('Akses Valid: Pemilik Transaksi');
        $response->assertSee('Paket Buku Ensiklopedia');
        $response->assertSee('Taman Baca Harapan Bangsa');
        $response->assertSee('Ibu Siti Aminah');
        $response->assertSee('Foto Serah Terima');
        $response->assertSee('Dokumen Serah Terima (BAST)');
        $response->assertSee('Kembali ke Riwayat Donasi');
    }

    public function test_admin_can_view_any_donation_detail(): void
    {
        $donor = User::factory()->create(['role' => 'donor']);
        $admin = User::factory()->create(['role' => 'admin']);

        $donation = DonationItem::create([
            'user_id'     => $donor->id,
            'nama_barang' => 'Laptop Belajar',
            'kategori'    => 'Perangkat Elektronik & Belajar',
            'deskripsi'   => 'Laptop layak pakai.',
            'kondisi'     => 'Layak Pakai',
            'jumlah'      => 1,
            'status'      => 'Menunggu Verifikasi Transit',
        ]);

        $response = $this->actingAs($admin)->get(route('donor.my-donations.show', $donation->id));

        $response->assertStatus(200);
        $response->assertSee('Akses Valid: Pihak Berwenang (Admin)');
        $response->assertSee('Laptop Belajar');
        $response->assertSee('Penerima Manfaat Belum Ditentukan');
        $response->assertSee('Bukti Penerimaan Belum Tersedia');
    }

    public function test_other_donor_or_unauthorized_user_gets_403_forbidden(): void
    {
        $owner = User::factory()->create(['role' => 'donor']);
        $otherDonor = User::factory()->create(['role' => 'donor']);
        $beneficiary = User::factory()->create(['role' => 'beneficiary']);

        $donation = DonationItem::create([
            'user_id'     => $owner->id,
            'nama_barang' => 'Seragam Sekolah',
            'kategori'    => 'Seragam & Sepatu Sekolah',
            'deskripsi'   => 'Seragam baru.',
            'kondisi'     => 'Baru',
            'jumlah'      => 5,
            'status'      => 'diproses',
        ]);

        $this->actingAs($otherDonor)
            ->get(route('donor.my-donations.show', $donation->id))
            ->assertStatus(403);

        $this->actingAs($beneficiary)
            ->get(route('donor.my-donations.show', $donation->id))
            ->assertStatus(403);
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $owner = User::factory()->create(['role' => 'donor']);
        $donation = DonationItem::create([
            'user_id'     => $owner->id,
            'nama_barang' => 'Tas Sekolah',
            'kategori'    => 'Tas & Perlengkapan Belajar',
            'deskripsi'   => 'Tas baru.',
            'kondisi'     => 'Baru',
            'jumlah'      => 2,
            'status'      => 'tersedia',
        ]);

        $this->get(route('donor.my-donations.show', $donation->id))
            ->assertRedirect(route('login'));
    }
}
