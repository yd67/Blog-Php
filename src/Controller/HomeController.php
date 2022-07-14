<?php 

namespace App\Controller ;

use App\Db\Database;

class HomeController extends MainController
{

    public function index()
    {
        $this->twig->display('home/index.html.twig',[
        ]);
    }


    public function show()
    {
        
    }

}
