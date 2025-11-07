<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsDokter
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && session('user_role') == 2) {
            return $next($request);
        }
        return redirect('/')->withErrors('Akses ditolak.');
    }
}
