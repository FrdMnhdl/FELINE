<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequestMiddleware
{
    /**
     * Record lightweight request lifecycle metadata without sensitive payloads or tokens.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userBefore = $request->user()?->id;

        $response = $next($request);

        $userId = $userBefore ?? $request->user()?->id;

        Log::info('HTTP request processed', [
            'method' => $request->method(),
            'path' => '/'.ltrim($request->path(), '/'),
            'user_id' => $userId,
            'status' => $response->getStatusCode(),
            'timestamp' => now()->toIso8601String(),
        ]);

        return $response;
    }
}
