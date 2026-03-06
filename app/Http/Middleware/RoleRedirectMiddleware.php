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
            return redirect('/login-user'); // Redirect to login page if not authenticated
        }

        // Eager-load the userRoles relationship
        $user->load('userRoles');

        // Define role-based route prefixes and their default index routes
        $roleData = [
            'FD' => [
                'prefix' => 'reservations', // FD users should go to reservations.index route
                'index' => 'reservations', //  in case of sudden url change,force url to remain within user's role
            ],
            'LM' => [
                'prefix' => 'logistics', // LM users should go to logistics.activity-log route
                'index' => 'activity-log', // same idea as index above
            ],
            'GM' => [
                'prefix' => 'general', // GM users should go to general.general-dashboard route
                'index' => 'general-dashboard', // same idea as index above
            ],
            'DIR' => [
                'prefix' => 'general', // Director follows general module guard rules
                'index' => 'general-dashboard',
            ],
        ];

        // Get the user's role (access the 'aka' field from the related UserRole model)
        $role = $user->userRoles->aka;

        // Check if the role exists in our mapping
        if (isset($roleData[$role])) {
            $allowedPrefix = $roleData[$role]['prefix'];
            $defaultIndexRoute = $roleData[$role]['index'];

            // Check if the current route is outside the user's allowed prefix
            if (!$request->is($allowedPrefix) && !$request->is($allowedPrefix . '/*')) {
                // Redirect the user to their corresponding default index route
                return redirect()->route($defaultIndexRoute);
            }
        } else {
            // Handle cases where the user's role is not defined in $roleData
            return redirect('/login-user'); // Redirect to login page if not authenticated
        }

        // Proceed with the request if everything is fine
        return $next($request);
    }
}

