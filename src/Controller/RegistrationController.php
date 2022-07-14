<?php

namespace App\Controller;

use App\Model\User;
use App\Repo\UserRepository;

class RegistrationController extends MainController
{

    public function index()
    {
        $this->session->remove('error');

        $data = $this->global->get_POST() ;
        if (!empty($data)) {

            $name = htmlspecialchars($data['name']);
            $firstName = htmlspecialchars($data["first_name"]);
            $email = htmlspecialchars($data['email']);
            $pass = htmlspecialchars($data['password']);
            $role = 'ROLE_USER';
            $file = $_FILES['file'];

            $info =  [
                'name' => $name,
                'firstName' => $firstName,
                'email' => $email
            ];
            $this->session->write('info',$info ) ;

            if (empty($name)) {
                $this->session->write('error','veillez rensseigner votre nom ') ;
                $this->redirect('registration') ;
            }
            if (empty($firstName)) {
                $this->session->write('error','veillez rensseigner votre prénom') ;
                $this->redirect('registration') ;
            }
            if (empty($email)) {
                $this->session->write('error','veillez rensseigner une adresse email');
                $this->redirect('registration') ;
            }

            $userRepo = new UserRepository;
            $user = $userRepo->findBy('user', 'email', $email);

            if (!empty($user)) {
                $this->session->write('error','adresse email non disponible') ;
                $this->redirect('registration') ;
            }
            if (empty($pass)) {
                $this->session->write('error','le mot de passe ne doit pas etre vide ') ;
                $this->redirect('registration') ;
            }

            // hash password  
            $password = password_hash($pass, PASSWORD_DEFAULT);

            // default avatar 
            $imgName = 'default.png';

            // treatment of images
            if (!empty($file['name'])) {
                $extention = explode('.', $file['name']);
                $extention = $extention[1];
                $tmp_name = $file['tmp_name'];

                $imgName = 'profil-' . time() . '.' . $extention;
                $path_dest = ROOT . '/public/upload/user/' . $imgName;

                move_uploaded_file($tmp_name, $path_dest);
            }

            // create the user
            $user = new User;
            $user->setName($name);
            $user->setFirstName($firstName);
            $user->setRole($role);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setImage($imgName);

            $userRepo->createUser($user);

            // delete error message  and info of user
            $this->session->remove('error') ;
            $this->session->remove('info');

            $this->session->write('success','Votre compte a bien été créer') ;
            $this->redirect('login') ;
        }


        $this->twig->display('register/index.html.twig', []);
    }


}
