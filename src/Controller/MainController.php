<?php

namespace App\Controller ;

use App\Model\User;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class MainController 
{
    private $loader;
    protected $twig ;

    public function __construct()
    {
        $this->loader = new FilesystemLoader( ROOT.'/templates');
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

    public function page404()
    {

        $this->twig->display('error404.html.twig',[

        ]);

    }

    public function redirect($path)
    {
        header('Location: index.php?path='.$path); 

        // top the script 
        exit();
    }

}