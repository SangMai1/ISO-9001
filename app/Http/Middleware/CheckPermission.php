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
    // 604800
    private static $regexPublic = '/^(\/login|\/register)$/';
    private static $lifespanOfNotification = 604800;
    private static $lifespanOfNotificationUnread = 604800 * 4;
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
            $this->cleanNotifications();
            $GLOBALS['notifications'] = $this->getUserNotifications();

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
        return ['unread' => Notification::unreadNotifications($user), 'read' => Notification::readNotifications($user, 20)];
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

        if (($content['lastTimeCleanNotification'] + $this::$lifespanOfNotification) < time() || true) {
            $content['lastTimeCleanNotification'] = time();
            $file = fopen($path, 'w+');
            fwrite($file, json_encode($content));
            fclose($file);
            DB::transaction(function () {
                DB::table('usersnotifications as un')
                    ->leftJoin('notifications as n', 'un.notificationid', '=', 'n.id')
                    ->whereNull('n.id')
                    ->orWhere('n.created_at', '<', Carbon::createFromTimestamp(time() - $this::$lifespanOfNotificationUnread))
                    ->orWhere(function ($q) {
                        $q->whereNotNull('un.readat')
                            ->where('un.readat', '<', Carbon::createFromTimestamp(time() - $this::$lifespanOfNotification));
                    })->delete();

                DB::table('notifications as n')
                    ->leftJoin('usersnotifications as un', 'un.notificationid', '=', 'n.id')
                    ->whereNull('un.id')
                    ->delete();
            });
        } else fclose($file);
    }
}
