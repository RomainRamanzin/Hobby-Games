<?php

namespace App\DataFixtures;

use App\Entity\Article;
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
        $manager->persist($editeur1);

        $editeur2 = new Editor();
        $editeur2->setName('EA');
        $manager->persist($editeur2);

        $editeur3 = new Editor();
        $editeur3->setName('Activision');
        $manager->persist($editeur3);

        $editeur4 = new Editor();
        $editeur4->setName('Bethesda');
        $manager->persist($editeur4);

        $editeur5 = new Editor();
        $editeur5->setName('Rockstar');
        $manager->persist($editeur5);

        $editeur6 = new Editor();
        $editeur6->setName('Microsoft');
        $manager->persist($editeur6);

        $editeur7 = new Editor();
        $editeur7->setName('Sony');
        $manager->persist($editeur7);

        $editeur8 = new Editor();
        $editeur8->setName('Nintendo');
        $manager->persist($editeur8);


        //platform
        $platform1 = new Platform();
        $platform1->setName('PC');
        $manager->persist($platform1);

        $platform2 = new Platform();
        $platform2->setName('Playstation 4');
        $manager->persist($platform2);

        $platform3 = new Platform();
        $platform3->setName('Playstation 5');
        $manager->persist($platform3);

        $platform4 = new Platform();
        $platform4->setName('Xbox One');
        $manager->persist($platform4);

        $platform5 = new Platform();
        $platform5->setName('Xbox Series X');
        $manager->persist($platform5);

        $platform6 = new Platform();
        $platform6->setName('Nintendo Switch');
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

        $picture1 = new GamePicture();
        $picture1->setPicture('https://image.jeuxvideo.com/medias/159967/1599666332-6811-capture-d-ecran.jpg');
        $picture1->setGame($game2);
        $manager->persist($picture1);

        $picture2 = new GamePicture();
        $picture2->setPicture('https://image.jeuxvideo.com/medias/159967/1599666332-7835-capture-d-ecran.jpg');
        $picture2->setGame($game2);
        $manager->persist($picture2);

        $picture3 = new GamePicture();
        $picture3->setPicture('https://image.jeuxvideo.com/medias/159967/1599666333-3976-capture-d-ecran.jpg');
        $picture3->setGame($game2);
        $manager->persist($picture3);

        $picture4 = new GamePicture();
        $picture4->setPicture('https://image.jeuxvideo.com/medias/159967/1599666333-4679-capture-d-ecran.jpg');
        $picture4->setGame($game2);
        $manager->persist($picture4);

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
        $user2->setAvatar('https://www.motortrend.com/uploads/2021/11/Classic-BMW-Motorsport-logo-M-50th-Anniversary-1.jpg');
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
        $user3->setRoles(['ROLE_REDACTEUR']);
        $user3->setPseudo('Boblp');
        $user3->setSurname('Eponge');
        $user3->setFirstname('Bob');
        $user3->setDateOfBirth(new \DateTime('1999-01-01'));
        $user3->setAccountCreationDate(new \DateTime('2020-10-09'));
        $manager->persist($user3);

        $user4 = new User();
        $user4->setEmail('redacteur.eponge@gmail.com');
        $plainPassword = '12345678';
        $encodedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);
        $user4->setPassword($encodedPassword);
        $user4->setRoles(['ROLE_REDACTEUR']);
        $user4->setPseudo('plop');
        $user4->setSurname('Eponge');
        $user4->setFirstname('redacteur');
        $user4->setDateOfBirth(new \DateTime('1999-01-01'));
        $user4->setAccountCreationDate(new \DateTime('2020-10-09'));
        $manager->persist($user4);


        $user5 = new User();
        $user5->setEmail('jean.francois@gmail.com');
        $plainPassword = '12345678';
        $encodedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);
        $user5->setPassword($encodedPassword);
        $user5->setRoles(['ROLE_USER']);
        $user5->setPseudo('jean.francois');
        $user5->setSurname('francois');
        $user5->setFirstname('jean');
        $user5->setDateOfBirth(new \DateTime('1999-01-01'));
        $user5->setAccountCreationDate(new \DateTime('2020-10-09'));
        $manager->persist($user5);

        //articles
        $article1 = new Article();
        $article1->setTitle("Dépasser les frontières du réalisme : le pari tenu par Red Dead Redemption II");
        $article1->setCover("//image.jeuxvideo.com/medias-md/167785/1677849627-5852-card.png");
        $article1->setIsValided(true);
        $article1->setPublicationDate(new \DateTime('2023-03-05T15:00:03.151Z'));
        $article1->setLastModifiedDate(new \DateTime('2023-03-05T15:00:03.151Z'));
        $article1->setWritedBy($user1);
        $article1->setValidatedBy($user2);
        $article1->setGame($game2);
        $manager->persist($article1);

        $article2 = new Article();
        $article2->setTitle('Comment devenir un pro du jeu vidéo ?');
        $article2->setCover('https://www.letudiant.fr/static/uploads/mediatheque/ETU_ETU/1/5/2644415-metier-gamer-pro-letudiant-766x438.jpg');
        $article2->setIsValided(true);
        $article2->setPublicationDate(new \DateTime('2022-12-10'));
        $article2->setLastModifiedDate(new \DateTime('2022-12-19'));
        $article2->setWritedBy($user2);
        $article2->setValidatedBy($user1);
        $manager->persist($article2);


        //section articles
        $section1 = new Section();
        $section1->setTitle("Introduction");
        $section1->setDescription("Dans ce nouvel épisode de JV Legends, nous vous emmenons dans l’un des univers de Rockstar Games avec Red Dead Redemption II. Ce jeu, qui a marqué l'industrie du jeu vidéo, a su transcender son format afin de proposer une aventure ultra-réaliste. En nous intéressant à ses coulisses, nous nous rendons vite compte qu’une obsession était au cœur de son développement : celle du détail.");
        $section1->setArticle($article1);
        $manager->persist($section1);

        //section articles
        $section2 = new Section();
        $section2->setTitle('La richesse d’un univers');
        $section2->setDescription("La qualité principale qui fait le charme de Red Dead Redemption II est sa dévotion envers la retransmission du réel. Cet aspect se décline en plusieurs points. D’un côté, il faut souligner la grande attention donnée aux PNJ. Avec un doublage mobilisant 1200 acteurs différents pour 2200 jours de tournage, ces derniers nous présentent un beau panel de ce qu’est la nature humaine. D’un autre côté, cet ultra-réalisme intervient dans le gameplay. La physique du jeu est bluffante. Chaque animation, aussi insignifiante soit-elle, est réalisée avec minutie. Contrairement à Grand Theft Auto V, le studio a mis un point d’honneur à imposer les limites du réel au joueur. Ainsi, il n’est pas possible de semer le chaos partout dans la map. Puisque les primes seront là pour vous rappeler vos méfaits. Et par la même occasion, grignoter votre porte-monnaie. Les imprévus que l’on peut expérimenter durant l’aventure renforcent la sensation de réalité. Le jeu insinue qu’il a toujours un coup d’avance sur nous. De bons points certes, mais qui peuvent frustrer. Certains gamers y voyant un manque de fun dans l’expérience de jeu, troqué pour une réalité trop oppressante. Le jeu est donc susceptible de ne pas être compris de tous. Rendre vivant un univers aussi vaste que celui de Red Dead Redemption II exige naturellement un budget colossal. Ainsi, ce n’est pas moins de 550 millions de dollars qui ont été requis pour le développement du jeu. Une somme justifiée par les 300 000 animations et les 500 000 lignes de dialogue conçues pour l'occasion. Les créateurs du jeu disent fièrement que l’équipe a pu travailler 100 heures par semaine, et ce à plusieurs reprises sur la dernière année de production. Néanmoins, notre société est de plus en plus sensible aux questions du bien-être de l'employé, et de sa quantité de travail. Alors oui, le souci du détail est valorisé. Oui, nous avons un bijou à la fin. Mais ce résultat vaut-il réellement le coup à ce prix-là ?");
        $section2->setPicture('https://image.jeuxvideo.com/medias-md/167766/1677661978-7916-capture-d-ecran.jpg');
        $section2->setArticle($article1);
        $manager->persist($section2);

        //section articles
        $section3 = new Section();
        $section3->setTitle('Une maîtrise bluffante');
        $section3->setDescription("Red Dead Redemption II a su maîtriser les aspects les plus importants. Premièrement, l’écriture. Au-delà du récit de la rédemption d’Arthur Morgan, nous sommes le témoin des derniers moments d’une bande, dont les liens entre ses membres s'estompent. Le script final compte d’ailleurs 2000 pages… rien que pour la quête principale ! Alors si nous parlons de l’intégralité du jeu, les pages de scripts atteignent environ 2 mètres 50. L’ambition du studio était si grande qu’ils ont dû couper plus de 5 heures de quêtes. Pour illustrer cette belle narration, rien de mieux qu’un environnement à couper le souffle. Entre les forêts, où les rayons du soleil se faufilent à travers les arbres, les sommets engloutis par la neige ou le décor tropical de Guarma, tout est pensé minutieusement pour faire voyager le joueur. Pour accompagner l'orchestre, des détails comme la pilosité faciale d’Arthur qui se développe à mesure de nos périples, afin de nous rendre compte du chemin parcouru entre deux passages chez le barber. Tout comme la relation que nous devons entretenir avec notre cheval, à mesure que l'on s'occupe de lui. Vous l'aurez deviné, l'expression \"le diable se trouve dans les détails\" convient parfaitement à Red Dead Redemption II. Chacun d'eux contribuent à un ensemble, où le moindre élément permet de mettre en valeur le suivant. Dans tous les aspects, Rockstar a su montrer sa grande expertise.");
        $section3->setArticle($article1);
        $manager->persist($section3);

        /*-------------------------------------------------------*/

        //articles
        $article2 = new Article();
        $article2->setTitle('Dragon Ball Budokai Tenkaichi : surprise, la mythique franchise fait son grand retour ! Premières images');
        $article2->setCover('//image.jeuxvideo.com/medias-md/167808/1678082642-6292-card.png');
        $article2->setIsValided(true);
        $article2->setPublicationDate(new \DateTime('2023-03-06T06:08:45.437Z'));
        $article2->setLastModifiedDate(new \DateTime('2023-03-06T06:08:45.437Z'));
        $article2->setWritedBy($user1);
        $article2->setValidatedBy($user2);
        $manager->persist($article2);

        //section articles
        $section4 = new Section();
        $section4->setTitle('Dragon Ball Budokai Tenkaichi : surprise, la mythique franchise fait son grand retour ! Premières images');
        $section4->setDescription("Durant les années 2000, les fans de Dragon Ball se regroupaient souvent autour d'une licence de jeux de combat en 3D, la désormais mythique franchise des Budokai Tenkaichi. Mais depuis 2007, la licence n'avait connu aucun nouvel épisode dit principal. Ceci est sur le point de changer.");
        $section4->setArticle($article2);
        $manager->persist($section4);

        //section articles
        $section5 = new Section();
        $section5->setTitle('Dragon Ball Z Budokai Tenkaichi : 16 ans déjà');
        $section5->setDescription("En 2005, Bandai renouvellait fortement l'intérêt des joueurs pour la licence Dragon Ball Z en publiant Dragon Ball Z : Budokai Tenkaichi sur PS2, qui faisait plus ou moins suite à la franchise Budokai. Le succès est important et, dès 2006, un second opus voit le jour, lui-même suivi d'un troisième épisode en 2007 sur PS2 et Wii. Des dizaines de personnages pouvaient alors être incarnés, accompagnés des nombreuses transformations issues des divers arcs. Et depuis ? Eh bien, rien. La franchise Budokai \"tout court\" s'est poursuivie sur PSP, et il a fallu attendre 2015 pour retrouver Dragon Ball dans un jeu de combat avec Dragon Ball Xenoverse. L'approche était un peu différente puisqu'il s'agissait de créer son personnage, et d'aller sauver l'espace-temps. Ces dernières années, les jeux de combats Dragon Ball étaient représentés de fort belle manière par Dragon Ball FighterZ, qui misait sur la 2D et sur des animations de haute volée conçues par Arc System Works, et par Dragon Ball Xenoverse 2, héritier spirituel des Budokai.");
        $section5->setArticle($article2);
        $manager->persist($section5);

        //section articles
        $section6 = new Section();
        $section6->setTitle('Budokai Tenkaichi est de retour !');
        $section6->setDescription("Mais nombreux étaient les joueurs à demander le retour de Budokai Tenkaichi, et il semblerait que Bandai Namco ait entendu cette demande. Sans prévenir personne, l'éditeur vient tout simplement d'annoncer celui qu'on appellera pour le moment Dragon Ball Budokai Tenkaichi 4 ! Bandai Namco a en effet profité de son événement Dragon Ball Games Battle Hour, dédié aux jeux de la licence, pour dévoiler le premier teaser du nouveau jeu de combat estampillé Dragon Ball. On y voir des images du premier jeu, diffusés sur une vieille télévision cathodique, et sur lesquelles on voit Son Goku concentrer son ki pour se transformer. Quelques secondes plus tard, cette transformation prend tout l'écran, et semble beaucoup plus moderne puisqu'affichée en HD. Un remaster est-il en approche ? Non ! On aperçoit encore le personnage mythique se concentrer mais cette fois, il se transforme en Super Saiyajin God Super Saiyajin, et arbore sa chevelure bleue découverte dans Super. Si les fans doutaient encore, Bandai Namco met fin à tout suspense en fin de vidéo, indiquant à l'écran qu'un nouveau Budokai Tenkaichi commence. Le titre officiel de ce nouvel opus n'a pas été officiellement dévoilé, mais le teaser insiste sur le nom de Sparking, qui était l'intitulé officiel de la licence en japonais. De la même manière, nous ne pouvons pas vous communiquer de date de sortie, puisque rien n'a été annoncé. On peut cependant décemment l'attendre pour la fin de l'année ou pour 2024.");
        $section6->setPicture('https://image.jeuxvideo.com/medias-md/167808/1678082696-672-capture-d-ecran.png');
        $section6->setArticle($article2);
        $manager->persist($section6);

        /*-------------------------------------------------------*/

        //articles
        $article3 = new Article();
        $article3->setTitle('Un pilote de F1 compare la Red Bull championne du monde à… Call of Duty');
        $article3->setCover('//image.jeuxvideo.com/medias-md/167809/1678089811-8336-card.png');
        $article3->setIsValided(true);
        $article3->setPublicationDate(new \DateTime('2023-03-06T08:17:26.528Z'));
        $article3->setLastModifiedDate(new \DateTime('2023-03-06T08:17:26.528Z'));
        $article3->setWritedBy($user1);
        $article3->setValidatedBy($user2);
        $manager->persist($article3);

        //section articles
        $section7 = new Section();
        $section7->setTitle('Introduction');
        $section7->setDescription("Ça y est, la Formule 1 a lancé sa saison 2023 ce week-end du côté de Sakir pour le Grand Prix de Barheïn. En parallèle, EA a déjà commencé à teaser son F1 2023, mais c'est pluôt Call of Duty qui nous intéresse aujourd'hui. Signe le que jeu vidéo est désormais partout, la monoplace du champion du monde Max Verstappen a récemment été comparée au FPS d'Activision.");
        $section7->setArticle($article3);
        $manager->persist($section7);

        //section articles
        $section8 = new Section();
        $section8->setTitle('La F1 et le jeu vidéo, deux mondes pas si éloignés que ça');
        $section8->setDescription("On l'a vu durant la pandémie, les pilotes de Formule 1 ne sont pas les derniers lorsqu'il s'agit de jouer. Alors évidemment, cela est majoritairement passé par des courses virtuelles, avec Charles Leclerc et Lando Norris en tête de file. Les pilotes de la catégorie reine sont donc sur Twitch, et il est plus que probable qu'ils soient nombreux à lancer F1 22, FIFA ou Call of Duty sur leur temps libre. Et cela, c'est sans compter les nombreux pilotes virtuels qui s'affrontent sur Gran Turismo 7, Assetto Corsa et iRacing, ou encore ceux qui cherchent à mener leur écurie au sommet dans F1 Manager 2022. Le jeu vidéo ayant depuis longtemps franchi la frontière de l'activité de niche, il peut être cité pour faire des comparaisons ou simplement en tant que objet culturel, les grosses licences parlant à beaucoup de monde. On en a très récemment eu la preuve durant le premier week-end de course de la saison. Après les essais hivernaux, les pilotes se sont enfin retrouvés pour préparer le premier Grand Prix. Comme d'habitude, on a retrouvé les essais libres, les qualifications et la course, mais cette première échéance permettait aussi de savoir où en étaient concrètement les écuries.");
        $section8->setPicture('https://image.jeuxvideo.com/medias/165159/1651593123-3622-capture-d-ecran.jpg');
        $section8->setArticle($article3);
        $manager->persist($section8);

        //section articles
        $section9 = new Section();
        $section9->setTitle("Piloter la Red Bull, c'est comme jouer à Call of Duty");
        $section9->setDescription("L'an dernier, Red Bull a largement dominé la saison, suivi par Ferrari, Mercedes et Alpine. On se demandait donc comment se comportait la voiture championne du monde vis-à-vis des autres monoplaces de la grille. La réponse nous est venue d'Alexander Albon, ancien coéquipier de Max Verstappen chez Red Bull et désormais chez Williams aux côtés de Logan Sargeant. Interrogé sur son ancien coéquipier et sa monoplace, le pilote thaïlandais n'a pas hésité à utiliser Call of Duty pour faire une comparaison !");
        $section9->setPicture('https://pbs.twimg.com/media/FqNUEaXWcAArDjW?format=jpg&name=small');
        $section9->setArticle($article3);
        $manager->persist($section9);

        $section10 = new Section();
        $section10->setTitle("Conclusion");
        $section10->setDescription("Autrement dit, le train avant de la Red Bull championne du monde serait aussi sensible que la visée d'un joueur de Call of Duty qui mettrait la sensibilité au maximum. Cela peut faire peur tant ces monoplaces sont rapides et demandent un temps de réaction extrêmement court, mais cela semble totalement convenir à celui qui, dès ce week-end, a fait comprendre qu'il était là pour conquérir un troisième titre mondial. La domination a d'ailleurs été globale chez Red Bull puisque les deux voitures ont fini aux deux premières places. Si la comparaison avec Call of Duty peut faire sourire, elle a globalement très bien été reçue sur les réseaux sociaux, avec de nombreux commentaires indiquant qu'elle était très parlante. On rappelle que depuis quelques années, la F1 a largement regagné en popularité, notamment grâce à l'arrivée de la série Drive to Survive sur Netflix, et aux divers changements opérés pour rendre la compétition plus acharnée.");
        $section10->setArticle($article3);
        $manager->persist($section10);

        /*-------------------------------------------------------*/

        //articles
        $article4 = new Article();
        $article4->setTitle('Fortnite va bientôt faire du Call of Duty, une vraie révolution ?');
        $article4->setCover('//image.jeuxvideo.com/medias-md/167810/1678098676-9458-card.jpg');
        $article4->setIsValided(true);
        $article4->setPublicationDate(new \DateTime('2023-03-06T10:35:34.481Z'));
        $article4->setLastModifiedDate(new \DateTime('2023-03-06T10:35:34.481Z'));
        $article4->setWritedBy($user1);
        $article4->setValidatedBy($user2);
        $manager->persist($article4);

        //section articles
        $section11 = new Section();
        $section11->setTitle('Introduction');
        $section11->setDescription("Fortnite évolue constamment, et pourrait très bientôt franchir un cap attendu par une partie des joueurs depuis bien longtemps. Après avoir ajouté un mode sans construction, le battle royale pourrait aller lorgner du côté de la concurrence !");
        $section11->setArticle($article4);
        $manager->persist($section11);

        //section articles
        $section12 = new Section();
        $section12->setTitle('Fortnite à la sauce FPS, ce serait pour très bientôt !');
        $section12->setDescription("La première saison du chapitre 4 de Fortnite arrivera bientôt à son terme, et les dataminers et autres insiders commencent à relayer quelques rumeurs sur les potentiels changements à venir dans le cadre de la saison 2. Et parmi les rumeurs les plus importantes, on en trouve une qui a été relayée par HYPEX, ShiinaBR et Tom Henderson. Autant dire qu'au regard des sources, tout cela est très solide, et qu'on attend désormais une annonce en bonne et due forme au sujet de l'arrivée de la vue à la première personne ! Car oui, c'est bien de cela dont on parle. Au cours de la saison 2 du Chapitre 4, la vue FPS devrait accompagner des collaborations avec l'Attaque des Titans et Resident Evil 4 Remake. La fin de la saison 1 étant prévue pour le 8 mars, on devrait assister au début de la saison 2 dès le vendredi 9 mars ou le samedi 10.");
        $section12->setPicture('https://image.jeuxvideo.com/medias-sm/167775/1677754825-9482-capture-d-ecran.jpg');
        $section12->setArticle($article4);
        $manager->persist($section12);

        //section articles
        $section13 = new Section();
        $section13->setTitle('Aller chercher Warzone et Apex Legends sur leur propre terrain');
        $section13->setDescription("D'après les diverses sources, il s'agirait d'un paramètre optionnel que les joueurs pourront activer et désactiver à volonté. On ne devrait donc pas découvrir un mode de jeu spécifique, mais plutôt une nouvelle façon de jouer au Battle Royale d'Epic Games.");
        $section13->setPicture('https://image.jeuxvideo.com/medias-sm/167775/1677754825-9695-capture-d-ecran.jpg');
        $section13->setArticle($article4);
        $manager->persist($section13);

        /*-------------------------------------------------------*/

        //articles
        $article5 = new Article();
        $article5->setTitle("Star Wars Jedi Survivor : \"j'ai toujours voulu voir ça comme une trilogie\" déclare le réalisateur");
        $article5->setCover('//image.jeuxvideo.com/medias-md/167810/1678096873-9625-card.png');
        $article5->setIsValided(true);
        $article5->setPublicationDate(new \DateTime('2023-03-06T10:58:14.645Z'));
        $article5->setLastModifiedDate(new \DateTime('2023-03-06T10:58:14.645Z'));
        $article5->setWritedBy($user1);
        $article5->setValidatedBy($user2);
        $manager->persist($article5);

        //section articles
        $section14 = new Section();
        $section14->setTitle('Introduction');
        $section14->setDescription("Entre Hogwarts Legacy et Tears of the Kingdom, on a presque tendance à oublier qu'un autre très gros action-RPG solo basé sur une licence culte arrive prochainement. Prévu pour le 28 avril prochain, Star Wars Jedi : Survivor commence cependant à faire parler de lui, et il pourrait incarner le deuxième épisode d'une trilogie qui s'annonce très intéressante. On l'oublierait presque, mais le pourtant très attendu Star Wars Jedi : Survivor arrive dans un peu moins de deux mois sur PC et consoles exclusivement next-gen (PlayStation 5 et Xbox Series) ! Cet action-RPG se déroulant dans l'univers fascinant imaginé par George Lucas fera suite au très encourageant Star Wars Jedi : Fallen Order, paru en 2019 et dont les nombreuses promesses donnaient très envie de voir son potentiel exploité à fond dans une éventuelle suite. Sans grande surprise, Electronic Arts avait annoncé cette dernière, qui plus est pour la nouvelle génération de machines, et il se pourrait que ce ne soit que la deuxième étape d'une trilogie…");
        $section14->setArticle($article5);
        $manager->persist($section14);

        //section articles
        $section15 = new Section();
        $section15->setTitle("Star Wars Jedi, la nouvelle pépite solo d'EA");
        $section15->setDescription("Lors de sa sortie en novembre 2019, Star Wars Jedi : Fallen Order avait surpris son monde. Crédité d'un très bon 16/20 dans nos colonnes, il avait su créer la surprise après des premiers aperçus modérément enthousiastes à l'E3 quelques mois plus tôt, en s'imposant comme le véritable renouveau de la licence Star Wars dans le paysage vidéoludique, près de 10 ans après son dernier jeu solo. L'épopée de Cal Kestis avait en effet séduit les joueurs et la presse, agréablement surpris par ce jeu d'action-aventure aux éléments de progression connotés RPG et aux inspirations contemporaines multiples, de Tomb Raider à Dark Souls en passant par Uncharted. Après plusieurs jeux essentiellement multijoueur au bilan mitigé, Star Wars était de retour en force.");
        $section15->setPicture('https://image.jeuxvideo.com/medias-sm/157381/1573812861-379-capture-d-ecran.jpg');
        $section15->setArticle($article5);
        $manager->persist($section15);

        //section articles
        $section16 = new Section();
        $section16->setTitle("Une suite plus qu'évidente sur les rails…");
        $section16->setDescription("Par chance, le renouveau de la licence confié à Respawn Entertainment fut couronné de succès, au point de mieux se vendre que prévu, prouvant que le solo avait clairement un avenir chez EA, éditeur pourtant très frileux sur les titres dépourvu de toute forme de multi. Néanmoins, Star Wars Jedi : Fallen Order n'était pas exempt de défauts, et c'est une des raisons pour lesquelles une suite était vivement espérée par les fans, conquis par cette expérience franchement réussie mais dont le potentiel n'attendait que d'être bien mieux exploité. En annonçant Star Wars Jedi : Survivor sur consoles next-gen uniquement (en plus de la version PC), l'éditeur confirmait sa volonté de transformer l'essai, et en dépit de son léger report (du 17 mars au 28 avril), il y a vraiment de quoi être enthousiaste à l'approche de la sortie de cette suite.");
        $section16->setPicture('https://image.jeuxvideo.com/medias-sm/158937/1589372708-9046-capture-d-ecran.jpg');
        $section16->setArticle($article5);
        $manager->persist($section16);

        //section articles
        $section17 = new Section();
        $section17->setTitle("… voire peut-être un troisième épisode ?");
        $section17->setDescription("Nos confrères d'IGN ont récemment eu la possibilité d'essayer pour la première fois Star Wars Jedi : Survivor, mais aussi de s'entretenir avec Stig Asmussen, réalisateur du jeu chez Respawn. À en croire la tête pensante du projet, ce deuxième épisode ne conclura en rien l'arc narratif autour de Cal Kestis, puisque Star Wars Jedi semble pensé comme une trilogie. La sortie d'un troisième épisode est ainsi plus que probable si \"Survivor\" fonctionne au moins auss bien que \"Fallen Order\", ce qui est non seulement cohérent, mais pas vraiment surprenant lorsque l'on apprend que Respawn envisageait déjà une suite à Star Wars Jedi : Fallen Order avant même que ce dernier ne soit publié :");
        $section17->setArticle($article5);
        $manager->persist($section17);

        /*-------------------------------------------------------*/

        //articles
        $article6 = new Article();
        $article6->setTitle("C'est flippant ! 14 minutes de gameplay pour Dead Island 2");
        $article6->setCover('//image.jeuxvideo.com/medias-md/167818/1678175189-9824-card.png');
        $article6->setIsValided(true);
        $article6->setPublicationDate(new \DateTime('2023-03-07T07:55:17.823Z'));
        $article6->setLastModifiedDate(new \DateTime('2023-03-07T07:55:17.823Z'));
        $article6->setWritedBy($user1);
        $article6->setValidatedBy($user2);
        $manager->persist($article6);

        //section articles
        $section18 = new Section();
        $section18->setTitle('Introduction');
        $section18->setDescription("Dead Island 2 sortira dans quelques semaines, et vient pour l'occasion de dévoiler un quart d'heure de gameplay ! Deep Silver dévoile quatorze minutes de gameplay issues du jeu Dead Island 2 à venir prochainement. Découvrez les fonctionnalités principales du titre, où il s'agit de faire de la charpie de morts-vivants.");
        $section18->setArticle($article6);
        $manager->persist($section18);

        //section articles
        $section19 = new Section();
        $section19->setTitle('Découvrez le gameplay de Dani dans Dead Island 2');
        $section19->setDescription("Dead Island 2 vous demandera très tôt de choisir un personnage, parmi les six disponibles. Chaque personnage aura droit à un gameplay dédié, certains plutôt bourrins, d'autres plutôt agiles et rapides. Le choix du personnage influera sur votre progression : vous ne pourrez pas débloquer les mêmes compétences et les mêmes cartes de compétences en gagnant des niveaux, selon le personnage choisi. Dans cette vidéo de gameplay, on découvre ainsi le personnage Dani, assez agile au combat.");
        $section19->setPicture('https://image.jeuxvideo.com/medias-md/166081/1660809880-4689-capture-d-ecran.jpg');
        $section19->setArticle($article6);
        $manager->persist($section19);

        //section articles
        $section20 = new Section();
        $section20->setTitle('Les cartes de compétences pour des personnages complémentaires');
        $section20->setDescription("Le système de classes du jeu montre bien que Dead Island 2 est pensé pour le multijoueur en coopération, avec des classes complémentaires. D'ailleurs, les cartes de compétences rappellent d'autres jeux en coop qui utilisent des systèmes similaires, comme Back 4 Blood. Ces cartes, dans Dead Island 2, vous permettront de modifier votre personnage pour lui ajouter des statistiques, des fonctionnalités, et améliorer ses caractéristiques dans certaines domaines. Certaines cartes sont dédiées à un seul personnage, d'autres à plusieurs d'entre eux. Dans tous les cas, il faudra les débloquer au fur et à mesure de votre progression en gagnant des niveaux, en accomplissant des quêtes, et en explorant.");
        $section20->setPicture('https://image.jeuxvideo.com/medias-md/166437/1664369918-9731-capture-d-ecran.jpg');
        $section20->setArticle($article6);
        $manager->persist($section20);

        //section articles
        $section21 = new Section();
        $section21->setTitle('Crafter et améliorer ses armes');
        $section21->setDescription("Comme dans les épisodes précédents, Dead Island 2 mettra en avant les armes et leur personnalisation. Une grande variété d'armes est promise, principalement au corps-à-corps. En explorant, vous découvrirez des plans pour crafter de nouvelles armes ou modifier celles que vous avez déjà. Ainsi, vous pourrez ajouter des \"pouvoirs\" à vos armes, comme de l'électricité, du feu, etc ... On peut voir dans la vidéo que le joueur ajoute du feu à son katana, puis un effet de zone qui enflammera les ennemis à proximité lorsqu'il enflammera un zombie. Les armes à distance existent également dans le jeu, puisque la vidéo nous montre Dani utilisant des pistolets et un fusil.");
        $section21->setPicture('https://image.jeuxvideo.com/medias-md/166437/1664369599-7156-artwork.jpg');
        $section21->setArticle($article6);
        $manager->persist($section21);

        /*-----------------------*/

        //articles
        $article7 = new Article();
        $article7->setTitle("Il y a 20 ans, Metal Gear Solid 2 sortait sur Xbox. Le début d’une histoire en pointillé entre Konami, Kojima et Microsoft");
        $article7->setCover('//image.jeuxvideo.com/medias-md/167786/1677863576-6787-card.gif');
        $article7->setIsValided(true);
        $article7->setPublicationDate(new \DateTime('2023-03-07T06:30:02.780Z'));
        $article7->setLastModifiedDate(new \DateTime('2023-03-07T06:30:02.780Z'));
        $article7->setWritedBy($user1);
        $article7->setValidatedBy($user2);
        $manager->persist($article7);

        //section articles
        $section22 = new Section();
        $section22->setTitle('Introduction');
        $section22->setDescription("Il y a 20 ans en Europe, Konami décidait de sortir sur la toute première console de Microsoft son jeu d’infiltration star, Metal Gear Solid, par l’intermédiaire de l’édition “Substance” du deuxième volet. Les joueurs Xbox, qui n’avaient d’yeux que pour Sam Fisher (Splinter Cell) à cette époque, ont alors pu découvrir toutes les forces du titre d’Hideo Kojima. Cette première incursion de Solid Snake sur la machine américaine fut le point de départ d’une histoire avec des hauts et des bas entre le célèbre créateur et la firme de Redmond.");
        $section22->setArticle($article7);
        $manager->persist($section22);

        //section articles
        $section23 = new Section();
        $section23->setTitle('2003 : Solid Snake tente le X');
        $section23->setDescription("C’est le 7 mars 2003 que l’édition spéciale de Metal Gear Solid 2 : Sons of Liberty, sous-titrée Substance, débarqua sur la toute première console de jeux de Microsoft en Europe. Alors que la machine n’avait pas encore soufflé sa première bougie chez nous, Konami – et plus précisément son directeur exécutif Kazumi Kitaue – respectait la promesse faite au géant américain pendant le développement de sa machine, celle d’accompagner le succès de la Xbox avec ses productions. Après l’édition Inner Fears de Silent Hill 2 qui contenait un scénario bonus, le groupe japonais livra sa version gonflée à bloc de MGS 2, l’autre franchise forte de Konami. Outre la possibilité de refaire le jeu en choisissant son personnage, MGS 2 : Substance proposait plus de 500 missions annexes afin de pousser le joueur à dompter toutes les mécaniques du système de jeu, grâce à 300 VR missions et 200 missions alternatives (dans les environnements du tanker et de Big Shell). Le titre contenait également les “Snake Tales” avec ses cinq histoires s’inspirant de diverses situations du jeu original. Le mini-jeu de skateboard était quant à lui réservé à la version PlayStation 2 du titre, quand bien même il aurait été montré dans les bandes-annonces Xbox de l’époque.");
        $section23->setPicture('https://image.jeuxvideo.com/images-sm/pc/m/g/mgsspc005.jpg');
        $section23->setArticle($article7);
        $manager->persist($section23);

        //section articles
        $section24 = new Section();
        $section24->setTitle('En pointillé');
        $section24->setDescription("Quand le nom d’Hideo Kojima est cité, le commun des mortels pense immédiatement à l’univers de la PlayStation. Quoi de plus normal ? Après tout, Metal Gear Solid fut un carton sur la PSOne, et le troisième comme le quatrième volet furent des exclusivités PlayStation 2/3. Avec la Xbox 360, Konami continua de soutenir à sa façon la marque américaine. La société japonaise opta pour une arrivée des Castlevania : Lords of Shadow simultanément sur PlayStation 3 et Xbox 360, tandis que des compilations de MGS, Zone of the Enders et Silent Hill furent proposées afin que les joueurs Xbox puissent enfin se frotter à ZoE, MGS 3, MGS Peace Walker et Silent Hill 3. C’est lors de la conférence E3 Xbox de 2009 que les liens entre Kojima et Microsoft semblèrent se resserrer. Le célèbre créateur donna en effet de sa personne en jouant un petit sketch avec Don Mattrick, l’ancien patron de la marque américaine, pour révéler Metal Gear Rising : Revengeance. Cette présentation avait fait l'effet d'une petite bombe sur la Toile.");
        $section24->setPicture('https://image.jeuxvideo.com/images-sm/x3/c/a/castlevania-lords-of-shadow-collection-xbox-360-1377113728-054.jpg');
        $section24->setArticle($article7);
        $manager->persist($section24);

        //section articles
        $section24 = new Section();
        $section24->setTitle('Suite');
        $section24->setDescription("Il revint lors de la conférence de 2013 pour présenter Metal Gear Solid V : The Phantom Pain. Malheureusement, lors de la sortie du jeu sur Xbox One et PlayStation 4, Digital Foundry démontra que la superior version n’était autre que la version PS4, ce qui raviva la guerre des consoles à un moment où Microsoft était déjà en difficulté. Bien que le célèbre créateur figurait sur la vidéo d’annonce de la Xbox One aux côtés de Spielberg, ses jeux sortaient surtout chez la concurrence. À la gamescom 2014, Konami révéla le futur projet d’Hideo Kojima, un nouvel épisode de Silent Hill, via un teaser jouable qui fit sensation avec P.T. Cette démo était exclusive à la console de Sony tandis que le projet Silent Hills n’était annoncé que sur PlayStation 4. Quand Hideo Kojima quitta Konami en 2015 et fonda Kojima Productions, c’est une fois de plus vers la firme de Tokyo qu’il se tourna pour développer Death Stranding. Alors que les joueurs Xbox n’attendaient plus rien du papa de Metal Gear Solid, Microsoft annonça pendant son Showcase de 2022 le développement d’un projet exclusif à l’écosystème Xbox avec Kojima Productions. Un titre dont on ne sait officiellement pas grand-chose, si ce n’est qu’il est décrit comme “fou” par son créateur.");
        $section24->setPicture('https://image.jeuxvideo.com/medias-sm/165462/1654623779-6127-capture-d-ecran.jpg');
        $section24->setArticle($article7);
        $manager->persist($section24);

        //section articles
        $section25 = new Section();
        $section25->setTitle('Pour en conclure');
        $section25->setDescription("Après toutes ces années faites de rendez-vous manqués, Xbox et Kojima s’unissent enfin autour d’un projet commun dont nous espérons avoir bientôt des nouvelles. Est-ce le début d’une véritable relation de confiance entre le créateur japonais et le constructeur américain ? Cela semble en prendre le chemin.");
        $section25->setArticle($article7);
        $manager->persist($section25);

        /*-----------------------*/

        //articles
        $article8 = new Article();
        $article8->setTitle("Zelda Breath of the Wild : énorme performance de ce joueur qui termine le jeu à 100% à l’aveugle");
        $article8->setCover('//image.jeuxvideo.com/medias-md/167827/1678274000-8730-card.png');
        $article8->setIsValided(true);
        $article8->setPublicationDate(new \DateTime('2023-03-08T13:32:31.542Z'));
        $article8->setLastModifiedDate(new \DateTime('2023-03-08T13:32:31.542Z'));
        $article8->setWritedBy($user1);
        $article8->setValidatedBy($user2);
        $manager->persist($article8);

        //section articles
        $section22 = new Section();
        $section22->setTitle('Introduction');
        $section22->setDescription("Alors que la sortie de Tears of the Kingdom approche à grands pas, certains joueurs continuent d'exploiter Breath of the Wild dans ses moindres recoins. Et puisque tout le monde n'a pas forcément envie de le faire en speedrun, d'autres ont des idées un peu plus originales pour le terminer de manière quelque peu improbable, en rajoutant un soupçon de défi pour rendre le challenge intéressant…Alors que la sortie de Tears of the Kingdom approche à grands pas, certains joueurs continuent d'exploiter Breath of the Wild dans ses moindres recoins. Et puisque tout le monde n'a pas forcément envie de le faire en speedrun, d'autres ont des idées un peu plus originales pour le terminer de manière quelque peu improbable, en rajoutant un soupçon de défi pour rendre le challenge intéressant… Alors qu'il a fêté son sixième anniversaire la semaine dernière, The Legend of Zelda : Breath of the Wild est toujours aussi populaire chez les joueurs du monde entier. Certes, ces derniers attendent fébrilement sa suite, The Legend of Zelda : Tears of the Kingdom, à paraître le 12 mai prochain, mais ils s'ocupent toujours aussi bien sur le titre testament de la Wii U, qui a lancé conjointement la Nintendo Switch le 3 mars 2017 et entamé une nouvelle ère de succès du côté de chez Nintendo. À défaut de speedrunner le jeu, certains joueurs à l'imagination fertile trouvent de nouvelles façons originales de terminer ce chef-d'œuvre ayant changé la face du jeu vidéo avec sa vision révolutionnaire du monde ouvert…");
        $section22->setPicture('https://image.jeuxvideo.com/medias-md/161467/1614670273-863-capture-d-ecran.jpg');
        $section22->setArticle($article8);
        $manager->persist($section22);

        //section articles
        $section23 = new Section();
        $section23->setTitle('Mille et une façons de terminer Breath of the Wild');
        $section23->setDescription("En tant qu'héritier assumé de The Legend of Zelda, premier titre de la franchise sorti en 1986 sur NES dont il est une sorte de reboot spirituel, Breath of the Wild est un épisode plus ouvert que jamais, en tout cas davantage que la mythique licence de Nintendo ne l'a jamais été. De par sa dimension open world quasiment sans limites, il offrait ainsi aux joueurs du monde entier une quantité infinie de possibilités de le terminer, et pas forcément sous l'angle du speedrun. Certes, la scène concernée est très active, et celui qui fut élu jeu de l'année en 2017 peut se finir désormais en moins de 25 minutes (!), comme l'imaginait son producteur visionnaire Eiji Aonuma dès 2016. Toutefois, achever aussi vite la quête principale de Breath of the Wild requiert énormément de skill et n'est pas à la portée de tout le monde ; heureusement, les joueurs rivalisent d'ingéniosité pour trouver d'autres challenges et marquer l'histoire du jeu à leur manière.");
        $section23->setPicture('https://image.jeuxvideo.com/medias-sm/146609/1466090734-9982-capture-d-ecran.jpg');
        $section23->setArticle($article8);
        $manager->persist($section23);

        //section articles
        $section24 = new Section();
        $section24->setTitle('Un open world pas comme les autres');
        $section24->setDescription("Lorsqu'il fut présenté lors de l'E3 2016, The Legend of Zelda : Breath of the Wild avait divisé les joueurs ainsi que la presse, certains s'inquiétant (en plus d'un niveau de réalisation pas spécialement \"moderne\") d'une nouvelle formule plus ouverte assez peu inspirée, singeant notamment le système de tours de synchronisation cher à Ubisoft et à la série des Assassin's Creed, que ce nouveau Zelda semblait reprendre à sa manière avec les désormais célèbres Tours Sheikah. Néanmoins, à la différence de nombreux open worlds contemporains, Breath of the Wild a tendance à accorder une immense liberté de progression au joueur, ne lui donnant plus ou moins aucune consigne une fois sorti du fameux Plateau du Prélude. De quoi stimuler l'imagination et la créativité des explorateurs en herbe, à qui un des plus grands bacs à sable de l'histoire est ainsi offert sur un plateau – ou plutôt, à ses pieds.");
        $section24->setPicture('https://image.jeuxvideo.com/medias-md/167828/1678276751-2682-artwork.png');
        $section24->setArticle($article8);
        $manager->persist($section24);

        //section articles
        $section25 = new Section();
        $section25->setTitle('La carte, cet élément si futile…');
        $section25->setDescription("Dans un jeu en monde ouvert, vous en conviendrez, l'utilisation de la carte est prépondérante, que vous disposiez d'un bon sens de l'orientation ou non. Breath of the Wild ne déroge pas à la règle, et les fameuses tours Sheikah ont pour but de révéler la carte de la région qu'elles dominent pour faciliter la progression. Mais à aucun moment, le titre de Nintendo n'impose son utilisation, et n'oblige aucunement les joueurs à activer les terminaux en haut de chacune des tours avec la tablette Sheikah pour débloquer la carte de la région concernée. Cette illustration supplémentaire de la liberté quasi infinie dont jouissent les joueurs de Breath of the Wild a inspiré un certain LusciousRonaldo, utilisateur de Reddit s'étant lancé le défi de finir le jeu sans jamais débloquer la moindre \"map\". Après tout, pourquoi utiliser une carte quand on peut faire sans ?");
        $section25->setPicture('https://image.jeuxvideo.com/medias-md/167828/1678281068-9654-artwork.jpg');
        $section25->setArticle($article8);
        $manager->persist($section25);

        //section articles
        $section26 = new Section();
        $section26->setTitle('Finir Breath of the Wild sans carte, un bel exploit !');
        $section26->setDescription("Là où l'exploit de ce joueur est particulièrement intéressant, c'est qu'il ne s'agit pas d'un speedrun classique où il \"suffit\" de foncer jusqu'au château d'Hyrule directement après avoir obtenu la paravoile pour finir le jeu très rapidement. L'objectif de LusciousRonaldo était de compléter l'intégralité des missions de Breath of the Wild, sanctuaires compris, sans jamais déverrouiller une seule carte en-dehors de celle, obligatoire pour progresser, du plateau du Prélude (mais elle ne révèle qu'une portion ridicule du monde ouvert du jeu). L'idée était de faire apparaître l'intégralité des points d'intérêt sur le module \"'carte\" de la tablette Sheikah, mais sans jamais utiliser celle-ci pour débloquer les cartes des régions, ce qui constitue un joli défi requérant une grosse connaissance du jeu. Cette performance complexe, ce joueur méthodique n'a pu l'accomplir, selon lui, qu'après avoir déjà terminé \"normalement\" le jeu d'origine \"7 ou 8 fois\" avant de se lancer dans ce défi. Son but était de revivre \"le sentiment d'isolement et de découverte\" expérimenté lors de sa toute première partie, que seule une exploration non assistée par la carte pouvait satisfaire. Non seulement LusciousRonaldo est parvenu à ses fins, mais l'a prouvé avec deux captures d'écran, où tous les points d'intérêt (sanctuaires, villages, relais, créatures…) sont débloqués, mais où aucune carte ne l'est. En bonus, il a joint également celle affichant l'historique de ses déplacements sur la carte pour montrer le cheminement utilisé :");
        $section26->setPicture('https://image.jeuxvideo.com/medias-md/167828/1678281068-4036-artwork.jpg');
        $section26->setArticle($article8);
        $manager->persist($section26);

        /*-----------------------*/

        //articles
        $article9 = new Article();
        $article9->setTitle("Énervés, ces développeurs affichent et insultent les tricheurs de leur jeu");
        $article9->setCover('//image.jeuxvideo.com/medias-md/167828/1678278729-2485-card.jpg');
        $article9->setIsValided(true);
        $article9->setPublicationDate(new \DateTime('2023-03-08T13:21:20.702Z'));
        $article9->setLastModifiedDate(new \DateTime('2023-03-08T13:21:20.702Z'));
        $article9->setWritedBy($user1);
        $article9->setValidatedBy($user2);
        $manager->persist($article9);

        //section articles
        $section27 = new Section();
        $section27->setTitle('Introduction');
        $section27->setDescription("Depuis de nombreuses années, la triche est un véritable fléau qui gâche l'expérience proposée par les jeux multijoueurs en ligne. Pour combattre ce problème, les développeurs consacrent une partie de leur temps à créer des outils anti-cheat efficaces. D'autres préfèrent directement afficher et insulter leurs tricheurs pour qu'ils servent d'exemples.");
        $section27->setArticle($article9);
        $manager->persist($section27);

        //section articles
        $section28 = new Section();
        $section28->setTitle('La triche, fléau moderne du jeu en ligne ?');
        $section28->setDescription("Si vous êtes habitué à jouer à des expériences en ligne, vous avez sûrement croisé de nombreux tricheurs tout au long de votre vie de joueur. S'il s'agit d'une pratique qui existe depuis toujours, cette dernière semble avoir pris des proportions considérables récemment à en croire les plaintes des différentes communautés. C'est particulièrement le cas dans le monde du Battle Royale, avec des titres comme Call of Duty : Warzone 2.0 dans lesquels les développeurs essaient de lutter autant qu'ils peuvent en déployant des outils pour contrer les cheaters.");
        $section28->setPicture('https://image.jeuxvideo.com/medias-sm/167637/1676365979-5324-capture-d-ecran.jpg');
        $section28->setArticle($article9);
        $manager->persist($section28);

        //section articles
        $section29 = new Section();
        $section29->setTitle('Valorant');
        $section29->setDescription("Certains éditeurs ont eu recours à des solutions radicales comme Riot Games qui, avec la sortie de Valorant, a créé un anti-cheat puissant mais très gourmand en ressources et qui tourne en permanence appelé Vanguard. Pas de quoi satisfaire les joueurs non plus. Au-delà de ces outils, d'autres développeurs n'hésitent pas à être plus directs dans leur façon de contrer ce problème, à l'image des équipes de Escape From Tarkov.");
        $section29->setPicture('https://image.jeuxvideo.com/medias-sm/159120/1591199877-6806-capture-d-ecran.jpg');
        $section29->setArticle($article9);
        $manager->persist($section29);

        //section articles
        $section30 = new Section();
        $section30->setTitle("Un coup marketing plutôt qu'une vraie solution aux problèmes ?");
        $section30->setDescription("Dans un post Reddit, Nikita Buyanov, Chief Operating Offcier et chef du studio Battlestate Games qui développe Escape from Tarkov, a annoncé que les développeurs avaient banni des milliers de tricheurs qu'ils traitent de \"bâtards\" et de \"rebuts de l'humanité\". Sur Twitter, le compte officiel du jeu a même publié une liste avec les noms de ces cheaters dans un Google Sheet. Au-delà de ça, il explique que les équipes ont toujours été au courant de ce problème et qu'elles essaient continuellement d'y remédier. Pour cela, ils bloquent des \"milliers de tricheurs\" par jour en leur laissant à peine le temps de jouer un peu. Leur système d'anti-cheat, le Battleye, serait constamment amélioré. Rien que la semaine dernière, il aurait été mis à jour quatre fois. En parallèle, ils développent de nouveaux outils de détection anti-cheat et améliorent le système de signalement pour que les choses s'arrangent.        ");
        $section30->setPicture('https://image.jeuxvideo.com/medias-sm/151560/1515596803-2201-capture-d-ecran.png');
        $section30->setArticle($article9);
        $manager->persist($section30);

        //section articles
        $section31 = new Section();
        $section31->setTitle("Pour en conclure");
        $section31->setDescription("Derrière ces explications, les joueurs peinent à être convaincus comme en témoigne le commentaire d'un utilisateur Reddit juste en dessous du patron de Battlestate Games qui l'a même ratio en termes d'upvotes. Celui qui se présente comme un joueur avec plus de 6000 heures sur le jeu étalées sur trois ans explique que ce n'est pas la première fois que les développeurs font ce genre de coup d'éclat et que les choses ne changent pas. Il continue de voir des noms qu'il a report par le passé dont certains qui ont la réputation et le niveau maximaux permis par le jeu. Il remet surtout en question le fait que les équipes bannissent des milliers de joueurs chaque jour car certains ne sont pas détectés malgré ces vagues bannissements. Comme façon efficace de contrer ce problème, le joueur évoque par exemple l'intégration d'une double authentification à l'aide d'un numéro de portable qui réduirait grandement le nombre de cheaters. Vous l'aurez compris, mais le torchon brûle entre les développeurs d'Escape from Tarkov et leurs joueurs et on espère qu'une solution sera vite trouvée pour que les choses reviennent à la normale.");
        $section31->setPicture('https://image.jeuxvideo.com/medias-sm/151560/1515596801-9622-capture-d-ecran.png');
        $section31->setArticle($article9);
        $manager->persist($section31);

        /*-----------------------*/

        //articles
        $article10 = new Article();
        $article10->setTitle("Resident Evil 4 : un remake qui ridiculise les précédents, la taille du jeu enfin connue !");
        $article10->setCover('//image.jeuxvideo.com/medias-md/167820/1678195304-6839-card.jpg');
        $article10->setIsValided(true);
        $article10->setPublicationDate(new \DateTime('2023-03-07T13:25:38.979Z'));
        $article10->setLastModifiedDate(new \DateTime('2023-03-07T13:25:38.979Z'));
        $article10->setWritedBy($user1);
        $article10->setValidatedBy($user2);
        $manager->persist($article10);

        //section articles
        $section32 = new Section();
        $section32->setTitle('Introduction');
        $section32->setDescription("Resident Evil 4, épisode culte de la saga phare de Capcom, reviendra bientôt sous forme de remake sur nos machines. Nous retrouvons dès lors le personnage de Leon S. Kennedy plongé en pleine enquête afin de retrouver la fille du Président des Etats-Unis. Le jeu supprime les QTE, le couteau de Leon est désormais destructible mais gagne en puissance et permet d’effectuer des Stealth Kills et Leon peut maintenant dévier des attaques pour empêcher de subir des dégâts. En plus d’un gameplay modernisé et des graphismes dignes de nos nouvelles consoles, le jeu accueillera des surprises dans sa structure. Bref, tout un tas de nouveautés qui justifie un remake ; Capcom a aussi retravaillé l’importance de certains personnages comme Ashley qui sera un peu moins passive");
        $section32->setPicture('https://image.jeuxvideo.com/medias-md/166633/1666333854-595-capture-d-ecran.jpg');
        $section32->setArticle($article10);
        $manager->persist($section32);

        $section33 = new Section();
        $section33->setTitle('Information');
        $section33->setDescription("Autre information de taille, et c'est le cas de le dire : Resident Evil 4 est désormais disponible en préchargement sur la Xbox Series X et pèse le joli poids de 67,2 Go (lequel devrait être similaire sur PS5). À titre de comparaison et comme le soulignent nos confrères de wccftech, Resident Evil Village était jusqu'à présent le jeu le plus volumineux de la série en termes de taille de fichier en pesant environ 27 Go au lancement. Un bel écart donc, puisque le remake de RE4 pèse deux fois plus que Resident Evil Village et près de trois fois plus que les remakes de RE2 et RE3. \"Le premier RE4 était déjà le jeu le plus long de la série, et il semble que Capcom ne fasse qu'ajouter à la campagne, et non la retrancher\", notent à ce propos les journalistes.");
        $section33->setPicture('https://image.jeuxvideo.com/medias-sm/166633/1666333841-701-capture-d-ecran.jpg');
        $section33->setArticle($article10);
        $manager->persist($section33);

        $section34 = new Section();
        $section34->setTitle('Bientôt le show');
        $section34->setDescription("On le rappelle, Resident Evil 4 sortira le 24 mars 2023 sur PC, PlayStation 5, PlayStation 4 et Xbox Series. Le jeu sera proposé dans une édition standard, mais aussi dans une édition \"Deluxe\" avec sa flopée de DLC. En attendant, Capcom a annoncé la diffusion d'un \"showcase\" mettant en avant Resident Evil 4, mais également Mega Man Battle Network Legacy Collection et \"d'autres titres prévus pour 2023\", avant de préciser que les versions PlayStation et Xbox de Monster Hunter Rise : Sunbreak seraient également mises à l'honneur. Street Fighter 6 sera également présent tout comme Ghost Trick : Détective Fantôme et Exoprimal , TPS futuriste qui s'était laissé approcher lors du Tokyo Game Show 2022. L'événement de l'éditeur, intitulé \"Capcom Spotlight\", sera diffusé ce jeudi 9 mars à 23h30 heure française, et durera 26 minutes.");
        $section34->setPicture('https://image.jeuxvideo.com/medias-sm/166633/1666333841-4140-capture-d-ecran.jpg');
        $section34->setArticle($article10);
        $manager->persist($section34);

        /*-----------------------*/

        //articles
        $article11 = new Article();
        $article11->setTitle("GTA : le grand méchant de Vice City est mort, un hommage vibrant de la part de Rockstar Games ");
        $article11->setCover('//image.jeuxvideo.com/medias-md/167822/1678219345-7168-card.jpg');
        $article11->setIsValided(true);
        $article11->setPublicationDate(new \DateTime('2023-03-07T20:03:23.654Z'));
        $article11->setLastModifiedDate(new \DateTime('2023-03-07T20:03:23.654Z'));
        $article11->setWritedBy($user1);
        $article11->setValidatedBy($user2);
        $manager->persist($article11);

        //section articles
        $section35 = new Section();
        $section35->setTitle('Introduction');
        $section35->setDescription("Les Grand Theft Auto ne sont pas que de gigantesques bacs à sable où il est possible de faire tout et n'importe quoi, ils sont aussi des titres aux histoires impactantes et aux personnages hauts en couleur. Malheureusement, aujourd'hui, l'un des acteurs de la licence phare vient de s'éteindre.");
        $section35->setArticle($article11);
        $manager->persist($section35);

        //section articles
        $section36 = new Section();
        $section36->setTitle("Rockstar réalise un bel hommage pour Tom Sizemore");
        $section36->setDescription("Tom Sizemore est mort le 3 mars dernier… Alors âgé de 61 ans, l'acteur était avant tout connu pour avoir tourné dans plusieurs films cultes à commencer par Speed Kills, mais aussi Il faut sauver le soldat Ryan de Steven Spielberg et bien entendu Heat. Notez qu'il a également donné vie à Sonny Forelli, le grand méchant de GTA Vice City. D'ailleurs, Rockstar Games, attristé par la nouvelle, a réalisé aujourd'hui un bel hommage à la star disparue.");
        $section36->setPicture('https://pbs.twimg.com/media/FqZETNCX0AIGSn6?format=jpg&name=small');
        $section36->setArticle($article11);
        $manager->persist($section36);

        //section articles
        $section37 = new Section();
        $section37->setTitle('Tom Sizemore');
        $section37->setDescription("De nombreuses stars américaines ont également rendu un bel hommage à Tom Sizemore, à commencer par Danny Trejo qui a dévoilé une photo où on peut voir l'acteur décédé en compagnie du réalisateur Michael Mann, mais aussi de Jon Voight, Val Kilmer et Robert De Niro. Robert De Niro a lui aussi pris la parole dans le journal The Hollywood Reporter afin d'exprimer sa tristesse et son affection. De notre côté, toutes les pensées vont bien évidemment à la famille de Tom Sizemore, un homme qui a eu le droit à des rôles cultes aussi bien au cinéma que dans le jeu vidéo.");
        $section37->setPicture('https://pbs.twimg.com/media/FqZZ7pkacAAsjD_?format=jpg&name=small');
        $section37->setArticle($article11);
        $manager->persist($section37);

        /*-----------------------*/

        //articles
        $article12 = new Article();
        $article12->setTitle("Le meilleur Zelda-like de ces dernières années arrive enfin en boîte (et notice) sur Nintendo Switch et PS4 !");
        $article12->setCover('//image.jeuxvideo.com/medias-md/167826/1678260518-1570-card.jpg');
        $article12->setIsValided(true);
        $article12->setPublicationDate(new \DateTime('2023-03-08T08:29:50.192Z'));
        $article12->setLastModifiedDate(new \DateTime('2023-03-08T08:29:50.192Z'));
        $article12->setWritedBy($user1);
        $article12->setValidatedBy($user2);
        $manager->persist($article12);

        //section articles
        $section38 = new Section();
        $section38->setTitle('Introduction');
        $section38->setDescription("En 2022, tout le monde n'en a eu que pour Elden Ring et God of War Ragnarök, voire éventuellement Horizon Forbidden West ou A Plague Tale Requiem. Pourtant, de nombreux jeux indépendants d'excellente facture ont vu le jour l'année dernière, et l'un de ceux dont la sortie boîte était la plus convoitée va enfin bénéficier de ce privilège tant attendu un an après sa sortie. Il y a un an, un jeu aussi mignon que particulièrement délicat à maîtriser voyait le jour : l'excellent Tunic paraissait sur PC, Xbox One et Xbox Series, et nous lui avions attribué à sa sortie un 17/20 amplement mérité. Quelque peu envieux du succès de ce Zelda-like mystérieux mettant en scène un adorable petit renard parodiant la tenue de Link, les joueurs Nintendo Switch furent récompensés de leur patience en septembre, le titre de Finji débarquant enfin sur la console hybride de Nintendo à l'automne mais aussi sur celles de Sony au même moment. Disponible depuis le 27 septembre sur toutes les plates-formes, dont la PlayStation 4 et la PlayStation 5, il ne manquait plus qu'une chose à Tunic : une sortie boîte, très convoitée par les collectionneurs, notamment pour un élément bien particulier qu'elle avait toutes les chances de renfermer…");
        $section38->setArticle($article12);
        $manager->persist($section38);

        //section articles
        $section39 = new Section();
        $section39->setTitle("Tunic en boîte, c'est fait pour !");
        $section39->setDescription("Sensation indépendante de 2022 au même titre qu'un Stray également maintes fois primé (il faut croire que les quadrupèdes à fourrure rousse ont la cote !), Tunic est un action-RPG désireux de rendre hommage à The Legend of Zelda, aussi bien dans son esthétique qui rappelle ce jeu d'aventure mythique, que dans une mécanique de jeu surprenante puisant explicitement son inspiration dans les jeux d'aventure des années 1980, notamment ceux importés du Japon par les joueurs occidentaux incapables de lire la langue de Miyamoto. Les développeurs de Tunic ont en effet admis avoir voulu retranscrire l'expérience de joueurs faisant face à une notice écrite avec un alphabet qu'ils ne savent pas traduire, et devant en déduire ce qu'ils peuvent notamment à l'aide des illustrations et de leur progression dans le jeu, ajoutant tout un tas de notes personnelles au stylo sur ce fameux livret. Dans ce titre volontairement cryptique sur de nombreux points, qui emprunte également à Hollow Knight ou aux fameux \"Souls\" dans bon nombre d'éléments de gameplay ainsi que dans sa narration pour le moins obscure, les principaux \"collectibles\" à récupérer sont les pages d'un livret d'instruction disséminées partout sur la carte du jeu, afin de reconstituer ce dernier dans son intégralité. Le manuel en question est en grande partie la clé de la compréhension de l'univers de Tunic, et constitue une des idées de gameplay les plus brillantes de ces dernières années. L'hommage plus qu'évident que Tunic cherche à rendre au tout premier Zelda réside donc principalement dans l'utilisation de ce manuel écrit dans un langage runique incompréhensible et dont seuls les dessins permettent d'en déduire le sens… et de résoudre bon nombre de ses énigmes, parfois tordues (et encore, c'est un euphémisme !).");
        $section39->setPicture('https://image.jeuxvideo.com/medias-md/167826/1678261303-1771-artwork.png');
        $section39->setArticle($article12);
        $manager->persist($section39);

        //section articles
        $section40 = new Section();
        $section40->setTitle("Quid du fameux manuel d'instructions ?");
        $section40->setDescription("Pour toutes ces raisons, Tunic était donc un titre dont la sortie en boîte était extrêmement attendue, même si les plus exigeants (*) estiment qu'inclure la notice dans une telle édition relève de l'hérésie. Le site Fangamer a en tout cas fini par dévoiler la version boîte du jeu de Finji, éditée dans une édition \"Deluxe\" commercialisée à 45 dollars (soit environ 43€, NDLR) et pour le coup très riche en terme de contenu. Cette version boîte renferme en effet plus que le livret d'instruction tant convoitée, dont une reproduction intégrale des pages au format 13x10cm est incluse, puisqu'on y retrouve également la carte (dépliante) du monde de Tunic, deux planches d'autocollants, un manuel des commandes avec des concept arts ainsi qu'un code pour télécharger son excellente bande originale, signée Lifeformed et Janice Kwan (et dont nous vous recommandons vivement l'écoute, soit dit en passant). (*) Sans doute les mêmes joueurs que ceux refusant toute forme d'assistance dans \"leurs\" jeux alors que cela ne les regarde pas, vu qu'ils peuvent y jouer sans aide et/ou mode facile, et que l'accessibilité pour le plus grand nombre est une nécessité ? Ne me sautez pas à la gorge, le débat reste ouvert !");
        $section40->setPicture('https://image.jeuxvideo.com/medias-sm/167826/1678263899-5134-artwork.png');
        $section40->setArticle($article12);
        $manager->persist($section40);

        //section articles
        $section41 = new Section();
        $section41->setTitle("Les joueurs Xbox pas récompensés…");
        $section41->setDescription("Malheureusement, il y a une ombre au tableau, qui risque de désespérer les joueurs Xbox encore attachés au format physique. Alors que Tunic fut une exclusivité console pendant 6 mois du côté de chez Microsoft, Tunic n'aura pas droit à une version boîte sur Xbox, que ce soit une version Xbox One, une version Xbox Series X, ou une édition indiquant regrouper les deux machines sur sa jaquette. Le titre de Finji sortira en effet uniquement sur PS4 (compatible PS5) et sur Switch, les deux supports généralement privilégiés par les distributeurs de jeux indépendants bénéficiant d'une sortie physique décalée par rapport à leur première parution en dématérialisée. Il n'est du coup hélas pas étonnant de ne pas voir Tunic disposer d'une version boîte sur consoles Xbox, même si cela reste regrettable pour les collectionneurs de boîtes vertes. Peut-être se rabattront-ils sur une des deux autres éditions, vu que malgré tout, cette sortie tant attendue de Tunic en version boîte semble plus que valoir le coup (et le coût) !");
        $section41->setPicture('https://image.jeuxvideo.com/medias-md/164804/1648042213-3290-artwork.jpg');
        $section41->setArticle($article12);
        $manager->persist($section41);

        /*-----------------------*/

        //articles
        $article13 = new Article();
        $article13->setTitle('The Last of Us : cette parodie avec des Claqueurs sous Unreal Engine 5 est aussi drôle qu’impressionnante');
        $article13->setCover('//image.jeuxvideo.com/medias-md/167827/1678272791-8953-card.jpeg');
        $article13->setIsValided(true);
        $article13->setPublicationDate(new \DateTime('2023-03-08T11:01:47.467Z'));
        $article13->setLastModifiedDate(new \DateTime('2023-03-08T11:01:47.467Z'));
        $article13->setWritedBy($user1);
        $article13->setValidatedBy($user2);
        $manager->persist($article13);

        //section articles
        $section42 = new Section();
        $section42->setTitle('Introduction');
        $section42->setDescription("Chez Naughty Dog, on a voulu créer une histoire sombre et bouleversante lors de la création de The Last of Us. Par-delà le monde, l’aventure d’Ellie et Joel a eu un impact considérable et n’a eu de cesse de stimuler la créativité de certains, à l’image de la chaîne YouTube AFK. Avec leur vidéo « Clickers », les équipes d’Epically Casual ont eu envie de prendre le contre-pied total en imaginant une parodie légère et désopilante où l’on suit deux Claqueurs.");
        $section42->setArticle($article13);
        $manager->persist($section42);

        //section articles
        $section43 = new Section();
        $section43->setTitle('De nouveaux projets The Last of Us, y compris chez les fans');
        $section43->setDescription("Dans quelques jours, la folie The Last of Us commencera à diminuer petit à petit avec la diffusion de l’ultime épisode de cette première saison, une poignée de minutes qui risquent de diviser les fans selon les récentes déclarations de l’actrice Bella Ramsey qui incarne le personnage d’Ellie'. Après neuf épisodes haletants, la série tirera sa révérence jusqu’à la diffusion de la saison 2, d’ores et déjà confirmée par le diffuseur américain HBO. Nouveau coup de maître pour la chaîne étasunienne puisque l’adaptation du chef-d’œuvre de Naughty Dog fait l’unanimité sur la toile, réussissant même quelques fulgurances la plaçant au-dessus du jeu vidéo original comme on le soulignait dans notre avis de l’épisode 8. Dimanche, le clap de fin retentira pour la chaîne HBO qui, à cet instant, rendra son bébé au studio de développement californien. Des projets autour de cet univers, il y en a encore bel et bien. Si l’on s’interroge encore sur la possibilité d’un The Last of Us Part. III, le studio Naughty Dog planche actuellement sur un projet annexe qui mettrait l’accent sur le multijoueur dont on attend impatiemment les premiers extraits de gameplay. Pendant ce temps, les fans de la communauté The Last of Us rivalisent d’originalité et se servent de l’univers du jeu pour créer leurs propres projets, à l’image de cette parodie qui réveillera notre compassion pour les terribles Claqueurs. Dimanche, le clap de fin retentira pour la chaîne HBO qui, à cet instant, rendra son bébé au studio de développement californien. Des projets autour de cet univers, il y en a encore bel et bien. Si l’on s’interroge encore sur la possibilité d’un The Last of Us Part. III, le studio Naughty Dog planche actuellement sur un projet annexe qui mettrait l’accent sur le multijoueur dont on attend impatiemment les premiers extraits de gameplay. Pendant ce temps, les fans de la communauté The Last of Us rivalisent d’originalité et se servent de l’univers du jeu pour créer leurs propres projets, à l’image de cette parodie qui réveillera notre compassion pour les terribles Claqueurs.");
        $section43->setPicture('https://image.jeuxvideo.com/medias-sm/167827/1678272929-2799-capture-d-ecran.png');
        $section43->setArticle($article13);
        $manager->persist($section43);

        //section articles
        $section44 = new Section();
        $section44->setTitle('Martyrisés, cette parodie nous met à la place des Claqueurs et c’est tordant');
        $section44->setDescription("Sur la chaîne YouTube AFK, les équipes de production d’Epically Casual ont eu une idée pour le moins originale. Dans le jeu, Joel et Ellie sont entre autres menacés par les Claqueurs, une évolution des infectés qui les rend certes aveugles mais terriblement puissants et redoutés. Mais qu’en est-il si les rôles étaient inversés ? Grâce aux prouesses de l’Unreal Engine 5, ils ont pu reproduire deux Claqueurs et les faire interagir de manière désopilante, s’amusant de leur cécité en les faisant jouer à colin-maillard (un jeu enfantin appelé Marco Polo, outre-Atlantique) et se moquant des humains parfois très maladroits face à eux. S’ils sont très dangereux dans le jeu, cette brillante parodie de The Last of Us tend à les humaniser et à nous mettre à leur place, eux qui se prennent parfois des briques ou des bouteilles de verre en pleine tête et qui vivent dans la crainte de croiser, eux aussi, un danger menaçant leur existence. Bref, leurs interactions et leurs dialogues font mouche et, en commentaires, on applaudit le travail accompli, tout en réclamant d’autres formats de ce genre et en espérant qu’il n’arrivera rien à de grave à cet adorable et pourtant si létal duo de claqueurs.");
        $section44->setArticle($article13);
        $manager->persist($section44);

        /*-----------------------*/

        //articles
        $article14 = new Article();
        $article14->setTitle("Square Enix et les NFT, ce n'est malheureusement pas finia");
        $article14->setCover("//image.jeuxvideo.com/medias-md/167818/1678183632-8524-card.gif");
        $article14->setIsValided(true);
        $article14->setPublicationDate(new \DateTime('2023-03-07T10:13:54.020Z'));
        $article14->setLastModifiedDate(new \DateTime('2023-03-07T10:13:54.020Z'));
        $article14->setWritedBy($user1);
        $article14->setValidatedBy($user2);
        $manager->persist($article14);

        //section articles
        $section45 = new Section();
        $section45->setTitle("Introduction");
        $section45->setDescription("Le patron de Square Enix est sur le départ, prêt à être remplacé par du sang neuf. Malheureusement, la compagnie ne semble pas vouloir mettre de côté ses ambitions dans le domaine de la blockchain.");
        $section45->setArticle($article14);
        $manager->persist($section45);

        //section articles
        $section45 = new Section();
        $section45->setTitle('Final Fantasy NFT');
        $section45->setDescription("L’année dernière, nous dressions un premier bilan de l’arrivée des NFT chez les géants du jeu vidéo. Nous expliquions que les éditeurs, conscients de l’impopularité de tout ce qui touche à la blockchain auprès d’une partie des joueurs, avançaient à tâtons. Yosuke Matsuda, le PDG de Square Enix depuis 10 ans, a souvent montré son envie de mener sa société sur les chemins sinueux des NFT. Malgré tout, lors de la revente de Crystal Dynamics et d’Eidos Montreal, le responsable expliquait que l’argent récolté allait être utilisé “pour financer les efforts visant à améliorer les licences du groupe” plutôt que pour “développer des domaines d’investissement liés à la blockchain”. Récemment, l’éditeur japonais a annoncé le remplacement de son PDG afin de remodeler l'équipe de direction dans le but “d'adopter des innovations technologiques en constante évolution et de maximiser la créativité du groupe”. Sous réserve d’approbation des actionnaires au mois de juin, c’est Takashi Kiryu qui deviendra le grand patron, un ancien de Dentsu Innovation Initiative, groupe connu pour ses investissements dans le Métavers. Vous le voyez venir : rien n’indique que Square Enix va mettre de côté ses projets NFT, bien au contraire.");
        $section45->setPicture('https://image.jeuxvideo.com/medias-sm/167058/1670575196-3740-capture-d-ecran.jpg');
        $section45->setArticle($article14);
        $manager->persist($section45);

        //section articles
        $section46 = new Section();
        $section46->setTitle('Le Web 3.0 toujours au planning');
        $section46->setDescription("C’est lors d’une conférence de presse s’étant déroulée le 3 mars 2023 que Takashi Kiryu a pris la parole. Il a tout d’abord expliqué son amour pour Final Fantasy et Dragon Quest, lui qui s’est acheté les jeux d’origine le jour de leur sortie. Il cite Tobal No.1 comme étant son titre préféré de tous les temps. Derrière le joueur se cache aussi le businessman. Kiryu a précisé qu’il allait continuer de suivre la stratégie de Square Enix envers le Web 3.0, stratégie initiée par Yosuke Matsuda. D’après lui, la blockchain et tout ce qui en découle “a le potentiel de conduire à la prochaine étape de croissance de la société”. De son côté, Matsuda ne restera pas chez Square Enix après son départ à la retraite, mais il continuera à regarder ce que fait le groupe, “en tant que fan de l'entreprise” explique-t-il. Lors de la séance de questions-réponses, il a également déclaré qu'il recevait parfois des avis sévères de la part des joueurs, mais que cela faisait partie du “véritable plaisir d'être une entreprise qui fournit du contenu\".");
        $section46->setPicture('https://image.jeuxvideo.com/medias-sm/166628/1666280028-9497-capture-d-ecran.jpg');
        $section46->setArticle($article14);
        $manager->persist($section46);

        /**************************/

        //articles
        $article15 = new Article();
        $article15->setTitle("Ce titre déjanté noté 16/20 est à moins de 10€ sur Steam !");
        $article15->setCover("//image.jeuxvideo.com/medias-md/168433/1684332656-9938-card.jpeg");
        $article15->setIsValided(true);
        $article15->setPublicationDate(new \DateTime('2023-05-21T08:35:02.930Z'));
        $article15->setLastModifiedDate(new \DateTime('2023-05-21T08:35:02.930Z'));
        $article15->setWritedBy($user1);
        $article15->setValidatedBy($user2);
        $manager->persist($article15);

        //section articles
        $section47 = new Section();
        $section47->setTitle("Introduction");
        $section47->setDescription("Borderlands 3 est un looter-shooter aussi bourrin que déjanté où le joueur est amené à affronter les jumeaux Calypso qui cherchent à dominer le monde. Parmi les points positifs mis en valeur dans notre test, figurent des combats d’armes à feu particulièrement nerveux, un contenu généreux, une grande qualité de doublage VO et VF et un sentiment omniprésent de progression.");
        $section47->setPicture('https://image.jeuxvideo.com/medias-md/168433/1684332495-9401-capture-d-ecran.jpg');
        $section47->setArticle($article15);
        $manager->persist($section47);

        //section articles
        $section48 = new Section();
        $section48->setTitle('Borderlands 3 à 8,99€ au lieu de 59,99€ (-85%)');
        $section48->setDescription("Eh oui, ce troisième opus de cette saga culte est disponible sur Steam à moins de 10€ ! Si vous n’avez pas encore découvert ce jeu, l’opportunité s’offre à vous avec cette grande réduction. À -85%, ce titre noté 16/20 vaut réellement le coup, si on apprécie l’univers de la franchise. Notez cependant que cette promotion prend fin le 30 mai, ce qui laisse quelques jours pour en profiter. Une autre promotion est intéressante sur Steam, il s’agit du Borderlands 3 Ultimate Edition qui contient un grand nombre de DLC et tous les packs cosmétiques bonus. Cette édition est à seulement 29,36€ au lieu de 254,80€ grâce à sa réduction de -88%. En bref, les amoureux de la licence peuvent trouver leur bonheur sur Steam, mais également ceux qui souhaitent la découvrir !");
        $section48->setPicture('https://image.jeuxvideo.com/medias-md/168433/1684332495-9401-capture-d-ecran.jpg');
        $section48->setArticle($article15);
        $manager->persist($section48);

        //section articles

        $article16 = new Article();
        $article16->setTitle("Noté 16/20, ce FPS d’Ubisoft est à moins de 20€ sur Steam !");
        $article16->setCover("//image.jeuxvideo.com/medias-md/168432/1684319812-8286-card.jpeg");
        $article16->setIsValided(true);
        $article16->setPublicationDate(new \DateTime('2023-05-21T05:15:01.989Z'));
        $article16->setLastModifiedDate(new \DateTime('2023-05-21T05:15:01.989Z'));
        $article16->setWritedBy($user1);
        $article16->setValidatedBy($user2);
        $manager->persist($article16);

        $section49 = new Section();
        $section49->setTitle('Introduction');
        $section49->setDescription("De nombreux joueurs à travers le monde profitent des promotions Steam pour se procurer des titres vidéoludique de qualité, à moindre coût ! En ce moment, c’est un jeu Ubisoft qui est concerné par une grosse réduction.");
        $section49->setArticle($article16);
        $manager->persist($section49);

        $section50 = new Section();
        $section50->setTitle('Information');
        $section50->setDescription("Si vous appréciez les FPS à l’histoire haletante, vous avez sans doute déjà joué à l’un des jeux de la licence Far Cry. Difficile de passer à côté de cette licence légendaire, dont le troisième opus noté 18/20 sur JV à l’époque avait rencontré un très grand succès auprès des fans. Fier de cette saga, Ubisoft a déjà sorti six opus de Far Cry ! Ainsi, après un titre aux Etats-Unis en compagnie d’un culte de fanatique, Far Cry 6 a proposé un détour sur une île tropicale.");
        $section50->setArticle($article16);
        $manager->persist($section50);

        $section51 = new Section();
        $section51->setTitle('Suite');
        $section51->setDescription("Parmi les points positifs figure notamment le fait que le héros et le méchant sont des personnages charismatiques. Il faut dire que l’antagoniste principal est incarné par Giancarlo Esposito, connu surtout pour avoir joué Gus Fring dans Breaking Bad et Better Call Saul. La narration est l’un des points forts du jeu tant Ubisoft semble avoir mis l’accès sur cet aspect, renforçant l’immersion dans l’île fictive de Yara. Bien qu’il possède quelques points négatifs, comme l’intelligence artificielle qui n’est pas au point et la redondance des objectifs, il reste un jeu agréable.");
        $section51->setPicture('https://image.jeuxvideo.com/medias-md/168432/1684319587-4627-capture-d-ecran.jpg');
        $section51->setArticle($article16);
        $manager->persist($section51);

        $section52 = new Section();
        $section52->setTitle('Far Cry 6 à 15€ au lieu de 59,99€ sur Steam (-75%)');
        $section52->setDescription("Si vous êtes un joueur PC, vous serez peut-être intéressé par cette offre qui met en avant un jeu plutôt récent, à moins de 20€. La moyenne des évaluations Steam sur ce titre est “plutôt positive” et beaucoup d’internautes ont témoigné s’être sentis immergés à Yara, dans un univers tropical graphiquement très beau. Ne tardez pas, car cette promotion se termine le 25 mai. Néanmoins, si vous êtes intéressés par la licence Far Cry et que vous n’y avez pas encore joué, une autre offre pourrait vous intéresser ! Il s’agit du Far Cry Bundle à 229,42€ au lieu de 299,91€ sur Steam.");
        $section52->setArticle($article16);
        $manager->persist($section52);

        /****************************************************************/

        $article17 = new Article();
        $article17->setTitle("Il y a 10 ans, Microsoft ratait l’annonce de sa Xbox One");
        $article17->setCover("//image.jeuxvideo.com/medias-md/168009/1680089052-5629-card.png");
        $article17->setIsValided(true);
        $article17->setPublicationDate(new \DateTime('2023-05-21T05:00:02.457Z'));
        $article17->setLastModifiedDate(new \DateTime('2023-05-21T05:00:02.457Z'));
        $article17->setWritedBy($user1);
        $article17->setValidatedBy($user2);
        $manager->persist($article17);

        $section53 = new Section();
        $section53->setTitle('Introduction');
        $section53->setDescription("Nous fêtons un drôle d’anniversaire aujourd’hui, celui de l’annonce ratée de la Xbox One. Il y a 10 ans en effet, le géant américain organisait une conférence de presse à Redmond afin de présenter le futur de la marque. La suite, on la connaît : des joueurs du monde entier hurlent leur colère et Microsoft entame un 180° tonitruant.");
        $section53->setArticle($article17);
        $manager->persist($section53);


        $section54 = new Section();
        $section54->setTitle('L’héritage de Don Mattrick');
        $section54->setDescription("Le 21 mai 2013, Microsoft présente au monde entier sa future console de jeux, la Xbox One. L’événement, qui se déroule directement à Redmond, ville du géant américain, est filmé pour être retransmis en direct sur Internet. Toutes les planètes semblent alignées pour un événement renversant : la firme de Redmond bombe le torse, elle joue à domicile et bénéficie d’un avantage considérable en matière de communication, puisqu’elle passe trois mois après Sony qui avait dévoilé sa PlayStation 4 le 21 février 2013. De quoi rebondir sereinement sur chacun des arguments avancés par son concurrent.");
        $section54->setPicture('https://image.jeuxvideo.com/medias-md/168009/1680089098-2493-photo.jpg');
        $section54->setArticle($article17);
        $manager->persist($section54);

        $section55 = new Section();
        $section55->setTitle('Information');
        $section55->setDescription('L’homme fort chez Xbox à cette époque, c’est Don Mattrick. L’ancien président des studios Electronic Arts a pris ses fonctions de directeur de la branche Interactive Entertainment Business chez Microsoft (comprenant la Xbox et les jeux PC) en 2007 sous l’impulsion de Robbie Bach. Sous le règne de Mattrick, la base installée de Xbox 360 dans le monde est passée de 10 millions à plus de 76 millions, alors que le nombre d’abonnés au Xbox Live (silver et gold) a été multiplié par 8, passant de 6 millions à 48 millions. Des chiffres impressionnants qui ont réussi à maintenir Sony et sa PlayStation 3 sous pression.');
        $section55->setPicture('https://image.jeuxvideo.com/images-sm/x3/k/i/kinect-sports-xbox-360-002.jpg');
        $section55->setArticle($article17);
        $manager->persist($section55);

        $section56 = new Section();
        $section56->setTitle('Suite');
        $section56->setDescription('Quand je suis arrivé chez Microsoft, Steve Ballmer m’a dit qu’il fallait miser sur de nouvelles catégories, innover et créer les nouveaux succès du jeu vidéo et du divertissement” se souvient Don Mattrick dans le reportage Power On. Conformément aux souhaits de Ballmer, Mattrick ne veut pas vendre 30 millions de consoles, mais 300 millions. Pour tenter d’y arriver, sa stratégie va reposer sur des expériences grand public. Il mise sur le divertissement, sur le cinéma, sur Netflix, sur HBO, sur Facebook ou encore sur Twitter qui débarquent sur Xbox 360.');
        $section56->setPicture('https://image.jeuxvideo.com/images-sm/x3/l/i/lipsx3005.jpg');
        $section56->setArticle($article17);
        $manager->persist($section56);

        $section57 = new Section();
        $section57->setTitle('Retours mortels');
        $section57->setDescription('Suite à l’événement, les retours des joueurs mais aussi de la presse spécialisée sont catastrophiques. Microsoft a beau promettre un E3 à venir dédié aux jeux, ce qu’il a montré de la Xbox One n’a pas convaincu. L’importance de Kinect dans l’écosystème Xbox One commence à soulever différentes interrogations, et le virage “divertissement télévisé” n’est pas du goût de tous. Pire, le géant américain ferme la porte à la rétrocompatibilité, et veut instaurer un système payant pour que le joueur installe un soft sur une seconde machine. Enfin, Don Mattrick explique qu’il faudra régulièrement connecter sa machine au Xbox Live pour que le système vérifie les licences. Des décisions allant à l’encontre des utilisateurs, estiment de nombreux joueurs.');
        $section57->setPicture('https://image.jeuxvideo.com/images-sm/pc/r/y/ryse-son-of-rome-pc-1407431965-001.jpg');
        $section57->setArticle($article17);
        $manager->persist($section57);

        $section58 = new Section();
        $section58->setTitle('Conclusion');
        $section58->setDescription('Lors de l’E3 2013, alors que Microsoft a déjà la tête dans le sable à cause des histoires de connexion permanente pour sa Xbox One empêchant les joueurs de se prêter des softs simplement, Sony publie une vidéo vacharde montrant la simplicité du don de jeu à un autre camarade sur PlayStation 4. Un coup de génie qui ridiculise immédiatement la firme de Redmond et ses mesures allant à l’encontre du marché de l’occasion. En outre, pendant cet E3 2013, rien ne sourit à Microsoft. Tout d’abord, la Xbox One vendue à 100 euros de plus que la PlayStation 4 est très mal perçue. Ensuite, Ryse son of Rome, pourtant impressionnant techniquement, est vivement critiqué à cause de son gameplay jugé trop simple. Killer Instinct, de son côté, essuie de lourdes plaintes à cause de son business model peu répandu à l’époque. Malgré la présence d’une bande-annonce pour Halo 5, d’un trailer pour Quantum Break, d’une vidéo pour Sunset Overdrive et de la démonstration surprise de Titanfall à la fin du show, la Xbox One continue de se prendre un torrent de critiques. Lors d’une interview, Don Mattrick dira à propos de la connexion obligatoire : “si vous n’avez pas internet, nous avons la Xbox 360”. Ce sera la phrase de trop.');
        $section58->setPicture('https://image.jeuxvideo.com/medias-md/167968/1679678292-7367-photo.jpg');
        $section58->setArticle($article17);
        $manager->persist($section58);

        /*************************************************************************************************/

        $article18 = new Article();
        $article18->setTitle("Une victoire de plus pour Microsoft ! Un nouveau marché majeur valide le rachat d'Activision Blizzard");
        $article18->setCover("//image.jeuxvideo.com/medias-md/168459/1684586346-5372-card.jpg");
        $article18->setIsValided(true);
        $article18->setPublicationDate(new \DateTime('2023-05-20T12:49:10.832Z'));
        $article18->setLastModifiedDate(new \DateTime('2023-05-20T12:49:10.832Z'));
        $article18->setWritedBy($user1);
        $article18->setValidatedBy($user2);
        $manager->persist($article18);

        $section59 = new Section();
        $section59->setTitle('Introduction');
        $section59->setDescription("Et un de plus ! Un marché majeur supplémentaire vient de donner son accord à Microsoft pour poursuivre le rachat d'Activision-Blizzard quelques jours seulement après la validation de l'Europe.");
        $section59->setArticle($article18);
        $manager->persist($section59);

        $section60 = new Section();
        $section60->setTitle("Une marche après l'autre");
        $section60->setDescription("Microsoft poursuit son travail auprès des différents régulateurs du monde entier pour se faire entendre et obtenir leur feu vert en vue du rachat du groupe Activision-Blizzard-King. Rien n'est encore joué pour l'instant, tandis que la CMA, le régulateur britannique, a décidé de s'opposer à la transaction à la fin du mois dernier. Mais la firme de Redmond reste encore dans la course. Il y a quelques jours, la Commission européenne a décidé de pencher en faveur du géant américain. Une excellente nouvelle pour Microsoft, qui devra néanmoins répondre à plusieurs conditions, dont un investissement important dans le Cloud. La firme s’est ainsi engagée à accorder des licences gratuites aux fournisseurs de services Cloud afin que les consommateurs puissent jouer en streaming aux jeux Activision Blizzard qu’ils ont achetés, peu importe le système d’exploitation utilisé et le service souscrit. Peu de temps après cette validation plus qu'importante, c'est au tour d'un autre marché majeur de donner son accord comme l'a rapporté Microsoft'.");
        $section60->setArticle($article18);
        $manager->persist($section60);

        $section61 = new Section();
        $section61->setTitle("La Chine donne son feu vert");
        $section61->setDescription("Après l'Europe, c'est au tour de la Chine de donner son accord en vue du rachat d'Activision-Blizzard. Tom Warren, journaliste pour The Verge, a notamment relayé le communiqué de Microsoft faisant suite à la validation accordée par la SAMR (State Administration for Market Regulation )");
        $section61->setPicture('https://pbs.twimg.com/media/FwgbojyXwAk-ah3?format=jpg&name=small');
        $section61->setArticle($article18);
        $manager->persist($section61);

        $section62 = new Section();
        $section62->setTitle("Conclusion");
        $section62->setDescription("Malgré tout, il reste encore quelques étapes avant que Microsoft ne parvienne à boucler ce rachat. L'approbation de la Chine pourrait jouer en faveur du géant lorsqu'il tentera de renverser la décision de la CMA en appel prochainement, tout comme celle de la FTC, l'instance régulatrice américaine.");
        $section62->setArticle($article18);
        $manager->persist($section62);


        /*************************************************************************************************/

        $article19 = new Article();
        $article19->setTitle("Marvel’s Spider-Man 2 : une suite « sans concession », va-t-on avoir droit à l’exclu PS5 la plus folle à ce jour ?");
        $article19->setCover("//image.jeuxvideo.com/medias-md/168457/1684574405-6619-card.jpg");
        $article19->setIsValided(true);
        $article19->setPublicationDate(new \DateTime('2023-05-20T09:30:32.558Z'));
        $article19->setLastModifiedDate(new \DateTime('2023-05-20T09:30:32.558Z'));
        $article19->setWritedBy($user1);
        $article19->setValidatedBy($user2);
        $manager->persist($article19);

        $section63 = new Section();
        $section63->setTitle("Introduction");
        $section63->setDescription("Sony l'a assuré à maintes reprises : Peter Parker et Miles Morales reprendront du service cette année avec la sortie de Marvel's Spider-Man 2. Une exclusivité PS5 à suivre de très près ? Assurément, surtout si l'on croit les dernières déclarations de Jim Ryan.");
        $section63->setArticle($article19);
        $manager->persist($section63);

        $section64 = new Section();
        $section64->setTitle("Spider-Man, le retour");
        $section64->setDescription("Pour ce début d'année 2023, force est de constater que les joueurs PS5 restent quelque peu sur leur faim. Pas de panique cela dit, il y a de belles choses qui se profilent à l'horizon du côté des exclusivités. Le mois prochain, c'est Final Fantasy XVI qui arrive sur la console de Sony. Et peu de temps après, les joueurs auront droit au très attendu Marvel's Spider-Man 2, suite du très bon jeu d'Insomniac Games sorti en 2018.");
        $section64->setPicture('https://image.jeuxvideo.com/medias-md/168457/1684574417-8862-artwork.jpg');
        $section64->setArticle($article19);
        $manager->persist($section64);

        $section65 = new Section();
        $section65->setTitle("Information");
        $section65->setDescription("Reste à savoir quand exactement ce nouvel opus arrivera dans le catalogue de la PS5. Pour l'instant, Sony affirme viser une sortie pour l'année, mais aucune date précise n'a été communiquée à ce jour. Cette date pourrait cependant être dévoilée la semaine prochaine à l'occasion du nouveau Playstation Showcase. En attendant, Jim Ryan, le président de Sony Interactive Entertainment, a eu l'occasion de parler du titre auprès de Famitsu. Et ses déclarations ont de quoi attiser notre curiosité.");
        $section65->setArticle($article19);
        $manager->persist($section65);

        $section66 = new Section();
        $section66->setTitle("Une vraie exclu PS5");
        $section66->setDescription("C'est dans une longue interview accordée au média nippon Famitsu que Jim Ryan a pu évoqué Marvel's Spider-Man 2. Selon lui, à l'instar de FF16, ce nouvel opus dédié au tisseur serait parfait pour la PS5 et tirerait pleinement parti de la puissance de la console. Ainsi, Insomniac Games aurait conçu cet opus \"sans faire de compromis\". Le studio aurait eu pour consigne de se focaliser sur l'optimisation du titre et d'exploiter pleinement les fonctionnalités de la PS5. Le président de SIE va plus loin et évoque également les premiers retours qui parlent d'un jeu \"magnifique\" et \"vraiment impressionnant\". On se souvient notamment des sensations grisantes d'exploration de New York dans la peau de Spidey, on ne peut donc qu'espérer retrouver une expérience encore meilleure au sein de cet opus. Jim Ryan promet ici évidemment de belles choses pour un soft de son écurie, mais on restera tout de même assez excité à l'idée de découvrir ce qu'Insomniac a concocté pour les fans. Rendez-vous prochainement - idéalement dès le 24 mai au cours du Playstation Showcase - pour en savoir plus !");
        $section66->setArticle($article19);
        $manager->persist($section66);

        $section67 = new Section();
        $section67->setTitle("Conclusion");
        $section67->setDescription("Le président de SIE va plus loin et évoque également les premiers retours qui parlent d'un jeu \"magnifique\" et \"vraiment impressionnant\". On se souvient notamment des sensations grisantes d'exploration de New York dans la peau de Spidey, on ne peut donc qu'espérer retrouver une expérience encore meilleure au sein de cet opus. Jim Ryan promet ici évidemment de belles choses pour un soft de son écurie, mais on restera tout de même assez excité à l'idée de découvrir ce qu'Insomniac a concocté pour les fans. Rendez-vous prochainement - idéalement dès le 24 mai au cours du Playstation Showcase - pour en savoir plus !");
        $section67->setArticle($article19);
        $manager->persist($section67);


        /*****************************************************************/


        $article20 = new Article();
        $article20->setTitle("Diablo 4 annonce son premier Twitch Drop, mais il y a un souci : pour obtenir cette monture exclusive, il faudra payer");
        $article20->setCover("//image.jeuxvideo.com/medias-md/168452/1684517659-4031-card.jpg");
        $article20->setIsValided(true);
        $article20->setPublicationDate(new \DateTime('2023-05-19T18:00:03.179Z'));
        $article20->setLastModifiedDate(new \DateTime('2023-05-19T18:00:03.179Z'));
        $article20->setWritedBy($user1);
        $article20->setValidatedBy($user2);
        $manager->persist($article20);

        $section68 = new Section();
        $section68->setTitle("Introduction");
        $section68->setDescription("C'est le 6 juin prochain que les joueurs pourront retourner à Sanctuary et y rester ! Après trois phases de bêtas, Diablo IV est passé Gold et Blizzard s'apprête à mettre sur le marché son nouveau jeu. Très attendu, il devrait également investir Twitch dès l'ouverture des serveurs.");
        $section68->setArticle($article20);
        $manager->persist($section68);

        $section69 = new Section();
        $section69->setTitle("Les bêtas sont passées, Diablo IV prêt au lancement");
        $section69->setDescription("Diablo IV a été jouable plusieurs fois ces dernières semaines et la hype autour du jeu semble incontestable. Il y a d'abord eu une bêta fermée réservée aux joueurs ayant précommandé le jeu, puis une bêta ouverte et enfin un \"server slam\" le week-end dernier. L'occasion pour le public d'essayer les différentes classes et pour Blizzard d'effectuer des ajustements, quitte à se faire taper sur les doigts. A un peu moins de trois semaines du lancement, les équipes apportent les dernières touches au titre, qui devrait logiquement être gratifié d'un solide patch Day One, et espèrent sûrement que les serveurs tiennent le coup.");
        $section69->setArticle($article20);
        $manager->persist($section69);

        $section70 = new Section();
        $section70->setTitle("Information");
        $section70->setDescription("Comme vous le savez peut-être, tout dans Diablo est affaire de loot et de choses à faire et à refaire. Les joueurs pourront compter sur une campagne au ton particulièrement sombre, mais également sur des saisons, un monde ouvert remplit d'événements, de grottes, de donjons et d'autres joueurs. Le but : dézinguer du monstre par paquets, accomplir de défis et améliorer ses personnages avec de l'équipement toujours plus rare, toujours plus puissant. Comme ses prédecesseurs, Diablo IV entend nous garder actif pendant des mois et des années, avec du nouveau contenu, des boss temporaires et des loots spéciaux.");
        $section70->setPicture('https://image.jeuxvideo.com/medias-sm/168449/1684487952-3822-capture-d-ecran.jpg');
        $section70->setArticle($article20);
        $manager->persist($section70);

        $section71 = new Section();
        $section71->setTitle("Suite");
        $section71->setDescription("Comme de nombreux autres titres, Diablo IV devrait tenter d'attirer les joueurs en passant par Twitch. De nombreux streams seront organisés par les créateurs de contenus, mais il semble que Blizzard va également mettre la main à la patte en participant au programme Drops ! Si vous regardez régulièrement du contenu sur la plateforme d'Amazon, vous avez sûrement déjà remarqué qu'en plus d'obtenir des choses grâce à Prime Gaming, vous pouvez débloquer du contenu en regardant des streams partenaires.");
        $section71->setPicture('https://image.jeuxvideo.com/medias-sm/163594/1635935451-8344-capture-d-ecran.jpg');
        $section71->setArticle($article20);
        $manager->persist($section71);

        $section72 = new Section();
        $section72->setTitle("Une monture payante proposée via Twitch Drops ?");
        $section72->setDescription("Grâce à un utilisateur de Reddit, on apprend que Blizzard aurait prévu de distribuer une monture exclusive par l'intermédiaire des Twitch Drops. La liste des streameurs partenaires n'a pas encore été dévoilée, mais on sait que l'initiative n'est plus une rumeur. Adam Fletcher de chez Blizzard a en effet confirmé l'information, précisant qu'il y aurait d'autre choses à récupérer grâce au système de drops. S'il précise cela, c'est parce que la monture Primal Insctinct ne devrait pas être accessible simplement en ouvrant un stream partenaire.");
        $section72->setPicture('https://image.jeuxvideo.com/medias-sm/168452/1684517508-7473-capture-d-ecran.jpg');
        $section72->setArticle($article20);
        $manager->persist($section72);

        $section73 = new Section();
        $section73->setTitle("Conclusion");
        $section73->setDescription("Quand aux autres drops mentionnés par Adam Fletcher, le flou règne encore. On ne sait pas ce qu'ils contiendront, ni s'il seront distribués en même temps ou à la suite de la monture Primal Instinct. Ce qu'on sait en revanche, c'est que certains éléments seront proposés de façon plus classique, c'est à dire qu'il devrait suffir de regarder un stream partenaire pour espérer obtenir l'élement cosmétique distribué.");
        $section73->setArticle($article20);
        $manager->persist($section73);


        /*****************************************************************/


        $article21 = new Article();
        $article21->setTitle("Nintendo Switch : trois classiques de la Game Boy Advance arrivent dans le Pack additionnel");
        $article21->setCover("//image.jeuxvideo.com/medias-md/168451/1684512430-2230-card.png");
        $article21->setIsValided(true);
        $article21->setPublicationDate(new \DateTime('2023-05-19T18:00:03.179Z'));
        $article21->setLastModifiedDate(new \DateTime('2023-05-19T18:00:03.179Z'));
        $article21->setWritedBy($user1);
        $article21->setValidatedBy($user2);
        $manager->persist($article21);

        $section74 = new Section();
        $section74->setTitle("Introduction");
        $section74->setDescription("Nintendo a annoncé une nouvelle vague de jeux pour le Nintendo Switch Online. Les derniers ajouts font partie du Pack additionnel, ajoutant trois titres Super Mario sur Game Boy Advance.");
        $section74->setArticle($article21);
        $manager->persist($section74);

        $section75 = new Section();
        $section75->setTitle("Informations");
        $section75->setDescription("Le 26 mai prochain, la Switch accueillera trois nouveaux titres Game Boy Advance ! Il s'agit des trois premiers épisodes de la série Super Mario Advance. Il y aura donc Super Mario Advance (2001), Super Mario World : Super Mario Advance 2 (2001) et Yoshi's Island : Super Mario Advance 3 (2002). La console proposait déjà Super Mario Advance 4 : Super Mario Bros. 3 (2003) dans son catalogue, la série est donc complétée. Ces jeux seront accessibles depuis l'émulateur Game Boy Advance de la Switch, disponible via l'abonnement Nintendo Switch Online + Pack additionnel. C'est la version premium de l'abonnement online de Nintendo (39,99€ pour 12 mois).");
        $section75->setPicture('https://image.jeuxvideo.com/medias-md/168451/1684506045-9997-capture-d-ecran.jpg');
        $section75->setArticle($article21);
        $manager->persist($section75);

        $section76 = new Section();
        $section76->setTitle("Un abonnement premium aux nombreux avantages");
        $section76->setDescription("Le Pack additionnel du Nintendo Switch Online permet, entre autres, de bénéficier de DLC bonus pour Splatoon 2, Animal Crossing : New Horizons mais aussi des circuits supplémentaires ajoutés à Mario Kart 8 Deluxe. Il permet également d'avoir accès aux émulateurs Game Boy Advance, Nintendo 64 et Mega Drive. Vu la manière dont la société japonaise propose des émulateurs de ses anciennes consoles, si une interface Gamecube voit le jour, il y a de fortes chances qu'elle soit disponible via cet abonnement premium.");
        $section76->setArticle($article21);
        $manager->persist($section76);

        $section77 = new Section();
        $section77->setTitle("Un abonnement premium aux nombreux avantages");
        $section77->setDescription("Le Pack additionnel du Nintendo Switch Online permet, entre autres, de bénéficier de DLC bonus pour Splatoon 2, Animal Crossing : New Horizons mais aussi des circuits supplémentaires ajoutés à Mario Kart 8 Deluxe. Il permet également d'avoir accès aux émulateurs Game Boy Advance, Nintendo 64 et Mega Drive. Vu la manière dont la société japonaise propose des émulateurs de ses anciennes consoles, si une interface Gamecube voit le jour, il y a de fortes chances qu'elle soit disponible via cet abonnement premium.");
        $section77->setArticle($article21);
        $manager->persist($section77);

        $section78 = new Section();
        $section78->setTitle("Conclusion");
        $section78->setDescription("En attendant, l'émulateur Mega Drive propose des classiques comme : Sonic 2, Golden Axe, Altered Beast, Flicky ou encore Kid Chameleon. Les jeux Nintendo 64 disponibles sont quant à eux bien plus nombreux, on retiendra : Mario 64, Ocarina of Time et Majora's Mask, Sin and Punishment, etc... Et même GoldenEye 007 et Pokémon Stadium jouables en ligne ! Pour ce qui est de l'émulateur GBA, nous avons des titres comme Zelda Minish Cap, Metroid Fusion, Mario & Luigi : Superstar Saga, Mario Kart : Super Circuit et Wario Ware Inc.");
        $section78->setArticle($article21);
        $manager->persist($section78);

        //reviews
        $review1 = new Review();
        $review1->setTitle('Ce jeu est vraiment bien');
        $review1->setContent('Ce jeu est super, je le recommande, il est très fun');
        $review1->setRate(5);
        $review1->setPublicationDate(new \DateTime('2022-12-19'));
        $manager->persist($review1);

        $review2 = new Review();
        $review2->setTitle('Ce jeu est vraiment nul');
        $review2->setContent('Ce jeu est nul, je ne le recommande pas, il est très nul');
        $review2->setRate(1);
        $review2->setPublicationDate(new \DateTime('2022-12-19'));
        $manager->persist($review2);

        $review3 = new Review();
        $review3->setTitle('Que des bugs');
        $review3->setContent('Ce jeu est super, mais il y a beaucoup de bugs');
        $review3->setRate(3);
        $review3->setPublicationDate(new \DateTime('2022-12-21'));
        $manager->persist($review3);

        $review4 = new Review();
        $review4->setTitle('C\'est de la merde');
        $review4->setContent('Vraiment nul on se fait chier');
        $review4->setRate(1);
        $review4->setPublicationDate(new \DateTime('2022-12-21'));
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

        // Save data in database
        $manager->flush();
    }
}
