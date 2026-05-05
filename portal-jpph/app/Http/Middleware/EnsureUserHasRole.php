<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();
        Log::info('EnsureUserHasRole check', [
            'user_id' => $user?->id,
            'user_role' => $user?->role,
            'allowed_roles' => $roles,
            'role_match' => $user ? in_array($user->role, $roles, true) : null,
        ]);
        if (! $user || ! in_array($user->role, $roles, true)) {
            abort(403, 'Akses ditolak. Anda tidak mempunyai kebenaran yang sesuai.');
        }
        return $next($request);
    }
}
