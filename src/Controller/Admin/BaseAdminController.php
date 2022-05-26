<?php 

namespace App\Controller\Admin ;

class BaseAdminController 
{

    public function __construct()
    {
        if (empty($_SESSION['user'])){    
            echo('acces refuser') ;

            // faire une redirection
            die();
        }
        if ($_SESSION['user']['role'] != 'ROLE_ADMIN') {
            echo('acces resfuser pas le bon role');
            
            // faire une redirection
            die();
        }
    }

    public function index(){
        echo'le bon role';
    }
}