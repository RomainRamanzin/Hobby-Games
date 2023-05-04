<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserDataType;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    #[IsGranted('ROLE_USER')]
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasher, SluggerInterface $slugger): Response
    {
        $userId = $this->getUser()->getId();
        $user = $em->getRepository(User::class)->find($userId);

        $formUserData = $this->createForm(UserDataType::class, $user);
        $formPassword = $this->createForm(ChangePasswordType::class);

        $formUserData->handleRequest($request);
        $formPassword->handleRequest($request);

        if($formUserData->isSubmitted()){
            if($formUserData->isValid()){
                // Gestion image de profil
                $avatarFile = $formUserData->get('avatar')->getData();

                if($avatarFile){
                    $originalFilename = pathinfo($avatarFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$avatarFile->guessExtension();

                    // Déplacement de l'image dans le dossier profil_pictures
                    try {
                        $avatarFile->move(
                            'profil_pictures',
                            $newFilename
                        );
                    } catch (FileException $e) {
                        $this->addFlash('error-avatar', 'Une erreur est survenue lors de l\'upload de l\'image');
                    }

                    // Suppression de l'ancienne image
                    $oldAvatar = $user->getAvatar();
                    if(file_exists($oldAvatar)){
                        try{
                            unlink($oldAvatar);
                        } catch (FileException $e) {
                            new FileException('Une erreur est survenue lors de la suppression de l\'ancienne image');
                        }
                    }
                    // Mise à jour de l'image de profil
                    $user->setAvatar($request->getSchemeAndHttpHost() .'/profil_pictures/'.$newFilename);
                }

                // Enregistrement des données
                $em->persist($user);
                $em->flush();
                $this->addFlash(
                    'success-UserData',
                    'Les informations ont bien été enregistrées'
                );
            }
            $em->refresh($user);
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
