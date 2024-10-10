<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CheckAge
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->age < 18) {
            return Redirect::to('/')->with('error', 'Bạn chưa đủ 18+ tuổi để truy cập trang này lo học đi.');
        }

        return $next($request);
    }
}
