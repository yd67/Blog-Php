<?php

namespace App\Controller\Admin;

use Exception;
use App\Controller\MainController;

class BaseAdminController extends MainController
{

    public function __construct()
    {
        parent::__construct();

        $this->session = parent::getSession() ;

        if ($this->isAuth() === false) {
            $this->redirect('login');
        }

        if ($this->isAdmin() === false) {
            $this->redirect('login');

        }
    }
}
