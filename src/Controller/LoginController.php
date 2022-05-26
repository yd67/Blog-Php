<?php

namespace App\Controller ;

class LoginController extends MainController
{
    public function index()
    {

        $this->twig->display('login/index.html.twig',[

        ]);
    }
}