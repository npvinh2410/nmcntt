<?php
namespace Hydrogen\Base\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ForceLogout
{
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->status) {
            Auth::logout();
            return redirect()->route('login');
        }

        return $next($request);
    }
}