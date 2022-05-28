<?php 

namespace App\Controller\Admin ;

use App\Controller\MainController;

class BaseAdminController extends MainController
{

    public function __construct()
    {
        parent::__construct() ;

        if (empty($_SESSION['user'])){    
            echo('acces refuser') ;

            // faire une redirection
            die();
        }
        if ($_SESSION['user']['role'] != 'ROLE_ADMIN') {
            echo('acces refuser pas le bon role');
            
            // faire une redirection
            die();
        }
    }

    
}