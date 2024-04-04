<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class EmailNotification {

    public function __construct(
        private MailerInterface $mailer,
        private ContainerBagInterface $params
    ){
    }

    public function adminAccountCreation($user){
        $email = (new TemplatedEmail())
            ->from('no-reply@technichem.be')
            ->to(new Address('xribant@gmail.com'))
            ->subject('Réinitialisation de mot de passe ')
            ->htmlTemplate('emails/new_password.html.twig')
            ->context(['user' => $user])
        ;

        $this->mailer->send($email);
        
    }

    public function adminAccountPasswordReset(){

    }
}