<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Check if user has any of the specified roles
        $hasRole = false;
        foreach ($roles as $role) {
            if ($user->hasRole($role) || $user->userRole === $role) {
                $hasRole = true;
                break;
            }
        }

        if (!$hasRole) {
            // Redirect to appropriate dashboard based on user's role
            $userRole = $user->getPrimaryRole();
            return match ($userRole) {
                'admin' => redirect()->route('admin.dashboard'),
                'manager' => redirect()->route('manager.dashboard'),
                'teacher' => redirect()->route('teacher.dashboard'),
                'guardian' => redirect()->route('guardian.dashboard'),
                default => abort(403, 'Unauthorized access.')
            };
        }

        return $next($request);
    }
}
