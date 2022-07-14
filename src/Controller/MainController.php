<?php

namespace App\Controller;

use App\Model\User;
use App\Tools\Session;
use App\Tools\superglobals;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class MainController
{
    protected $loader;
    protected $twig;
    protected $session;
    protected $global;

    public function __construct()
    {
        if ($this->session === null) {
            $this->session = new Session;
        }
        if ($this->global === null) {
            $this->global = new superglobals;
        }

        if ($this->loader === null) {
            $this->loader = new FilesystemLoader(ROOT . '/templates');
        }

        if ($this->twig === null) {
            $this->twig = new Environment($this->loader, [
                'debug' => true,
                'cache' => false,
            ]);
            $this->twig->addExtension(new \Twig\Extension\DebugExtension());

            $this->twig->addGlobal('session', $this->session->full());
            $this->twig->addGlobal('url', ROOT);
        }
    }

    public function index()
    {
    }

    public function isAuth()
    {
        $auth = false;
        if (!empty($this->session->get('user'))) {
            $auth = true;
        }
        return $auth;
    }

    public function isAdmin()
    {
        $admin = false;
        $user = $this->session->get('user');

        if ($user['role'] === 'ROLE_ADMIN') {
            $admin = true;
        }
        return $admin;
    }

    public function getSession()
    {
        return $this->session ;
    }


    public function page404()
    {

        $this->twig->display('error404.html.twig', []);
    }

    public function redirect($path)
    {
        
        header('Location: index.php?path=' . $path);
        exit();
    }
}
