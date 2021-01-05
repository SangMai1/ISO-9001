<?php

namespace App\Http\Middleware;

use App\Models\chucnangs;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if ($user) {
            if($user->isAdmin()) return $next($req);

            // map này để dùng check quyền cho đường dẫn trong view
            $permissionMap = chucnangs::pluck('id', 'url');
            $GLOBALS['permissionMap'] = $permissionMap;

            $perId = $permissionMap[$req->getPathInfo()] ?? null;

            // array id các quyền của người dùng
            $permissionCache = $this->getPermissions();
            $GLOBALS['permissions'] = $permissionCache;

            if (!$perId) return $next($req);

            return isset($permissionCache['permissions'][$perId])
                ? $next($req)
                : abort(401);
        } elseif (preg_match($this::$regexPublic, $req->getPathInfo())) {
            return $next($req);
        }

        return redirect()->route('login');
    }

    public function getPermissions()
    {
        $user = Auth::user();
        $permissionCache = session('permissions');
        if (!$permissionCache || ($permissionCache['updated_at'] !== $user->updated_at->timestamp)) {
            $permissionCache = [
                'updated_at' => $user->updated_at->timestamp,
                'permissions' => $user->getAllPermissionId()
            ];
            session(['permissions' => $permissionCache]);
        }
        return $permissionCache;
    }
}
