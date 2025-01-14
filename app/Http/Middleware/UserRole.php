<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserRole
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next, $role): Response
	{
		// Check if the user is authenticated and has the required role
		if (Auth::check() && Auth::user()->role == $role) {
			return $next($request);
		} else {
			// If the user is not authenticated or does not have the required role, abort with a 403 error
			abort(403, 'You are disallowed to access this page.');
		}
	}
}
