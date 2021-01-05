<?php

namespace App\Http\Middleware;

use App\Http\Controllers\MenuController;
use App\Models\Cauhinhs;
use App\Models\chucnangs;
use App\Models\User;
use Closure;
use Illuminate\Cache\ArrayStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use stdClass;

use function PHPSTORM_META\type;

class CheckPermission
{
    private static $regexPublic = '/^(\/login|\/register)$/';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $req, Closure $next)
    {
        $user = Auth::user();
        // error_log = function(){};
        if ($user) {
            if ($user->isAdmin()) return $next($req);

            $per = chucnangs::where('url', $req->getPathInfo())->first();

            if (!$per) return $next($req);

            $permissionCache = session('permissions');
            if (!$permissionCache || ($permissionCache['updated_at'] !== $user->updated_at->timestamp)) {
                $permissionCache = [
                    'updated_at' => $user->updated_at->timestamp,
                    'permissions' => $user->getAllPermissionId()
                ];
                session(['permissions' => $permissionCache]);
            }

            return array_search($per->id, $permissionCache['permissions'])
                ? $next($req)
                : abort(401);
        } elseif (preg_match($this::$regexPublic, $req->getPathInfo())) {
            return $next($req);
        }
        return redirect()->route('login');
    }
}
