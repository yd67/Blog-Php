<?php

namespace App\Controller;

use App\Model\User;
use App\Repo\UserRepository;

class RegistrationController extends MainController
{

    public function index()
    {
        unset($_SESSION['error']);

        if (!empty($_POST)) {

            $name = htmlspecialchars($_POST['name']);
            $firstName = htmlspecialchars($_POST["first_name"]);
            $email = htmlspecialchars($_POST['email']);
            $pass = htmlspecialchars($_POST['password']);
            $role = 'ROLE_USER';
            $file = $_FILES['file'];

            $_SESSION['info'] =  [
                'name' => $name,
                'firstName' => $firstName,
                'email' => $email
            ];

            if (empty($name)) {
                $_SESSION['error'] = 'veillez rensseigner votre nom ';
                $this->redirect('registration') ;
            }
            if (empty($firstName)) {
                $_SESSION['error'] = 'veillez rensseigner votre prénom ';
                $this->redirect('registration') ;
            }
            if (empty($email)) {
                $_SESSION['error'] = 'veillez rensseigner une adresse email ';
                $this->redirect('registration') ;
            }

            $userRepo = new UserRepository;
            $user = $userRepo->findBy('user', 'email', $email);

            if (!empty($user)) {
                $_SESSION['error'] = 'adresse email non disponible';
                $this->redirect('registration') ;
            }
            if (empty($pass)) {
                $_SESSION['error'] = 'le mot de passe ne doit pas etre vide ';
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
            unset($_SESSION['error']);
            unset($_SESSION['info']);

            $_SESSION['success'] = 'Votre compte a bien été créer';
            $this->redirect('login') ;
        }


        $this->twig->display('register/index.html.twig', []);
    }


    public function register()
    {
    }
}
