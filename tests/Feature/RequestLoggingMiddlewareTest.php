<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Mockery;
use Tests\TestCase;

class RequestLoggingMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_request_logging_middleware_records_metadata_without_sensitive_payloads(): void
    {
        $user = User::factory()->create([
            'password' => 'top-secret-pass',
        ]);

        Log::spy();

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'top-secret-pass',
        ])->assertRedirect(route('cats.index'));

        Log::shouldHaveReceived('info')
            ->once()
            ->with(
                'HTTP request processed',
                Mockery::on(function (array $context) use ($user): bool {
                    $encoded = json_encode($context);

                    return ($context['method'] ?? null) === 'POST'
                        && ($context['path'] ?? null) === '/login'
                        && ($context['user_id'] ?? null) === $user->id
                        && ($context['status'] ?? null) === 302
                        && is_string($context['timestamp'] ?? null)
                        && ! str_contains((string) $encoded, 'top-secret-pass')
                        && ! array_key_exists('password', $context);
                })
            );
    }
}
