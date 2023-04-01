<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308151058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, writed_by_id INT NOT NULL, validated_by_id INT DEFAULT NULL, cover VARCHAR(255) NOT NULL, is_valided TINYINT(1) NOT NULL, publication_date DATETIME NOT NULL, last_lodified_date DATETIME NOT NULL, number_of_views INT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_23A0E66E48FD905 (game_id), INDEX IDX_23A0E667B1B5357 (writed_by_id), INDEX IDX_23A0E66C69DE5E5 (validated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_sanction (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, editor_id INT NOT NULL, name VARCHAR(255) NOT NULL, release_date DATE DEFAULT NULL, description LONGTEXT NOT NULL, poster VARCHAR(255) NOT NULL, age_limit INT DEFAULT NULL, INDEX IDX_232B318C6995AC4C (editor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_platform (game_id INT NOT NULL, platform_id INT NOT NULL, INDEX IDX_92162FEDE48FD905 (game_id), INDEX IDX_92162FEDFFE6496F (platform_id), PRIMARY KEY(game_id, platform_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_type (game_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_67CB3B05E48FD905 (game_id), INDEX IDX_67CB3B05C54C8C93 (type_id), PRIMARY KEY(game_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_picture (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, picture VARCHAR(255) NOT NULL, INDEX IDX_831930A6E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform (id INT AUTO_INCREMENT NOT NULL, brand_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, INDEX IDX_3952D0CB44F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publication (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, game_id INT NOT NULL, review_id INT NOT NULL, INDEX IDX_AF3C6779A76ED395 (user_id), INDEX IDX_AF3C6779E48FD905 (game_id), UNIQUE INDEX UNIQ_AF3C67793E2E969B (review_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, rate INT NOT NULL, publication_date DATETIME NOT NULL, is_deleted TINYINT(1) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sanction (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, user_id INT NOT NULL, comment LONGTEXT NOT NULL, ban_duration INT NOT NULL, INDEX IDX_6D6491AF12469DE2 (category_id), INDEX IDX_6D6491AFA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) DEFAULT NULL, rate INT DEFAULT NULL, INDEX IDX_2D737AEF7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, pseudo VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, account_creation_date DATETIME NOT NULL, avatar VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E667B1B5357 FOREIGN KEY (writed_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66C69DE5E5 FOREIGN KEY (validated_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C6995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id)');
        $this->addSql('ALTER TABLE game_platform ADD CONSTRAINT FK_92162FEDE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_platform ADD CONSTRAINT FK_92162FEDFFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_type ADD CONSTRAINT FK_67CB3B05E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_type ADD CONSTRAINT FK_67CB3B05C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_picture ADD CONSTRAINT FK_831930A6E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE platform ADD CONSTRAINT FK_3952D0CB44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C6779A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C6779E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C67793E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sanction ADD CONSTRAINT FK_6D6491AF12469DE2 FOREIGN KEY (category_id) REFERENCES category_sanction (id)');
        $this->addSql('ALTER TABLE sanction ADD CONSTRAINT FK_6D6491AFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66E48FD905');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E667B1B5357');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66C69DE5E5');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C6995AC4C');
        $this->addSql('ALTER TABLE game_platform DROP FOREIGN KEY FK_92162FEDE48FD905');
        $this->addSql('ALTER TABLE game_platform DROP FOREIGN KEY FK_92162FEDFFE6496F');
        $this->addSql('ALTER TABLE game_type DROP FOREIGN KEY FK_67CB3B05E48FD905');
        $this->addSql('ALTER TABLE game_type DROP FOREIGN KEY FK_67CB3B05C54C8C93');
        $this->addSql('ALTER TABLE game_picture DROP FOREIGN KEY FK_831930A6E48FD905');
        $this->addSql('ALTER TABLE platform DROP FOREIGN KEY FK_3952D0CB44F5D008');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C6779A76ED395');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C6779E48FD905');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C67793E2E969B');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE sanction DROP FOREIGN KEY FK_6D6491AF12469DE2');
        $this->addSql('ALTER TABLE sanction DROP FOREIGN KEY FK_6D6491AFA76ED395');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEF7294869C');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE category_sanction');
        $this->addSql('DROP TABLE editor');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_platform');
        $this->addSql('DROP TABLE game_type');
        $this->addSql('DROP TABLE game_picture');
        $this->addSql('DROP TABLE platform');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE sanction');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
    }
}
