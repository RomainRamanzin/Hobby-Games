<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface as Mailer;

class ContactController extends AbstractController
{
    #[Route('/contactez-nous', name: 'app_contact')]
    public function index(Request $request, Mailer $mailer): Response
    {
        //création du formulaire
        $form = $this->createForm(ContactType::class);

        //récupération des données du formulaire
        $form->handleRequest($request);

        //si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            //récupération des données
            $data = $form->getData();

            //récupération des données
            $nom = $data['nom'];
            $email = $data['email'];
            $content = $data['message'];

            //préparation du mail
            $email = (new Email())
                ->from('contact.hobbygames@gmail.com')
                ->to('contact.hobbygames@gmail.com')
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Mail de contact - Hobbygames.fr')
                ->text($nom . " " . "souhaite prendre contact avec nous." . "\n" . "\n" . "Son adresse mail est" . " " . $email . "\n" . "\n" . "message :" . "\n" . $content);
            // ->html('<p>See Twig integration for better HTML integration!</p>');

            //envoi du mail
            $mailer->send($email);
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'formulaire' => $form,
        ]);
    }
}
