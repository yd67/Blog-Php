<?php

namespace App\Controller;

use App\Model\User;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class MainController
{
    private $loader;
    protected $twig;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(ROOT . '/templates');
        $this->twig = new Environment($this->loader, [
            'debug' => true,
            'cache' => false,
        ]);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());

        $this->twig->addGlobal('session', $_SESSION);
        $this->twig->addGlobal('url', ROOT);
    }

    public function index()
    {
    
    }

    public function isAuth()
    {
        $auth = false;
        if (!empty($_SESSION['user'])) {
            $auth = true;
        }
        return $auth;
    }

    public function isAdmin()
    {
        $admin = false;

        if ($_SESSION['user']['role'] === 'ROLE_ADMIN') {
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
<<<<<<< HEAD
        header('Location: index.php?path='.$path); 

        // top the script 
        exit();
    }
=======
>>>>>>> 0c0c971cd9b8ae7751e6830ae6af01d98066b1ca

        header('Location: index.php?path=' . $path);
        exit();

    }
}
