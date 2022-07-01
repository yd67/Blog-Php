<?php

namespace App\Controller;

use App\Mail\Mailer;

class ContactController extends MainController
{

    public function index()
    {

        $this->twig->display('contact/index.html.twig', [
            'test' => 'test contact'
        ]);
    }

    public function sendContact()
    {
        $_SESSION['contactInfo'] = $_POST;
        unset($_SESSION['contactSuccess']);
        unset($_SESSION['contactError']);

        if (empty($_POST['name'])) {
            $_SESSION['contactError'] = 'veuillez renseigner un nom';
            $this->redirect('home#contact');
        }

        if (empty($_POST['firstName'])) {
            $_SESSION['contactError'] = 'veuillez renseigner un prénom';
            $this->redirect('home#contact');
        }
        $m = strlen($_POST['message']);

        if ($m <= 15) {
            var_dump($m);
            $_SESSION['contactError'] = 'message trop court, le message doit comporter minimum 15 charactères';
            unset($_SESSION['contactSuccess']);
            $this->redirect('home#contact');
        }

        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

            $data = [
                'name' => htmlspecialchars($_POST['name']),
                'firstName' => htmlspecialchars($_POST['firstName']),
                'email' => htmlspecialchars($_POST['email']),
                'message' => htmlspecialchars($_POST['message']),
            ];

            $mail = new Mailer;
            $mail->send($data);

            unset($_SESSION['contactInfo']);
            unset($_SESSION['contactError']);
            $_SESSION['contactSuccess'] = 'l\'email a bien été envoyé , nous vous contacterons dans les plus brefs delais';
            $this->redirect('home');
        } else {
            $_SESSION['contactError'] = 'l\'addresse email n\'est pas valide ';
            $this->redirect('home#contact');
        }
    }
}
