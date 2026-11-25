<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminUserManagementTest extends TestCase
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
            'email'       => 'admin.posko@test.com',
            'password'    => Hash::make('password123'),
            'role'        => 'admin',
            'status_akun' => 'aktif',
        ]);

        $this->donor = User::create([
            'name'        => 'Budi Donatur',
            'email'       => 'budi.donor@test.com',
            'password'    => Hash::make('password123'),
            'role'        => 'donor',
            'status_akun' => 'aktif',
        ]);

        $this->beneficiary = User::create([
            'name'        => 'Siti Penerima',
            'email'       => 'siti.penerima@test.com',
            'password'    => Hash::make('password123'),
            'role'        => 'beneficiary',
            'status_akun' => 'aktif',
        ]);
    }

    public function test_admin_can_view_and_filter_user_list(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.users.index'));
        $response->assertStatus(200);
        $response->assertSee('Budi Donatur');
        $response->assertSee('Siti Penerima');

        // Filter search + role
        $filtered = $this->actingAs($this->admin)->get(route('admin.users.index', [
            'search' => 'Budi',
            'role'   => 'donor',
        ]));
        $filtered->assertStatus(200);
        $filtered->assertSee('Budi Donatur');
        $filtered->assertDontSee('Siti Penerima');
    }

    public function test_non_admin_cannot_access_admin_user_management(): void
    {
        $this->actingAs($this->donor)
            ->get(route('admin.users.index'))
            ->assertStatus(403);

        $this->actingAs($this->beneficiary)
            ->patch(route('admin.users.suspend', $this->donor->id))
            ->assertStatus(403);
    }

    public function test_admin_can_suspend_user_and_blocks_login_and_active_session(): void
    {
        $response = $this->actingAs($this->admin)
            ->patch(route('admin.users.suspend', $this->donor->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id'          => $this->donor->id,
            'status_akun' => 'suspended',
        ]);

        // Logout admin session before testing suspended user login
        $this->post('/logout');

        // Suspended user cannot log in
        $loginAttempt = $this->post('/login', [
            'email'    => $this->donor->email,
            'password' => 'password123',
        ]);
        $loginAttempt->assertSessionHasErrors('email');
        $this->assertGuest();

        // Active session for suspended user is blocked by EnsureAccountIsActive middleware
        $this->donor->refresh();
        $blocked = $this->actingAs($this->donor)->get(route('items.create'));
        $blocked->assertRedirect(route('login'));
        $this->assertGuest();
    }

    public function test_admin_can_reactivate_user_and_creates_notifications(): void
    {
        $this->donor->update(['status_akun' => 'suspended']);

        $response = $this->actingAs($this->admin)
            ->patch(route('admin.users.activate', $this->donor->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id'          => $this->donor->id,
            'status_akun' => 'aktif',
        ]);

        $this->assertDatabaseHas('notifikasis', [
            'user_id'          => $this->donor->id,
            'judul_notifikasi' => 'Akun diaktifkan kembali',
        ]);

        $this->assertDatabaseHas('notifications', [
            'user_id' => $this->donor->id,
            'title'   => 'Akun Diaktifkan Kembali',
        ]);
    }
}
