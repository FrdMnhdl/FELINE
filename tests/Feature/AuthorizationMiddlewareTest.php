<?php

namespace Tests\Feature;

use App\Http\Middleware\EnsureUserRole;
use App\Http\Middleware\LogRequestMiddleware;
use App\Models\Cat;
use App\Models\User;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class AuthorizationMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_regular_user_is_denied_access_to_admin_dashboard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertForbidden();

        $this->actingAs($user)
            ->getJson(route('admin.dashboard'))
            ->assertForbidden()
            ->assertJsonStructure(['message']);
    }

    public function test_regular_user_is_denied_access_to_create_and_store_cat(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.cats.create'))
            ->assertForbidden();

        $this->actingAs($user)
            ->post(route('admin.cats.store'), [
                'name' => 'Unauthorized Cat',
                'breed' => 'Tabby',
                'age' => '1 tahun',
                'gender' => 'Jantan',
                'description' => 'Harusnya keblokir middleware.',
            ])
            ->assertForbidden();

        $this->assertDatabaseCount('cats', 0);
    }

    public function test_regular_user_is_denied_access_to_edit_and_update_cat(): void
    {
        $user = User::factory()->create();
        $cat = Cat::factory()->create(['name' => 'Original Name']);

        $this->actingAs($user)
            ->get(route('admin.cats.edit', $cat))
            ->assertForbidden();

        $this->actingAs($user)
            ->put(route('admin.cats.update', $cat), [
                'name' => 'Tampered Name',
                'breed' => $cat->breed,
                'age' => $cat->age,
                'gender' => $cat->gender,
                'description' => $cat->description,
            ])
            ->assertForbidden();

        $this->assertSame('Original Name', $cat->fresh()->name);
    }

    public function test_regular_user_is_denied_access_to_delete_cat(): void
    {
        $user = User::factory()->create();
        $cat = Cat::factory()->create();

        $this->actingAs($user)
            ->delete(route('admin.cats.destroy', $cat))
            ->assertForbidden();

        $this->assertDatabaseHas('cats', ['id' => $cat->id]);
    }

    public function test_admin_can_access_all_administrative_and_gallery_pages(): void
    {
        $admin = User::factory()->admin()->create();
        $cat = Cat::factory()->create(['created_by' => $admin->id]);

        $this->actingAs($admin)->get(route('admin.dashboard'))->assertOk();
        $this->actingAs($admin)->get(route('admin.cats.create'))->assertOk();
        $this->actingAs($admin)->get(route('admin.cats.edit', $cat))->assertOk();
        $this->actingAs($admin)->get(route('cats.index'))->assertOk();
        $this->actingAs($admin)->get(route('cats.show', $cat))->assertOk();
    }

    public function test_routes_have_expected_authentication_and_role_middleware_configured(): void
    {
        app(Kernel::class);

        $router = Route::getRoutes();

        $adminDashboard = $router->getByName('admin.dashboard');
        $this->assertContains('auth', $adminDashboard->gatherMiddleware());
        $this->assertContains('role:admin', $adminDashboard->gatherMiddleware());

        $adminDestroy = $router->getByName('admin.cats.destroy');
        $this->assertContains('auth', $adminDestroy->gatherMiddleware());
        $this->assertContains('role:admin', $adminDestroy->gatherMiddleware());

        $catsIndex = $router->getByName('cats.index');
        $this->assertContains('auth', $catsIndex->gatherMiddleware());
        $this->assertContains('role:admin,user', $catsIndex->gatherMiddleware());

        $aliases = app('router')->getMiddleware();
        $this->assertSame(EnsureUserRole::class, $aliases['role'] ?? null);
        $this->assertSame(LogRequestMiddleware::class, $aliases['log.request'] ?? null);

        $webGroup = app('router')->getMiddlewareGroups()['web'] ?? [];
        $this->assertContains(LogRequestMiddleware::class, $webGroup);
    }

    public function test_user_role_and_cat_creator_cannot_be_mass_assigned(): void
    {
        $user = new User([
            'name' => 'Visitor',
            'email' => 'visitor@example.com',
            'password' => 'password',
            'role' => User::ROLE_ADMIN,
        ]);

        $this->assertNull($user->role);

        $cat = new Cat([
            'name' => 'Miso',
            'breed' => 'Tabby Oren',
            'age' => '2 tahun',
            'gender' => 'Jantan',
            'description' => 'Kucing kalem',
            'image_path' => 'cats/miso.webp',
            'created_by' => 999,
        ]);

        $this->assertNull($cat->created_by);
    }
}
