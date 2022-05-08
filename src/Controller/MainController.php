<?php

namespace App\Controller ;

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
            'cache' => false,
        ]);
    }

    public function index()
    {
        var_dump('le main controller');
    }

    public function page404()
    {

        $this->twig->display('error404.html.twig',[
            
        ]);

    }

}