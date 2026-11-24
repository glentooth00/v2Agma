<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureScannerIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $scanner = $request->user();

        if (!$scanner || $scanner->status !== 'active') {
            // Revoke the current token if the account is disabled.
            $scanner?->currentAccessToken()?->delete();

            return response()->json([
                'success' => false,
                'message' => 'Your scanner account is disabled. Please contact the AGMA ONE Administrator.',
            ], 403);
        }

        return $next($request);
    }
}
