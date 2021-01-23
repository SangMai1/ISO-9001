<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Kiểm tra người dùng có quyền tại 1 đường dẫn
 */
function _p($url)
{
    static $action = 0;
    static $permissionCache = null;

    switch ($action) {
        case 3:
            return $permissionCache[$url] ?? true;
        case 0:
            $user = Auth::user();
            if (!Auth::check())
                $action = 1;
            else if (Auth::user()->isAdmin())
                $action = 2;
            else {
                $action = 3;
                $cache = session('permissions');
                if (!$cache || ($cache['updated_at'] !== $user->updated_at->timestamp) || true) {
                    $cache = [
                        'updated_at' => $user->updated_at->timestamp,
                        'permissions' => $user->getAllPermissions()
                    ];
                    session(['permissions' => $cache]);
                }
                $permissionCache = $cache['permissions'];
            }
            return _p($url);
        case 1:
            return false;
        case 2:
            return true;
    }
};

/**
 * Hàm check quyền nhưng thông qua route name
 */
function _pr($routename)
{
    return _p(route($routename, [], false));
}
