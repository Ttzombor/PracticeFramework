<?php

namespace App\Notification;

use App\Http\Page;

class Notification
{
    static $notifications = [];

    public static function setNotification($message, $type = 'warning')
    {
        self::$notifications[] = [
            'message' => $message,
            'type' => $type
        ];
    }
}