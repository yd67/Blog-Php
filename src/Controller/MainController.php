<?php

namespace App\Controller;

use App\Model\User;
use App\Tools\Session;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class MainController
{
    private $loader;
    protected $twig;
    private $session ;

    public function __construct()
    {
        if (is_null($this->session)) {  
             $this->session = new Session ;
        }

        $this->loader = new FilesystemLoader(ROOT . '/templates');
        $this->twig = new Environment($this->loader, [
            'debug' => true,
            'cache' => false,
        ]);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());

        $this->twig->addGlobal('session', $this->session->full());
        $this->twig->addGlobal('url', ROOT);
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
        $user = $this->session->get('user') ;

        if ($user['role'] === 'ROLE_ADMIN') {
            $admin = true;
        }
        return $admin;
    }


    public function page404()
    {

        $this->twig->display('error404.html.twig', []);
    }

    public function redirect($path)
    {
        header('Location: index.php?path=' . $path);

        // top the script 
        exit();
    }
}
