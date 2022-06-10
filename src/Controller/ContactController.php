<?php

namespace App\Controller ;

use App\Service\Mailer;

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
        if ( !empty($_POST['name']) && !empty( $_POST['email']) && !empty( $_POST['message']) ) {
            $data = [
                'name' => htmlentities($_POST['name']),
                'firstName' => htmlentities($_POST['firstName']),
                'email' => htmlentities($_POST['email']),
                'message' => htmlentities($_POST['message']),
            ];

            $mail = new Mailer ;
            $mail->contact($data) ;

            $this->redirect('home');
        }
    }

}