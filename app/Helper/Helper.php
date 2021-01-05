<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

function _per($url)
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
            return _per($url);
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

function _route($name)
{
    return route($name, [], false);
}

function _perr($routename)
{
    return _per(_route($routename));
}
