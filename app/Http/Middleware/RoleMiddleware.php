<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Container\Attributes\Auth as AttributesAuth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/')->withErrors([
                'email' => 'You must be logged in to access this page.'
            ]);
        }
        // $roleName = Role::find(Auth::user()->role_id)->name;
        if(!in_array(Role::find(Auth::user()->role_id)->name, $roles)) {
            return back();
        }
        return $next($request);
    }
}
