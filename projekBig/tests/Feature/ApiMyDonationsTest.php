<?php

namespace Tests\Feature;

use App\Models\DonationItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiMyDonationsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Skenario 1: Donatur hanya melihat riwayat donasi miliknya sendiri
     * dan diurutkan berdasarkan tanggal terbaru.
     */
    public function test_donor_only_receives_own_donations_ordered_by_date_desc(): void
    {
        $donorA = User::factory()->create(['role' => 'donor']);
        $donorB = User::factory()->create(['role' => 'donor']);

        $older = DonationItem::create([
            'user_id'     => $donorA->id,
            'nama_barang' => 'Buku Lama Donatur A',
            'kategori'    => 'Buku & Alat Tulis',
            'deskripsi'   => 'Buku cerita lama.',
            'kondisi'     => 'Layak Pakai',
            'jumlah'      => 1,
            'status'      => 'disalurkan',
        ]);
        $older->forceFill(['created_at' => now()->subDays(3)])->save();

        $newer = DonationItem::create([
            'user_id'     => $donorA->id,
            'nama_barang' => 'Tas Baru Donatur A',
            'kategori'    => 'Tas & Perlengkapan Belajar',
            'deskripsi'   => 'Tas sekolah baru.',
            'kondisi'     => 'Baru',
            'jumlah'      => 2,
            'status'      => 'Menunggu Verifikasi Transit',
        ]);
        $newer->forceFill(['created_at' => now()])->save();

        DonationItem::create([
            'user_id'     => $donorB->id,
            'nama_barang' => 'Laptop Donatur B',
            'kategori'    => 'Perangkat Elektronik & Belajar',
            'deskripsi'   => 'Laptop milik donatur lain.',
            'kondisi'     => 'Sangat Baik',
            'jumlah'      => 1,
            'status'      => 'diproses',
        ]);

        $response = $this->actingAs($donorA)->getJson(route('api.my-donations'));

        $response->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonCount(2, 'data')
            ->assertJsonPath('data.0.nama_barang', 'Tas Baru Donatur A')
            ->assertJsonPath('data.1.nama_barang', 'Buku Lama Donatur A')
            ->assertJsonMissing(['nama_barang' => 'Laptop Donatur B']);
    }

    /**
     * Skenario 2: Respons mengembalikan array kosong jika akun belum memiliki riwayat donasi.
     */
    public function test_returns_empty_array_when_donor_has_no_donations(): void
    {
        $newDonor = User::factory()->create(['role' => 'donor']);

        $response = $this->actingAs($newDonor)->getJson(route('api.my-donations'));

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data'    => [],
            ]);
    }

    /**
     * Skenario 3: Endpoint menolak akses (401 Unauthorized) jika belum login.
     */
    public function test_unauthenticated_request_returns_unauthorized(): void
    {
        $response = $this->getJson(route('api.my-donations'));

        $response->assertStatus(401);
    }
}
