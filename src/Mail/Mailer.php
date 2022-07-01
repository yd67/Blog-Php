<?php

namespace App\Mail;

use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';

class Mailer
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = 'localhost';
        $this->mail->Port = 1025;
    }

    public function send($data)
    {
        $this->mail->setFrom($data['email']);
        $this->mail->addAddress('yvensBlog@gmail.com');

        $this->mail->isHTML(true);
        $this->mail->Subject = 'Blog Contact';
        $this->mail->CharSet = "utf-8";
        $this->mail->Body    = '  <h1>Demande de contact </h1> 
                    <h3>Nom  : ' . $data['name'] . ' <br>
                        Prenom : ' . $data['firstName'] . '  <br>
                        Email: ' . $data['email'] . '  <br>
                    </h3>
                    <div>
                        <h3>Message :</h3>
                        <p> ' . $data['message'] . '</p> 
                    </div>';
        $this->mail->send();
    }
}
