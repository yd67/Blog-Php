<?php

namespace App\Controller ;

use App\Model\User ;
use App\Repo\UserRepository;

class RegistrationController extends MainController
{

    protected $errors = [] ;

    public function index()
    {
        unset($_SESSION['error']);

        $this->twig->display('register/index.html.twig',[
          'errors' => $this->errors
        ]);

    }

    public function register()
    {  

        var_dump($_POST); var_dump($_FILES);

        $name = htmlspecialchars($_POST['name']) ;
        $firstName = htmlspecialchars($_POST["first_name"]);
        $email = htmlspecialchars($_POST['email']);
        $role = 'ROLE_USER';
        $file = $_FILES['file'] ;

        if (empty($name)) {
            $_SESSION['error'] = 'veillez rensseigner votre nom ' ;
            header('Location: registration');
            die();
        }
        if (empty($firstName)) {
            $_SESSION['error'] = 'veillez rensseigner votre prénom ';
            header('Location: registration');
            die();
        }
        if (empty($_POST['email'])) {
            $_SESSION['error'] = 'veillez rensseigner une adresse email ' ;
            header('Location: registration');
            die();
        }
        if (empty($_POST['password'])) {
            $_SESSION['error'] = 'le mot de passe ne doit pas etre vide ' ;
            header('Location: registration');
            die();
        }
        
        $userRepo = new UserRepository ;
        $user = $userRepo->findBy('email',$email);

    
        if (!empty($user)) {
            $_SESSION['error'] = 'adresse email non disponible' ;
            header('Location: registration');
            die();
        }
        
           
            // // hash password  
            // $password = password_hash($_POST['pass'],PASSWORD_DEFAULT) ;


            // if (empty($error)) {
            // // create the user
            // $user = new User ;
            // $user->setName($name);
            // $user->setFirstName($firstName);
            // $user->setRole($role);
            // $user->setEmail($email);
            // $user->setPassword($password);
            // $user->setImage($img);
    
            // $userRepo = new UserRepository ;
            // $userRepo->createUser($user) ;
             //}

            var_dump('enregistrer');
    
            var_dump($_FILES);
         
       // else{
            
        //     array_push($this->errors,'le else');
        //     $_SESSION['error'] = 'des champs sont vide' ;
        //     header('Location: registration');
        // }

         
        

    }

}