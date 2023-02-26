<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;


class UtilisateurFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        $user = new User();
        $user->setEmail('sinan@hotmail.com');
        $user->setRoles(['ROLE_USER']);

        $plainPassword = 'admin123';
        $encodedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);
        $user->setPassword($encodedPassword);

        $manager->persist($user);

        $manager->flush();
    }
}
