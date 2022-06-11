<?php

namespace App\Controller ;

use App\Mail\Mailer;

class ContactController extends MainController
{

    public function index()
    {
       
       $this->twig->display('contact/index.html.twig',[
        'test' => 'test contact'
    ]);
    }

    public function sendContact()
    {
        $_SESSION['contactInfo'] = $_POST ;

        if ( !empty($_POST['name']) && !empty( $_POST['email']) && !empty( $_POST['message']) ) {
            $data = [
                'name' => htmlspecialchars($_POST['name']),
                'firstName' => htmlspecialchars($_POST['firstName']),
                'email' => htmlspecialchars($_POST['email']),
                'message' => htmlspecialchars($_POST['message']),
            ];

            $mail = new Mailer ;
            $mail->contact($data) ;

            unset($_SESSION['contactInfo']);
            unset($_SESSION['contactError']);
            $_SESSION['contactSuccess'] = 'l\'email a bien été envoyé , nous vous contacterons dans les plus bref delai';
        }else{
            $_SESSION['contactError'] = 'veuillez emplir l\'ensemble des champs';
            unset($_SESSION['contactSuccess']);
        }
        $this->redirect('home');
    }

}