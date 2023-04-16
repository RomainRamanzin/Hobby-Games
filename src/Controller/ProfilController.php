<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use App\Form\UserDataType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = $this->getUser();

        //récuperer le form du userData
        $formUserData = $this->createForm(UserDataType::class, $user);

        //form for password change
        $formPassword = $this->createForm(ChangePasswordType::class);

        $formUserData->handleRequest($request);
        $formPassword->handleRequest($request);

        if ($formUserData->isSubmitted() && $formUserData->isValid()) {
            //TODO gestion image de profil
            $em->persist($user);
            $em->flush();
            $this->addFlash(
               'success-UserData',
               'Les informations ont bien été enregistrées'
            );
        }

        if ($formPassword->isSubmitted() && $formPassword->isValid()) {

            $oldPassword = $formPassword->get('oldPassword')->getData();
            $newPassword = $formPassword->get('newPassword')->getData();
            $newPasswordConfirm = $formPassword->get('newPasswordConfirm')->getData();

            if ($newPassword === $newPasswordConfirm) {
                if($userPasswordHasher->isPasswordValid($user, $oldPassword)){
                    $user->setPassword($userPasswordHasher->hashPassword($user, $newPassword));
                    $em->persist($user);
                    $em->flush();

                    $this->addFlash('success-password', 'Le mot de passe a bien été modifié');
                }
                else {
                    $this->addFlash('error-password', 'Le mot de passe actuel est incorrect');
                }
            }
            else {
                $this->addFlash('error-password', 'Les mots de passe ne correspondent pas');
            }
        }


        return $this->render('profil/index.html.twig', [
            'formUserData' => $formUserData->createView(),
            'formPassword' => $formPassword->createView(),
        ]);
    }
}
