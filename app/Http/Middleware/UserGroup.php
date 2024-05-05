<?php

namespace App\Http\Middleware;

use App\Notification\NotificationCollector;

class UserGroup extends Middleware
{
    public function check()
    {
        if (isset($_SESSION['user']) && $this->params && !isset($this->params['group'])) {
            NotificationCollector::setNotification('You do not have permission to access this page', 'danger');
            return false;
        }
        if (isset($_SESSION['user']) && $_SESSION['user']['group'] == $this->params['group']) {
            return parent::check();
        }

        return false;
    }
}
