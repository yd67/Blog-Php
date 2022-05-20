<?php

namespace App\Controller ;

use App\Model\User ;

class RegistrationController extends MainController
{
    public function index()
    {

        $this->twig->display('register/index.html.twig',[
          
        ]);

    }

    public function register()
    {  

        var_dump($_POST); var_dump($_FILES);

        $nom = $_POST['nom'];
        $prenom = $_POST["first_name"];
        $email = $_POST['email'];
        $mdp = $_POST['pass'];
        $role = 'ROLE_USER';

        // traitement de l'image 
          // $img =  $_FILES;

        // récuperation données du formulaire 

        // verifier si le user existe deja 
        if ( !empty($_POST['nom']) && !empty($_POST['email'])  ) {
            echo('valide');

            // hachage de mdp


            // creation de l'utilisateur 
            $user = new User ;
            $user->newUser($nom,$prenom,$role,$email,$mdp,$img);

        }else{
            echo('donnes non valide') ;
        }

         
        

    }

}