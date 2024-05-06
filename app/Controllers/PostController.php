<?php

namespace App\Controllers;

class PostController extends \App\Http\AbstractController
{
    public function get()
    {
        $_SESSION['post'] = '123';
        return 'post';
    }
    public function post()
    {
        return $this->redirect('/');
    }
}
