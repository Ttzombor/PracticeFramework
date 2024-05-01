<?php

namespace App\Http;

use Exception;

class Page
{
    public static function getPage($pageName)
    {
        $file =  $_SERVER['DOCUMENT_ROOT'] . "/view/{$pageName}.phtml";
        if (file_exists($file)) {
            require_once  $_SERVER['DOCUMENT_ROOT'] . "/view/header/head.phtml";
            require_once  $_SERVER['DOCUMENT_ROOT'] . "/view/header/navigation.phtml";
            require_once  $_SERVER['DOCUMENT_ROOT'] . "/view/header/notifications.phtml";

            require_once $file;

            require_once  $_SERVER['DOCUMENT_ROOT'] . "/view/footer/footer.phtml";

        } else {
            throw new Exception("Page not found");
        }
    }

    public static function get404Page()
    {
        return self::getPage('404');
    }
}