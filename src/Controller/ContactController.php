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
        $data = $_POST ;
        $_SESSION['contactInfo'] = $data;
        unset($_SESSION['contactSuccess']);
        unset($_SESSION['contactError']);

        if (empty($data['name'])) {
            $_SESSION['contactError'] = 'veuillez renseigner un nom';
            $this->redirect('home#contact');
        }

        if (empty($data['firstName'])) {
            $_SESSION['contactError'] = 'veuillez renseigner un prénom';
            $this->redirect('home#contact');
        }
        $m = strlen($data['message']);

        if ($m <= 15) {
            $_SESSION['contactError'] = 'message trop court, le message doit comporter minimum 15 charactères';
            unset($_SESSION['contactSuccess']);
            $this->redirect('home#contact');
        }

        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {

            $dataMessage = [
                'name' => htmlspecialchars($data['name']),
                'firstName' => htmlspecialchars($data['firstName']),
                'email' => htmlspecialchars($data['email']),
                'message' => htmlspecialchars($data['message']),
            ];

            $mail = new Mailer;
            $mail->send($dataMessage);

            unset($_SESSION['contactInfo']);
            unset($_SESSION['contactError']);
            $_SESSION['contactSuccess'] = 'l\'email a bien été envoyé , nous vous contacterons dans les plus brefs delais';
            $this->redirect('home#contact');
        } else {
            $_SESSION['contactError'] = 'l\'addresse email n\'est pas valide ';
            $this->redirect('home#contact');
        }
    }
}
