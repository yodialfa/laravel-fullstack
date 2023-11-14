<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // if ($request->user() && $request->user()->role == $role) {
        //     return $next($request);
        // }

        // Check if the user has one of the specified roles

        // dd($roles); 
        // $userRoles = is_array($roles[0]) ? $roles[0] : $roles;

        if ($request->user() && in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        return redirect('/'); // Atau rute lain jika tidak berhak akses
    }

}
