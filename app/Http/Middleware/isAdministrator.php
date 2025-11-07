<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdministrator
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && session('user_role') == 1) {
            return $next($request);
        }
        return redirect('/')->withErrors('Akses ditolak.');
    }
}
