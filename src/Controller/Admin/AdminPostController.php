<?php

namespace App\Controller\Admin ;

class AdminPostController extends BaseAdminController 
{

    public function index()
    {
        
        $this->twig->display('admin/articles/index.html.twig',[

        ]);
    }

    public function addPost()
    {
        if( !empty($_POST)){

            var_dump($_POST);
        }

        $this->twig->display('admin/articles/addPost.html.twig',[

        ]);
    }
}