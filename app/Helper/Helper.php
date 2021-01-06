<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Kiểm tra người dùng có quyền tại 1 đường dẫn
 */
function _p($url)
{
    static $action = 0;
    static $cache = [];
    static $permissionMap = [];
    static $permissionCache = [];

    switch ($action) {
        case 0:
            if (!Auth::check()) $action = 1;
            else if (Auth::user()->isAdmin()) $action = 2;
            else {
                $action = 3;
                $permissionMap = $GLOBALS['permissionMap'];
                $permissionCache = $GLOBALS['permissions'];
            }
            return _p($url);
        case 1:
            return false;
        case 2:
            return true;
        case 3:
            if (isset($cache[$url])) return $cache[$url];
            else {
                $perId = $permissionMap[$url] ?? null;
                if (!$perId) {
                    $cache[$url] = true;
                    return true;
                } else {
                    $cache[$url] = isset($permissionCache[$perId]);
                    return $cache[$url];
                }
            }
    }
};

/**
 * Hàm check quyền nhưng thông qua route name
 */
function _pr($routename)
{
    return _p(route($routename, [], false));
}
