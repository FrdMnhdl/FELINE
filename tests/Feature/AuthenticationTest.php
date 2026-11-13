<?php

namespace Tests\Feature;

use App\Models\Cat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_opening_admin_dashboard_is_redirected_to_login(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('login'));
    }

    public function test_guest_opening_cats_collection_or_detail_is_redirected_to_login(): void
    {
        $cat = Cat::factory()->create();

        $this->get(route('cats.index'))
            ->assertRedirect(route('login'));

        $this->get(route('cats.show', $cat))
            ->assertRedirect(route('login'));
    }

    public function test_valid_admin_logs_in_and_redirects_to_admin_dashboard(): void
    {
        $admin = User::factory()->admin()->create([
            'password' => 'secret-password',
        ]);

        $response = $this->post(route('login.store'), [
            'email' => $admin->email,
            'password' => 'secret-password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_valid_regular_user_logs_in_and_redirects_to_cat_collection(): void
    {
        $user = User::factory()->create([
            'password' => 'secret-password',
        ]);

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'secret-password',
        ]);

        $response->assertRedirect(route('cats.index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_invalid_credentials_return_validation_error_and_do_not_authenticate(): void
    {
        $user = User::factory()->create([
            'password' => 'correct-password',
        ]);

        $response = $this->from(route('login'))
            ->post(route('login.store'), [
                'email' => $user->email,
                'password' => 'wrong-password',
            ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_authenticated_users_are_redirected_away_from_login_page(): void
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $this->actingAs($admin)
            ->get(route('login'))
            ->assertRedirect(route('admin.dashboard'));

        $this->actingAs($user)
            ->get(route('login'))
            ->assertRedirect(route('cats.index'));
    }

    public function test_logout_invalidates_session_and_regenerates_csrf_token(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $this->session(['custom_key' => 'custom_value']);
        $previousToken = csrf_token();

        $response = $this->post(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertGuest();
        $this->assertNull(session('custom_key'));
        $this->assertNotSame($previousToken, csrf_token());

        $this->get(route('cats.index'))
            ->assertRedirect(route('login'));
    }

    public function test_logout_rejects_get_requests(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/logout')
            ->assertMethodNotAllowed();
    }
}
