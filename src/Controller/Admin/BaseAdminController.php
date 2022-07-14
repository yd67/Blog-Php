<?php 

namespace App\Controller\Admin ;

use Exception;
use App\Controller\MainController;

class BaseAdminController extends MainController
{

    public function __construct()
    {
        parent::__construct() ;

        if (empty($_SESSION['user'])){    

            // redirection page 404
            $this->redirect('404') ;
        }
        if ($_SESSION['user']['role'] != 'ROLE_ADMIN') {
            
            //  redirection page 404
            $this->redirect('404') ;
        }
    }

    
}