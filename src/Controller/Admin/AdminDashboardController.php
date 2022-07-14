<?php

namespace App\Controller\Admin ;

class AdminDashboardController extends BaseAdminController
{

    public function index()
    {
        
        $this->twig->display('admin/Dashboard.html.twig',[
            'test' => 'test contact'
        ]);
    }

}
