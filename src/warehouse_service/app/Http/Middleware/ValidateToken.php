<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Http;

class ValidateToken
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        $response = Http::withToken($token)
            ->get(config('gateway.endpoint') . '/verify-token');

        if ($response->successful()) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
