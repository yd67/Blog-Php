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
        $data = $this->global->get_POST() ;
        $this->session->write('contactInfo',$data);
        $this->session->remove('contactSuccess');
        $this->session->remove('contactError');

        if (empty($data['name'])) {
            $this->session->write('contactError','veuillez renseigner un nom');
            $this->redirect('home#contact');
        }

        if (empty($data['firstName'])) {
            $this->session->write('contactError','veuillez renseigner un prénom');
            $this->redirect('home#contact');
        }
        $m = strlen($data['message']);

        if ($m <= 15) {
            $this->session->write('contactError','message trop court, le message doit comporter minimum 15 charactères');
        
            $this->session->remove('contactSuccess');
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

            $this->session->remove('contactInfo');
            $this->session->remove('contactError');

            $this->session->write('contactSuccess');
            $this->redirect('home#contact','l\'email a bien été envoyé , nous vous contacterons dans les plus brefs delais');
        } else {
            $this->session->write('contactError','l\'addresse email n\'est pas valide ') ;
            $this->redirect('home#contact');
        }
    }
}
