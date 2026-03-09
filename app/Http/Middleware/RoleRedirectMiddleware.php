<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the authenticated user
        $user = Auth::user();

        // Redirect to login if the user is not authenticated
        if (!$user) {
            return redirect('/login-user');
        }

        // Eager-load the userRoles relationship 
        $user->load('userRoles');

        // Define role-based route prefixes and their default index routes
        $roleData = [
            'FD' => [
                'prefix' => 'reservations',
                'index' => 'reservations-dashboard',
            ],
            'LM' => [
                'prefix' => 'logistics',
                'index' => 'activity-log',
            ],
            'GM' => [
                'prefix' => 'general',
                'index' => 'general-dashboard',
            ],
            'DIR' => [
                'prefix' => 'director',
                'index' => 'director-dashboard',
            ],
            'HK' => [
                'prefix' => 'housekeeping',
                'index' => 'house-dashboard',
            ],
            'MM' => [
                'prefix' => 'maintenance',
                'index' => 'main-dashboard',
            ],
            'KR' => [
                'prefix' => 'fnb',
                'index' => 'dashboard',
            ],
            'SM' => [
                'prefix' => 'sales',
                'index' => 'sales-dashboard',
            ],
        ];

        // Get the user's role (access the 'aka' field from the related UserRole model)
        $role = $user->userRoles->aka;

        // Grant GM and DIR access to all routes
        if ($role === 'GM' || $role === 'DIR') {
            return $next($request);
        }

        // Check if the role exists in our mapping
        if (isset($roleData[$role])) {
            // Start with role's default prefix
            $allowedPrefixes = [$roleData[$role]['prefix']];

            // Grant FD access to KR (if demanded by clients)
            if ($role === 'FD') {
                $allowedPrefixes[] = $roleData['KR']['prefix'];
            }

            // Check if request matches any allowed prefix
            $allowed = false;
            foreach ($allowedPrefixes as $prefix) {
                if ($request->is($prefix) || $request->is($prefix . '/*')) {
                    $allowed = true;
                    break;
                }
            }

            // Redirect if not allowed
            if (!$allowed) {
                return redirect()->route($roleData[$role]['index']);
            }
        } else {
            return redirect('/login-user');
        }

        return $next($request);
    }
}
