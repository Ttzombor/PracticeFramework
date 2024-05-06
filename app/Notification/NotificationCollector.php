<?php

namespace App\Notification;

class NotificationCollector
{
    public static $notifications = [];

    public static function setNotification($message, $type = 'warning')
    {
        $_SESSION['notifications'][] = [
            'message' => $message,
            'type' => $type
        ];
    }

    public static function getNotifications()
    {
        if (isset($_SESSION['notifications'])) {
            foreach ($_SESSION['notifications'] as $notification) {
                self::$notifications[] = $notification;
            }
            unset($_SESSION['notifications']);
        }
        return self::$notifications;
    }
}
