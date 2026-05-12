<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthAndAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_open_account(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Иван',
            'email' => 'ivan@example.com',
            'phone' => '+7 900 111-22-33',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('account.dashboard'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'ivan@example.com',
            'phone' => '+7 900 111-22-33',
            'is_admin' => false,
        ]);
    }

    public function test_admin_panel_requires_admin_user(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_admin_can_open_dashboard(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Панель управления');
    }

    public function test_blocked_user_cannot_log_in(): void
    {
        User::factory()->create([
            'email' => 'blocked@example.com',
            'password' => Hash::make('password123'),
            'blocked_at' => now(),
        ]);

        $this->post(route('login.store'), [
            'email' => 'blocked@example.com',
            'password' => 'password123',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }
}
