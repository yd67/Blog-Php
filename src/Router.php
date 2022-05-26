<?php

namespace App;

use App\Controller\MainController;

class Router 
{

    /**
     * Default conttroller 
     *
     * @var string
     */
    protected $controller = 'App\Controller\HomeController';


    /**
     * la fonction 
     *
     * @return void
     */
    public function route()
    {
        $controller = $this->controller ;
        $method = 'index';
        $arg = null ;

    //  var_dump($_SERVER['REQUEST_URI'],$_GET,$_POST);


        if (isset($_GET['path'])) {    
           $param = explode('/',$_GET['path']) ;
        }

        if (isset($_POST['path'])) {    
            $param = explode('/',$_POST['path']) ;
         }

        if (!empty($param[0])) {
            $controller = 'App\Controller\\'.ucfirst($param[0].'Controller') ;
            $mot = "Admin" ;
              // Test if the string contains the word "Admin"
                if(strpos($controller, $mot) !== false){
                    $controller = 'App\Controller\Admin\\'.ucfirst($param[0].'Controller') ;
                }
        }
        
        if (!empty($param[1])) {
            if (method_exists($controller,$param[1])) { 
              $method = $param[1];
            }
        }
        
        if (!empty($param[2])) {
           $arg = $param[2] ;
        } 

        if (class_exists($controller)) {
            var_dump($controller);
            $class = new $controller() ;
            $class->$method($arg);

        }else {
           $class = new MainController ;
           var_dump($controller);
           $class->page404();
        }

    }


}