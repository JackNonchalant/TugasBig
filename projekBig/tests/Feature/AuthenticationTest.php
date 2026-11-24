<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_login_page(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Selamat Datang Kembali');
    }

    /**
     * Pengujian 1: Donatur dapat login dan diarahkan ke halaman Donatur.
     */
    public function test_donor_can_login_and_is_redirected_to_donor_dashboard(): void
    {
        $donor = User::create([
            'name' => 'Donatur Test',
            'email' => 'donatur@test.com',
            'password' => Hash::make('password123'),
            'role' => 'donor',
        ]);

        $response = $this->post('/login', [
            'email' => 'donatur@test.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($donor);
        $response->assertRedirect(route('donor.dashboard'));

        $dashResponse = $this->actingAs($donor)->get(route('donor.dashboard'));
        $dashResponse->assertStatus(200);
        $dashResponse->assertSee('Dashboard Donatur');
        $dashResponse->assertSee('Donatur Test');
    }

    /**
     * Pengujian 2: Penerima Manfaat dapat login dan diarahkan ke halaman Penerima Manfaat.
     */
    public function test_beneficiary_can_login_and_is_redirected_to_beneficiary_dashboard(): void
    {
        $beneficiary = User::create([
            'name' => 'Penerima Test',
            'email' => 'penerima@test.com',
            'password' => Hash::make('password123'),
            'role' => 'beneficiary',
        ]);

        $response = $this->post('/login', [
            'email' => 'penerima@test.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($beneficiary);
        $response->assertRedirect(route('beneficiary.dashboard'));

        $dashResponse = $this->actingAs($beneficiary)->get(route('beneficiary.dashboard'));
        $dashResponse->assertStatus(200);
        $dashResponse->assertSee('Dashboard Penerima');
        $dashResponse->assertSee('Penerima Test');
    }

    /**
     * Pengujian 3: Admin dapat login dan diarahkan ke halaman Admin.
     */
    public function test_admin_can_login_and_is_redirected_to_admin_dashboard(): void
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('admin.dashboard'));
    }

    /**
     * Pengujian 4: Pengguna yang belum login tidak dapat membuka halaman yang dilindungi.
     */
    public function test_unauthenticated_user_cannot_access_protected_pages(): void
    {
        $this->get('/donor/dashboard')->assertRedirect(route('login'));
        $this->get('/beneficiary/dashboard')->assertRedirect(route('login'));
        $this->get('/admin/dashboard')->assertRedirect(route('login'));
        $this->get('/items/create')->assertRedirect(route('login'));
    }

    /**
     * Pengujian 5: Donatur tidak dapat membuka halaman khusus Admin.
     */
    public function test_donor_cannot_access_admin_dashboard(): void
    {
        $donor = User::create([
            'name' => 'Donatur Test',
            'email' => 'donatur@test.com',
            'password' => Hash::make('password123'),
            'role' => 'donor',
        ]);

        $response = $this->actingAs($donor)->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    /**
     * Pengujian 6: Penerima Manfaat tidak dapat membuka halaman khusus Admin.
     */
    public function test_beneficiary_cannot_access_admin_dashboard(): void
    {
        $beneficiary = User::create([
            'name' => 'Penerima Test',
            'email' => 'penerima@test.com',
            'password' => Hash::make('password123'),
            'role' => 'beneficiary',
        ]);

        $response = $this->actingAs($beneficiary)->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    /**
     * Pengujian 7: Registrasi tidak memungkinkan pengguna membuat akun Admin.
     */
    public function test_registration_strictly_forbids_admin_role(): void
    {
        $response = $this->post('/register', [
            'name' => 'Hacker Admin',
            'email' => 'hacker@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'admin',
        ]);

        $response->assertSessionHasErrors('role');
        $this->assertDatabaseMissing('users', ['email' => 'hacker@test.com']);
    }

    public function test_user_can_register_as_donor(): void
    {
        $response = $this->post('/register', [
            'name' => 'Donatur Baru',
            'email' => 'donorbaru@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'donor',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'donorbaru@test.com',
            'role' => 'donor',
        ]);
        $response->assertRedirect(route('donor.dashboard'));
    }

    public function test_user_can_register_as_beneficiary(): void
    {
        $response = $this->post('/register', [
            'name' => 'Penerima Baru',
            'email' => 'penerimabaru@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'beneficiary',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'penerimabaru@test.com',
            'role' => 'beneficiary',
        ]);
        $response->assertRedirect(route('beneficiary.dashboard'));
    }

    /**
     * Pengujian 12: Logout berjalan dengan benar.
     */
    public function test_authenticated_user_can_logout(): void
    {
        $user = User::create([
            'name' => 'User Logout',
            'email' => 'logout@test.com',
            'password' => Hash::make('password123'),
            'role' => 'donor',
        ]);

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect(route('login'));
    }

    public function test_invalid_login_credentials_displays_error(): void
    {
        User::create([
            'name' => 'User Test',
            'email' => 'valid@test.com',
            'password' => Hash::make('correctpassword'),
            'role' => 'donor',
        ]);

        $response = $this->post('/login', [
            'email' => 'valid@test.com',
            'password' => 'wrongpassword',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }
}
