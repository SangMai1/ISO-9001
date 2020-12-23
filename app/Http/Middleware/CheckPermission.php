<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class CheckPermission
{
    private static $regexPublic = '/^(\/login|\/register|\/table\/[^\/]*)$/';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() || preg_match($this::$regexPublic, $request->getPathInfo())) return $next($request);
        return redirect()->route('login');
    }
}
