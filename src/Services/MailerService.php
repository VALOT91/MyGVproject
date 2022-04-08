<?php 

namespace App\Services;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class MailerService 
{

    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendContactMail($emailCustomer,$content)
    {
        $email = (new TemplatedEmail())
            ->from($emailCustomer)
            ->to('contact_plt@gvalot.fr')
            ->subject('Message de contact de client')
            ->htmlTemplate('email/contact.html.twig')
            ->context([
                'content' => $content,
                'emailCustomer' => $emailCustomer
            ])
        ;
        
        $this->mailer->send($email);

    } 
    public function sendConfirmationEmail($user)
    {
        $email = (new TemplatedEmail())
            ->from('noreply@monsite.fr')
            ->to($user->getEmail())
            ->subject('Confirmation de votre compte par email')
            ->htmlTemplate('email/confirmation_account.html.twig')
            ->context([
                'user' => $user
            ]);

        $this->mailer->send($email);
    }

    public function sendLostPasswordEmail($user)
    {
     
        $email = (new TemplatedEmail())
            ->from('noreply@monsite.fr')
            ->to($user->getEmail())
            ->subject('Modification de votre mot de passe')
            ->htmlTemplate('email/password_lost.html.twig')
            ->context([
                'user' => $user
            ]);

        $this->mailer->send($email);
    }
}