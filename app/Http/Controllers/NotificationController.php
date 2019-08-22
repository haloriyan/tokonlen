<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;

class NotificationController extends Controller
{
    public static function read($userId) {
        $notif = Notification::where([['user_id', $userId], ['readed', 0]])
                    ->update(['readed' => 1]);
    }
    public static function notice($userId, $message) {
        $notif = new Notification;
        $notif->user_id = $userId;
        $notif->message = $message;
        $notif->readed = 0;
        $notif->save();
    }
}
