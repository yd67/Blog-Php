<?php

namespace App\Controller ;

use App\Repo\MainRepository;

class LoginController extends MainController
{
    public function index()
    {
        $this->session->remove('error');

        $data = $this->global->get_POST() ;

        if (!empty($data)) {
            $this->session->remove('success');
            
            $email = htmlspecialchars($data['email']);
            $pass = htmlspecialchars($data['password']);
            $info =  [
                'email' => $email
            ];
            $this->session->write('info',$info) ;

            $mainRepo = new MainRepository ; 
            $user = $mainRepo->findBy('user','email',$email) ;

            if (empty($user)) {
                $this->session->write('error','Les informations de connexion sont incorrect.') ;
                $this->redirect('login');
            }

            // password verification 
            if (password_verify($pass, $user['password'])) {
                unset($user['password']);
                $this->session->write('user',$user);
                if ($user['role'] === 'ROLE_ADMIN') {
                    $this->redirect('adminPost') ;
                }
                $this->redirect('post') ;

            } else {
                $this->session->write('error','Les informations de connexion sont incorrect.') ;
                $this->redirect('login') ;
            }

        }

        $this->twig->display('login/index.html.twig',[
           
        ]);

    }

    public function logout()
    {
        $this->session->remove('user');
        $this->redirect('login') ;
    }
}
