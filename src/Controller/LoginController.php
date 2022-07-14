<?php

namespace App\Controller ;

use App\Repo\MainRepository;

class LoginController extends MainController
{
    public function index()
    {
        unset($_SESSION['error']);

        $data = $_POST ;

        if (!empty($data)) {
            unset($_SESSION['success']);
            
            $email = htmlspecialchars($data['email']);
            $pass = htmlspecialchars($data['password']);
            $_SESSION['info'] =  [
                'email' => $email
            ];

            $mainRepo = new MainRepository ; 
            $user = $mainRepo->findBy('user','email',$email) ;

            if (empty($user)) {
                $_SESSION['error'] = 'Les informations de connexion sont incorrect.' ;
                $this->redirect('login');
            }

            // password verification 
            if (password_verify($pass, $user['password'])) {
                unset($user['password']);
                $_SESSION['user'] = $user ;
                if ($user['role'] === 'ROLE_ADMIN') {
                    $this->redirect('adminPost') ;
                }
                $this->redirect('post') ;

            } else {
                $_SESSION['error'] = 'Les informations de connexion sont incorrect.' ;
                $this->redirect('login') ;
            }

        }

        $this->twig->display('login/index.html.twig',[
           
        ]);

    }

    public function logout()
    {
        unset($_SESSION['user']) ;
        $this->redirect('login') ;
    }
}
