<?php

namespace App\Util;

use App\Models\User;
use Pusher\Pusher;

class PusherUtils
{
    static function pusher($chanel, $event, $data)
    {
        $options = array(
            'cluster' => 'ap1',
            'encrypted' => false
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger($chanel, $event, $data);
    }

    public static function pusherNotification($userId, $data)
    {
        PusherUtils::pusher('notification', 'user-id-' . $userId, $data);
    }

    public static function pusherNotificationAll($data)
    {
        PusherUtils::pusher('notification', 'all', $data);
    }
}
