<?php

namespace App\Models;

use App\Util\PusherUtils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Pusher\Pusher;
use stdClass;

class Notification extends Model
{
    use HasFactory;
    protected $table = "notifications";
    protected $fillable = ['id', 'type', 'data', 'readat', 'userid'];
    public $timestamps = true;

    public static function readNotifications(User $user, $limit = null)
    {
        $query = DB::table('usersnotifications as un')
            ->leftJoin('notifications as n', 'n.id', '=', 'un.notificationid')
            ->where('un.userid', $user->id)
            ->whereNotNull('un.readat')
            ->orderByDesc('n.created_at');
        if (null !== $limit) $query->limit($limit);
        return $query->get(['n.id', 'n.type', 'n.data', 'n.created_at', 'un.readat'])->map(function ($notification) {
            $notification->data = json_decode($notification->data, true);
            return $notification;
        });
    }

    public static function unreadNotifications(User $user, $limit = null)
    {
        $query = DB::table('usersnotifications as un')
            ->leftJoin('notifications as n', 'n.id', '=', 'un.notificationid')
            ->where('un.userid', $user->id)
            ->whereNull('un.readat')
            ->orderByDesc('n.created_at');
        if (null !== $limit) $query->limit($limit);
        return $query->get(['n.id', 'n.type', 'n.data', 'n.created_at', 'un.readat'])->map(function ($notification) {
            $notification->data = json_decode($notification->data, true);
            return $notification;
        });
    }

    /**
     * @param array|User $users
     */
    public static function sendNotifications($users, $data, $type = 'text')
    {
        if (is_array($users) || $users instanceof Collection) {

            $notification = DB::transaction(function () use ($users, $data, $type) {
                $notification = Notification::create([
                    'type' => $type,
                    'data' => json_encode($data)
                ]);
                $temp = count($users);
                $userInsert = [];
                for ($i = 0; $i < $temp; $i++) {
                    $userInsert[$i] = ['userid' => $users[$i]->id, 'notificationid' => $notification->id];
                }
                DB::table('usersnotifications')->insert($userInsert);
                return $notification;
            });

            foreach ($users as $u) {
                PusherUtils::pusherNotification($u->id, ['notification' => $notification->id]);
            }
        } else {
            $notification = DB::transaction(function () use ($users, $data, $type) {
                $notification = Notification::create([
                    'type' => $type,
                    'data' => json_encode($data)
                ]);
                DB::table('usersnotifications')->insert(['userid' => $users->id, 'notificationid' => $notification->id]);
                return $notification;
            });

            PusherUtils::pusherNotification($users->id, ['notification' => $notification->id]);
        }
    }
}
