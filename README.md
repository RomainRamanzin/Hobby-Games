
<div style="text-align:center; margin-bottom: 40px">
 <img src="public/asset/image/hobbygames.png" alt="Description de l'image" width="300">
</div>


# Hobby Games
Hobby Games est une plateforme web dédiée à l'univers du jeu vidéo.  
Ce projet a été réalisé dans le cadre d'un projet scolaire en développement web, offrant un lieu de partage, des critiques détaillées, des informations exclusives et les dernières actualités du monde du gaming. 

![Image de présentation](public/asset/image/website-capture.png)

## Fonctionnalités
Les différentes fonctionnalités présentes dans le projet :

- Afficher des actualités relatives aux jeux vidéo.
- Les administrateurs peuvent diffuser des tests de jeux.
- Les joueurs peuvent écrire des commentaires et noter des jeux.
- Créer un fil de discussion pour un jeu.
 

## Technologies Utilisées
Lors de la réalisation de ce projet, nous avons utilisés différentes technologies :

- **Symfony (6.3.^)** - Framework PHP pour le développement web.
- **Bootstrap 5** - Pour un design responsive et esthétique.
- **Base de données MySQL** - Stockage des données et gestion efficace.

## Installation et Utilisation

### Prérequis
Assurez-vous d'avoir installé les outils suivants sur votre machine :
- [Composer](https://getcomposer.org/download/) - Gestionnaire de dépendances PHP.
- [Symfony CLI](https://symfony.com/download) - Outil en ligne de commande pour Symfony.
- Base de données MySQL.

### Étapes d'Installation

1. **Clonage du Repository**
   ```bash
   git clone https://github.com/RomainRamanzin/Hobby-Games.git
   ```
2. **Installation des Dépendances avec Composer**
    ```bash
    cd HobbyGames
    composer install
    ```
3. **Configuration de la Base de Données**
- Créez une base de données MySQL pour le projet.
- Configurez les informations de la base de données dans le fichier .env.
    ```bash
    DATABASE_URL=mysql://user:password@localhost:3306/nom_de_la_base_de_donnees
    ```
4. **Exécution des Migrations pour Créer le Schéma de la Base de Données**
    ```bash
    symfony console make:migration
    symfony console doctrine:migrations:migrate
    ```

5. **Démarrage du Serveur Symfony**
    ```bash
    symfony server -d
    ```
6. **Accès au Site**
    Ouvrez votre navigateur web et entrez l'URL fournie par Symfony pour accéder à Hobby Games.

## Auteurs

- [Romain Ramanzin](https://github.com/RomainRamanzin) - Développeur Full Stack
- [Sinan Yazici](https://github.com/sinan-yazici) - Développeur Full Stack

## Licence

Ce projet est sous licence GNU GPLv3.