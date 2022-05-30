<?php

namespace App\Controller ;

use App\Repo\MainRepository;

class LoginController extends MainController
{
    public function index()
    {
        unset($_SESSION['error']);

        if ($_POST) {
            unset($_SESSION['success']);
            
            $email = htmlspecialchars($_POST['email']);
            $pass = htmlspecialchars($_POST['password']);
            $_SESSION['info'] =  [
                'email' => $email
            ];

            $mainRepo = new MainRepository ; 
            $user = $mainRepo->findBy('user','email',$email) ;

            if (empty($user)) {
                $_SESSION['error'] = 'Les informations de connexion sont incorrect.' ;
                header('Location: login');
                die();
            }

            // password verification 
            if (password_verify($pass, $user['password'])) {
                $_SESSION['user'] = $user ;
                if ($user['role' === 'ROLE_ADMIN']) {
                    header('Location: adminDashboard');
                    die();
                }
                header('Location: home');

            } else {
                $_SESSION['error'] = 'Les informations de connexion sont incorrect.' ;
                header('Location: login');
                die();
            }

        }

        $this->twig->display('login/index.html.twig',[
           
        ]);

    }

    public function logout()
    {
        unset($_SESSION['user']) ;
        header('Location: login');
    }
}