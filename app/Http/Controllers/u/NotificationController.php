<?php

namespace App\Http\Controllers\u;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Util\PusherUtils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function readNotificationsOfUser(Request $req)
    {
        if (!$req->id) return abort(400);
        $user = Auth::user();
        $userNotification = DB::table('usersnotifications as un')
            ->where('un.notificationid', $req->id)
            ->where('un.userid', Auth::user()->id)
            ->leftJoin('notifications as n', 'n.id', '=', 'un.notificationid')
            ->first(['un.*', 'n.created_at']);
        if (!$userNotification) return abort(403);
        DB::table('usersnotifications as un')
            ->leftJoin('notifications as n', 'n.id', '=', 'un.notificationid')
            ->where('un.userid', $user->id)
            ->where('n.created_at', '<=', $userNotification->created_at)
            ->update(['un.readat' => Carbon::now()]);
        return response()->json(['message' => 'success']);
    }

    public function getNotificationOfUser(Request $request)
    {
        if (!DB::table('usersnotifications')->where('userid', Auth::user()->id)->where('notificationid', $request->id)->first()) abort(403);
        $notification = Notification::find($request->id);
        $notification->data = json_decode($notification->data, true);
        if (!$notification) abort(404);
        return response()->json($notification);
    }
}
