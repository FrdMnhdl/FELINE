<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_root_redirects_guests_to_login(): void
    {
        $this->get('/')
            ->assertRedirect(route('login'));
    }

    public function test_root_redirects_authenticated_users_according_to_role(): void
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $this->actingAs($admin)
            ->get('/')
            ->assertRedirect(route('admin.dashboard'));

        $this->actingAs($user)
            ->get('/')
            ->assertRedirect(route('cats.index'));
    }
}
