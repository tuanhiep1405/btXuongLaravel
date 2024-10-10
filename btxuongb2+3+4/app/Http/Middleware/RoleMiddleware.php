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
     */
    public function handle(Request $request, Closure $next, $role)
    {
       
        
        $userRole = $request->role; 
        if ($userRole === 'admin') {
            return $next($request);
        }
        
        if ($userRole !== $role) {
            return response()->json(['message' => 'khong co quyen truy cap'], 403);
        }

        return $next($request);
    }
}
