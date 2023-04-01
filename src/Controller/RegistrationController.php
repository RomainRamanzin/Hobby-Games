<?php

namespace App\Controller;

use App\Entity\User;
use App\Security\EmailVerifier;
use Symfony\Component\Mime\Email;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Address;
use App\Security\ConnexionAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailHelperInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface as VerifyEmailVerifyEmailHelperInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, VerifyEmailVerifyEmailHelperInterface $verifyEmailHelper, MailerInterface $mailerInterface, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Enregistrer l'utilisateur en base de données
            $entityManager->persist($user);
            $entityManager->flush();

            // Generate a signature for the email
            $signatureComponents = $verifyEmailHelper->generateSignature(
                'app_verify_email',
                $user->getId(),
                $user->getEmail(),
                ['id' => $user->getId()]
            );

            // Create a signed url and email it to the user
            $email = (new TemplatedEmail())
                ->from(new Address('sinan.cours@gmail.com', 'sinan'))
                ->to($user->getEmail())
                ->subject('Merci de confirmer votre email')
                ->htmlTemplate('registration/confirmation_email.html.twig')
                ->context([
                    'signedUrl' => $signatureComponents->getSignedUrl(),
                    'expiresAtMessageKey' => $signatureComponents->getExpirationMessageKey(),
                    'expiresAtMessageData' => $signatureComponents->getExpirationMessageData(),
                ]);

            // Send the email
            $mailerInterface->send($email);

            // Informer l'utilisateur qu'un email de confirmation lui a été envoyé
            $this->addFlash('success', 'Un email de confirmation vous a été envoyé, merci de cliquer sur le lien pour valider votre inscription.');

            // Rediriger l'utilisateur vers la page de connexion
            return $this->redirectToRoute('app_login');

        }

        // Afficher le formulaire d'inscription
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/resend', name: 'app_verify_resend')]
    public function resendVerifyEmail()
    {
        // todo: 
        return $this->render('registration/resend_verify_email.html.twig');
    }


    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, VerifyEmailVerifyEmailHelperInterface $verifyEmailHelper, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        // Récuperer l'utilisateur
        $user = $userRepository->find($request->query->get('id'));

        // Vérifier l'authenticité de l'utilisateur
        if (!$user) {
            throw $this->createNotFoundException();
        }
        try {
            $verifyEmailHelper->validateEmailConfirmation(
                $request->getUri(),
                $user->getId(),
                $user->getEmail(),
            );
        } catch (VerifyEmailExceptionInterface $e) {
            $this->addFlash('error', $e->getReason());

            // Rediriger l'utilisateur vers la page d'inscription
            return $this->redirectToRoute('app_register');
        }

        // Activer le compte de l'utilisateur
        $user->setIsVerified(true);
        $entityManager->flush();

        // Informer l'utilisateur que son compte a bien été vérifié
        $this->addFlash('success', 'Votre compte a bien été vérifié! Vous pouvez vous connecter.');

        // Rediriger l'utilisateur vers la page de connexion
        return $this->redirectToRoute('app_login');
    }
}
