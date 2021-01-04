<?php

namespace App\Http\Middleware;

use App\Http\Controllers\MenuController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

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
        if (Auth::check()) {
            return $next($request);
        } elseif (preg_match($this::$regexPublic, $request->getPathInfo())) {
            return $next($request);
        }
        return redirect()->route('login');
    }
}
