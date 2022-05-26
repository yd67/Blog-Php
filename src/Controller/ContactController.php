<?php

namespace App\Controller ;

class ContactController extends MainController
{

    public function index()
    {
       
       $this->twig->display('contact/index.html.twig',[
        'test' => 'test contact'
    ]);
    }

    public function show()
    {
        echo('le show du contact') ;
    }

    public function details($id)
    {
        echo('le test'.$id) ; 

    }
}