<?php 

namespace App\Controller ;

use App\Db\Database;

class HomeController extends MainController
{

    public function index()
    {
        
        $test = [
           0 => [
                'nom' => 'gerard',
                'prenom' => 'martin',
                'age' =>  17
                 ],
            1 => [
                'nom' => 'james',
                'prenom' => 'leo',
                'age' =>  26
                ]
            ];

        $this->twig->display('home/index.html.twig',[
            'perso' => $test,
        ]);
    }


    public function show()
    {
        echo('le show du home') ;
    }

}
