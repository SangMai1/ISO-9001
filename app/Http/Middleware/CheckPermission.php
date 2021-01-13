<?php

namespace App\Http\Middleware;

use App\Models\chucnangs;
use App\Models\Notification;
use Carbon\Carbon;
use Closure;
use DateTime;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class CheckPermission
{
    private static $regexPublic = '/^(\/login|\/register)$/';
    private static $maxTimeClean = 604800;
    // private static $maxTimeClean = 1;
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
        $GLOBALS['notifications'] = [];
        if ($user) {
            $GLOBALS['notifications'] = $this->getUserNotifications();
            $this->cleanNotifications();

            if ($user->isAdmin()) return $next($req);

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

    public function getUserNotifications()
    {
        $user = Auth::user();
        return Notification::unreadNotifications($user)->toArray() + Notification::readNotifications($user, 20)->toArray();
    }

    public function cleanNotifications()
    {
        $path = './data.json';
        $size = filesize($path);
        $file = fopen($path, realpath($path) ? 'r+' : 'w+');
        $content = json_decode($size ? fread($file, $size) : '', true);
        if (!$content) {
            $content = ['lastTimeCleanNotification' => 0];
        }

        if (($content['lastTimeCleanNotification'] + $this::$maxTimeClean) < time()) {
            $content['lastTimeCleanNotification'] = time();
            $file = fopen($path, 'w+');
            fwrite($file, json_encode($content));
            fclose($file);
            DB::table('notifications')
                ->whereNotNull('readat')
                ->orWhere('readat', '<', Carbon::createFromTimestamp(time() + $this::$maxTimeClean))
                ->delete();
        } else fclose($file);
    }
}
