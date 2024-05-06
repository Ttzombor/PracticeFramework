<?php

namespace App\Http;

use App\Http\Page\PageBuilder;
use Exception;

class Page
{
    public static function getPage($pageName)
    {
        $page = new PageBuilder();
        return $page($pageName);
    }

    public static function get404Page()
    {
        $page = new PageBuilder();
        return $page('404');
    }
}
