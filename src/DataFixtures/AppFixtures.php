<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Brand;
use App\Entity\CategorySanction;
use App\Entity\Type;
use App\Entity\Editor;
use App\Entity\Game;
use App\Entity\GamePicture;
use App\Entity\Platform;
use App\Entity\Publication;
use App\Entity\Review;
use App\Entity\Sanction;
use App\Entity\Section;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);


        // Types de jeux
        $type1 = new Type();
        $type1->setName('Action');
        $manager->persist($type1);

        $type2 = new Type();
        $type2->setName('RPG');
        $manager->persist($type2);

        $type3 = new Type();
        $type3->setName('FPS');
        $manager->persist($type3);

        $type4 = new Type();
        $type4->setName('MMORPG');
        $manager->persist($type4);

        $type5 = new Type();
        $type5->setName('MOBA');
        $manager->persist($type5);

        $type6 = new Type();
        $type6->setName('Sport');
        $manager->persist($type6);

        $type7 = new Type();
        $type7->setName('Stratégie');
        $manager->persist($type7);

        $type8 = new Type();
        $type8->setName('Simulation');
        $manager->persist($type8);

        $type10 = new Type();
        $type10->setName('Aventure');
        $manager->persist($type10);

        $type12 = new Type();
        $type12->setName('Horreur');
        $manager->persist($type12);

        $type13 = new Type();
        $type13->setName('Survie');
        $manager->persist($type13);

        $type14 = new Type();
        $type14->setName('Course');
        $manager->persist($type14);

        $type15 = new Type();
        $type15->setName('Battle Royale');
        $manager->persist($type15);

        $type16 = new Type();
        $type16->setName('Combat');
        $manager->persist($type16);

        $type17 = new Type();
        $type17->setName('tacktique');
        $manager->persist($type17);


        // Editeurs
        $editeur1 = new Editor();
        $editeur1->setName('Ubisoft');
        $editeur1->setLogo('https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Ubisoft_logo.svg/1000px-Ubisoft_logo.svg.png');
        $manager->persist($editeur1);

        $editeur2 = new Editor();
        $editeur2->setName('EA');
        $editeur2->setLogo('https://upload.wikimedia.org/wikipedia/commons/thumb/0/0d/Electronic-Arts-Logo.svg/2048px-Electronic-Arts-Logo.svg.png');
        $manager->persist($editeur2);

        $editeur3 = new Editor();
        $editeur3->setName('Activision');
        $editeur3->setLogo('https://upload.wikimedia.org/wikipedia/commons/thumb/0/01/Activision.svg/2560px-Activision.svg.png');
        $manager->persist($editeur3);

        $editeur4 = new Editor();
        $editeur4->setName('Bethesda');
        $editeur4->setLogo('https://logo-marque.com/wp-content/uploads/2021/02/Bethesda-Logo.png');
        $manager->persist($editeur4);

        $editeur5 = new Editor();
        $editeur5->setName('Rockstar');
        $editeur5->setLogo('https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Rockstar_Games_Logo.svg/1200px-Rockstar_Games_Logo.svg.png');
        $manager->persist($editeur5);

        $editeur6 = new Editor();
        $editeur6->setName('Microsoft');
        $editeur6->setLogo('https://www.1min30.com/wp-content/uploads/2017/09/logo-microsoft-scaled.jpg');
        $manager->persist($editeur6);

        $editeur7 = new Editor();
        $editeur7->setName('Sony');
        $editeur7->setLogo('https://logos-marques.com/wp-content/uploads/2021/03/Sony-Logo.png');
        $manager->persist($editeur7);

        $editeur8 = new Editor();
        $editeur8->setName('Nintendo');
        $editeur8->setLogo('https://upload.wikimedia.org/wikipedia/commons/thumb/0/0d/Nintendo.svg/2560px-Nintendo.svg.png');
        $manager->persist($editeur8);


        //brand
        $brand1 = new Brand();
        $brand1->setName('Sony');
        $brand1->setLogo('https://logos-marques.com/wp-content/uploads/2021/03/Sony-Logo.png');
        $manager->persist($brand1);

        $brand2 = new Brand();
        $brand2->setName('Microsoft');
        $brand2->setLogo('https://www.1min30.com/wp-content/uploads/2017/09/logo-microsoft-scaled.jpg');
        $manager->persist($brand2);

        $brand3 = new Brand();
        $brand3->setName('Nintendo');
        $brand3->setLogo('https://upload.wikimedia.org/wikipedia/commons/thumb/0/0d/Nintendo.svg/2560px-Nintendo.svg.png');
        $manager->persist($brand3);

        $brand4 = new Brand();
        $brand4->setName('Sega');
        $brand4->setLogo('https://upload.wikimedia.org/wikipedia/commons/thumb/1/13/SEGA_logo.svg/2560px-SEGA_logo.svg.png');
        $manager->persist($brand4);


        
        //platform
        $platform1 = new Platform();
        $platform1->setName('PC');
        $platform1->setLogo('https://img2.freepng.fr/20180324/ujw/kisspng-windows-7-microsoft-logo-windows-8-microsoft-5ab6ff6b526bf9.4269304415219423793376.jpg');
        $manager->persist($platform1);

        $platform2 = new Platform();
        $platform2->setName('Playstation 4');
        $platform2->setBrand($brand1);
        $platform2->setLogo('https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PlayStation_4_logo_and_wordmark.svg/1280px-PlayStation_4_logo_and_wordmark.svg.png');
        $manager->persist($platform2);

        $platform3 = new Platform();
        $platform3->setName('Playstation 5');
        $platform3->setBrand($brand1);
        $platform3->setLogo('https://upload.wikimedia.org/wikipedia/commons/thumb/7/7a/PS5_logo.png/800px-PS5_logo.png');
        $manager->persist($platform3);

        $platform4 = new Platform();
        $platform4->setName('Xbox One');
        $platform4->setBrand($brand2);
        $platform4->setLogo('https://upload.wikimedia.org/wikipedia/fr/c/c4/Xbox_One_Logo.png');
        $manager->persist($platform4);

        $platform5 = new Platform();
        $platform5->setName('Xbox Series X');
        $platform5->setBrand($brand2);
        $platform5->setLogo('https://upload.wikimedia.org/wikipedia/commons/thumb/a/af/Xbox_Series_X_logo.svg/2028px-Xbox_Series_X_logo.svg.png');
        $manager->persist($platform5);

        $platform6 = new Platform();
        $platform6->setName('Nintendo Switch');
        $platform6->setBrand($brand3);
        $platform6->setLogo('https://upload.wikimedia.org/wikipedia/commons/3/38/Nintendo_switch_logo.png');
        $manager->persist($platform6);


        //games
        $game1 = new Game();
        $game1->setName('Assassin\'s Creed Valhalla');
        $game1->setReleaseDate(new \DateTime('2020-11-10'));
        $game1->setDescription('Assassin\'s Creed Valhalla est un jeu vidéo d\'action-aventure et de rôle développé par Ubisoft Montréal et édité par Ubisoft. Il est sorti le 10 novembre 2020 sur PlayStation 4, Xbox One, Stadia, Microsoft Windows, PlayStation 5 et Xbox Series X/S. Il s\'agit du dixième opus de la série Assassin\'s Creed et du premier à se dérouler en Angleterre. Le jeu est également disponible sur PlayStation 5 et Xbox Series X/S en version améliorée, avec une résolution 4K et des chargements plus rapides.');
        $game1->setPoster("https://image.jeuxvideo.com/medias/158826/1588264397-5261-jaquette-avant.jpg");
        $game1->setAgeLimit(18);
        $game1->addPlatform($platform1);
        $game1->addPlatform($platform2);
        $game1->addPlatform($platform3);
        $game1->addType($type1);
        $game1->addType($type2);
        $game1->addType($type3);
        $game1->setEditor($editeur2);
        $manager->persist($game1);

        $game2 = new Game();
        $game2->setName('Call of Duty: Black Ops Cold War');
        $game2->setReleaseDate(new \DateTime('2020-11-13'));
        $game2->setDescription('Call of Duty: Black Ops Cold War est un jeu vidéo de tir à la première personne développé par Treyarch et Raven Software et édité par Activision. Il est sorti le 13 novembre 2020 sur PlayStation 4, Xbox One, Stadia, Microsoft Windows, PlayStation 5 et Xbox Series X/S. Il s\'agit du dixième opus de la série Call of Duty et du sixième à se dérouler dans les années 1980. Le jeu est également disponible sur PlayStation 5 et Xbox Series X/S en version améliorée, avec une résolution 4K et des chargements plus rapides.');
        $game2->setPoster("https://image.jeuxvideo.com/medias/163301/1633014178-150-jaquette-avant.gif");
        $game2->setAgeLimit(18);
        $game2->addPlatform($platform1);
        $game2->addPlatform($platform4);
        $game2->addPlatform($platform3);
        $game2->addType($type2);
        $game2->addType($type3);
        $game2->setEditor($editeur3);
        $manager->persist($game2);

        $game3 = new Game();
        $game3->setName('Cyberpunk 2077');
        $game3->setReleaseDate(new \DateTime('2020-12-10'));
        $game3->setDescription('Cyberpunk 2077 est un jeu vidéo d\'action-RPG développé et édité par CD Projekt. Il est sorti le 10 décembre 2020 sur PlayStation 4, Xbox One, Stadia, Microsoft Windows, PlayStation 5 et Xbox Series X/S. Il s\'agit du premier jeu de la série Cyberpunk et du neuvième opus de la série The Witcher. Le jeu est également disponible sur PlayStation 5 et Xbox Series X/S en version améliorée, avec une résolution 4K et des chargements plus rapides.');
        $game3->setPoster("https://image.jeuxvideo.com/medias/163835/1638354762-4961-jaquette-avant.gif");
        $game3->setAgeLimit(18);
        $game3->addPlatform($platform1);
        $game3->addPlatform($platform2);
        $game3->addPlatform($platform3);
        $game3->addType($type1);
        $game3->addType($type2);
        $game3->addType($type3);
        $game3->setEditor($editeur4);
        $manager->persist($game3);

        $game4 = new Game();
        $game4->setName('Grand Theft Auto V');
        $game4->setReleaseDate(new \DateTime('2013-09-17'));
        $game4->setDescription('Grand Theft Auto V est un jeu vidéo d\'action-aventure développé par Rockstar North et édité par Rockstar Games. Il est sorti le 17 septembre 2013 sur PlayStation 3 et Xbox 360, puis le 18 novembre 2014 sur PlayStation 4 et Xbox One, et le 14 avril 2015 sur Microsoft Windows. Il s\'agit du dixième opus de la série Grand Theft Auto et du premier à avoir lieu dans un univers ouvert. Le jeu est également disponible sur PlayStation 5 et Xbox Series X/S en version améliorée, avec une résolution 4K et des chargements plus rapides.');
        $game4->setPoster("https://image.jeuxvideo.com/medias/163129/1631287693-8700-jaquette-avant.jpg");
        $game4->setAgeLimit(18);
        $game4->addPlatform($platform1);
        $game4->addPlatform($platform2);
        $game4->addPlatform($platform3);
        $game4->addType($type1);
        $game4->addType($type2);
        $game4->addType($type3);
        $game4->setEditor($editeur5);
        $manager->persist($game4);

        $game5 = new Game();
        $game5->setName('Red Dead Redemption 2');
        $game5->setReleaseDate(new \DateTime('2018-10-26'));
        $game5->setDescription('Red Dead Redemption 2 est un jeu vidéo d\'action-aventure développé par Rockstar Studios et édité par Rockstar Games. Il est sorti le 26 octobre 2018 sur PlayStation 4 et Xbox One, puis le 5 novembre 2019 sur Microsoft Windows. Il s\'agit du dixième opus de la série Grand Theft Auto et du premier à avoir lieu dans un univers ouvert. Le jeu est également disponible sur PlayStation 5 et Xbox Series X/S en version améliorée, avec une résolution 4K et des chargements plus rapides.');
        $game5->setPoster("https://image.jeuxvideo.com/medias/165165/1651652506-3619-jaquette-avant.jpg");
        $game5->setAgeLimit(18);
        $game5->addPlatform($platform1);
        $game5->addPlatform($platform2);
        $game5->addPlatform($platform3);
        $game5->addType($type1);
        $game5->addType($type2);
        $game5->addType($type3);
        $game5->setEditor($editeur5);
        $manager->persist($game5);

        $game6 = new Game();
        $game6->setName('Assetto Corsa Competizione');
        $game6->setReleaseDate(new \DateTime('2019-06-27'));
        $game6->setDescription('Assetto Corsa Competizione est un jeu vidéo de course développé par Kunos Simulazioni et édité par 505 Games. Il est sorti le 27 juin 2019 sur PlayStation 4, Xbox One et Microsoft Windows. Il s\'agit du troisième opus de la série Assetto Corsa. Le jeu est également disponible sur PlayStation 5 et Xbox Series X/S en version améliorée, avec une résolution 4K et des chargements plus rapides.');
        $game6->setPoster("https://image.jeuxvideo.com/medias/158394/1583942452-4805-jaquette-avant.jpg");
        $game6->setAgeLimit(3);
        $game6->addPlatform($platform1);
        $game6->addPlatform($platform2);
        $game6->addPlatform($platform3);
        $game6->addType($type1);
        $game6->addType($type2);
        $game6->addType($type3);
        $game6->setEditor($editeur6);
        $manager->persist($game6);

        $game7 = new Game();
        $game7->setName('FIFA 21');
        $game7->setReleaseDate(new \DateTime('2020-10-09'));
        $game7->setDescription('FIFA 21 est un jeu vidéo de football développé par EA Vancouver et EA Bucharest et édité par Electronic Arts. Il est sorti le 9 octobre 2020 sur PlayStation 4, Xbox One, PlayStation 5, Xbox Series X/S, Nintendo Switch et Microsoft Windows. Il s\'agit du 28e opus de la série FIFA. Le jeu est également disponible sur PlayStation 5 et Xbox Series X/S en version améliorée, avec une résolution 4K et des chargements plus rapides.');
        $game7->setPoster("https://image.jeuxvideo.com/medias/159543/1595431314-3197-jaquette-avant.jpg");
        $game7->setAgeLimit(3);
        $game7->addPlatform($platform1);
        $game7->addPlatform($platform2);
        $game7->addPlatform($platform3);
        $game7->addType($type1);
        $game7->addType($type2);
        $game7->addType($type3);
        $game7->setEditor($editeur7);
        $manager->persist($game7);


        //users
        $user1 = new User();
        $user1->setAvatar('https://cdn-s-www.leprogres.fr/images/ED82BE29-CBAC-40EC-B71C-285CD717A43C/NW_raw/la-voiture-noire-de-bugatti-modele-unique-photo-dr-1608828241.jpg');
        $user1->setEmail('romain.ramanzin@gmail.com');

        $plainPassword = '12345678';
        $encodedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);
        $user1->setPassword($encodedPassword);

        $user1->setRoles(['ROLE_ADMIN']);
        $user1->setPseudo('RomainRr');
        $user1->setSurname('Ramanzin');
        $user1->setFirstname('Romain');
        $user1->setDateOfBirth(new \DateTime('2002-07-02'));
        $user1->setAccountCreationDate(new \DateTime('2020-10-09'));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setAvatar('https://www.bmw.fr/content/dam/bmw/common/all-models/m-series/m5-sedan/2021/Overview/bmw-m5-cs-onepager-mc-m5-cs-highlights-hero-teaser-desktop.jpg.asset.1627456767620.jpg');
        $user2->setEmail('sinanyzc27200@hotmail.com');
        $plainPassword = '12345678';
        $encodedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);
        $user2->setPassword($encodedPassword);
        $user2->setRoles(['ROLE_ADMIN']);
        $user2->setPseudo('Sinanyzc');
        $user2->setSurname('Yazici');
        $user2->setFirstname('Sinan');
        $user2->setDateOfBirth(new \DateTime('2001-01-01'));
        $user2->setAccountCreationDate(new \DateTime('2020-10-09'));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail('bob.eponge@gmail.com');
        $plainPassword = '12345678';
        $encodedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);
        $user3->setPassword($encodedPassword);
        $user3->setRoles(['ROLE_ADMIN']);
        $user3->setPseudo('Boblp');
        $user3->setSurname('Eponge');
        $user3->setFirstname('Bob');
        $user3->setDateOfBirth(new \DateTime('1999-01-01'));
        $user3->setAccountCreationDate(new \DateTime('2020-10-09'));
        $manager->persist($user3);


        //category sanctions
        $categorySanction1 = new CategorySanction();
        $categorySanction1->setName('Troll');
        $manager->persist($categorySanction1);

        $categorySanction2 = new CategorySanction();
        $categorySanction2->setName('Harcèlement');
        $manager->persist($categorySanction2);

        $categorySanction3 = new CategorySanction();
        $categorySanction3->setName('Propos racistes');
        $manager->persist($categorySanction3);

        $categorySanction4 = new CategorySanction();
        $categorySanction4->setName('Propos homophobes');

        $manager->persist($categorySanction4);
        $categorySanction4->setName('Contenu pornographique');
        $manager->persist($categorySanction4);

        $categorySanction5 = new CategorySanction();
        $categorySanction5->setName('Contenu violent');
        $manager->persist($categorySanction5);


        //Sanctions
        $sanction1 = new Sanction();
        $sanction1->setComment("Vous avez été sanctionné pour avoir troller");
        $sanction1->setBanDuration(20);
        $sanction1->setCategory($categorySanction1);
        $sanction1->setUser($user1);
        $manager->persist($sanction1);

        $sanction2 = new Sanction();
        $sanction2->setComment("Vous avez été sanctionné pour avoir publié du contenu pornographique");
        $sanction2->setBanDuration(168);
        $sanction2->setCategory($categorySanction4);
        $sanction2->setUser($user2);
        $manager->persist($sanction2);


        //articles
        $article1 = new Article();
        $article1->setTitle('Le jeu vidéo est-il un sport ?');
        $article1->setCover('https://media.nouvelobs.com/ext/uri/sreferentiel.nouvelobs.com/file/rue89/bb41753b673f994d18fd127b71c44dff.jpg');
        $article1->setIsValided(true);
        $article1->setPublicationDate(new \DateTime('2022-12-09'));
        $article1->setLastLodifiedDate(new \DateTime('2022-12-09'));
        $article1->setNumberOfViews(1836);
        $article1->setWritedBy($user1);
        $article1->setValidatedBy($user2);
        $manager->persist($article1);

        $article2 = new Article();
        $article2->setTitle('Comment devenir un pro du jeu vidéo ?');
        $article2->setCover('https://www.letudiant.fr/static/uploads/mediatheque/ETU_ETU/1/5/2644415-metier-gamer-pro-letudiant-766x438.jpg');
        $article2->setIsValided(true);
        $article2->setPublicationDate(new \DateTime('2022-12-10'));
        $article2->setLastLodifiedDate(new \DateTime('2022-12-19'));
        $article2->setNumberOfViews(17986);
        $article2->setWritedBy($user2);
        $article2->setValidatedBy($user1);
        $manager->persist($article2);


        //section articles
        $section1 = new Section();
        $section1->setTitle('Introduction');
        $section1->setDescription('Dans cet article, nous allons voir si le jeu vidéo est un sport');
        $section1->setArticle($article1);
        $manager->persist($section1);

        $section2 = new Section();
        $section2->setTitle('Définition');
        $section2->setDescription('Voici la définition du jeu vidéo');
        $section2->setArticle($article1);
        $manager->persist($section2);

        $section3 = new Section();
        $section3->setTitle('Conclusion');
        $section3->setDescription('Voici la conclusion de l\'article');
        $section3->setArticle($article1);
        $manager->persist($section3);

        $section4 = new Section();
        $section4->setTitle('Introduction');
        $section4->setDescription('Dans cet article, nous allons voir comment devenir un pro du jeu vidéo');
        $section4->setArticle($article2);
        $manager->persist($section4);

        $section5 = new Section();
        $section5->setTitle('Quel jeu choisir ?');
        $section5->setDescription('Voici les jeux à choisir pour devenir un pro du jeu vidéo');
        $section5->setArticle($article2);
        $manager->persist($section5);


        //reviews
        $review1 = new Review();
        $review1->setTitle('Ce jeu est vraiment bien');
        $review1->setContent('Ce jeu est super, je le recommande, il est très fun');
        $review1->setRate(5);
        $review1->setPublicationDate(new \DateTime('2022-12-19'));
        $review1->setIsDeleted(false);
        $manager->persist($review1);

        $review2 = new Review();
        $review2->setTitle('Ce jeu est vraiment nul');
        $review2->setContent('Ce jeu est nul, je ne le recommande pas, il est très nul');
        $review2->setRate(1);
        $review2->setPublicationDate(new \DateTime('2022-12-19'));
        $review2->setIsDeleted(false);
        $manager->persist($review2);

        $review3 = new Review();
        $review3->setTitle('Que des bugs');
        $review3->setContent('Ce jeu est super, mais il y a beaucoup de bugs');
        $review3->setRate(3);
        $review3->setPublicationDate(new \DateTime('2022-12-21'));
        $review3->setIsDeleted(false);
        $manager->persist($review3);

        $review4 = new Review();
        $review4->setTitle('C\'est de la merde');
        $review4->setContent('Vraiment nul on se fait chier');
        $review4->setRate(1);
        $review4->setPublicationDate(new \DateTime('2022-12-21'));
        $review4->setIsDeleted(true);
        $manager->persist($review4);



        //publication
        $publication1 = new Publication();
        $publication1->setUser($user1);
        $publication1->setGame($game1);
        $publication1->setReview($review1);
        $manager->persist($publication1);

        $publication2 = new Publication();
        $publication2->setUser($user2);
        $publication2->setGame($game2);
        $publication2->setReview($review2);
        $manager->persist($publication2);

        $publication3 = new Publication();
        $publication3->setUser($user3);
        $publication3->setGame($game3);
        $publication3->setReview($review3);

        $publication4 = new Publication();
        $publication4->setUser($user3);
        $publication4->setGame($game3);
        $publication4->setReview($review4);
        $manager->persist($publication4);









        $manager->flush();
    }
}
