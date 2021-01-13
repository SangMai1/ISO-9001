<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class Notification extends Model
{
    use HasFactory;
    protected $table = "notifications";
    protected $fillable = ['id', 'type', 'data', 'readat', 'userid'];
    public $timestamps = true;

    public static function readNotifications(User $user, $limit = null)
    {
        $query = Notification::where('userid', $user->id)->whereNotNull('readat');
        if (null !== $limit) $query->limit($limit);
        return $query->get(['id', 'type', 'data', 'created_at', 'readat'])->map(function ($notification) {
            $notification->data = json_decode($notification->data, true);
            return $notification;
        });
    }

    public static function unreadNotifications(User $user, $limit = null)
    {
        $query = Notification::where('userid', $user->id)->whereNull('readat');
        if (null !== $limit) $query->limit($limit);
        return $query->get(['id', 'type', 'data', 'created_at', 'readat'])->map(function ($notification) {
            $notification->data = json_decode($notification->data, true);
            return $notification;
        });
    }

    /**
     * @param array|User $users
     */
    public static function sendNotifications($users, $data, $type = 'text')
    {
        if (is_array($users)) {
            foreach ($users as $user) {
                Notification::create([
                    'userid' => $user->id,
                    'type' => $type,
                    'data' => json_encode($data)
                ]);
            }
        } else {
            Notification::create([
                'userid' => $users->id,
                'type' => $type,
                'data' => json_encode($data)
            ]);
        }
    }
}
