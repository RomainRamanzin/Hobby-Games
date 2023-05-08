<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230504085737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD last_modified_date DATETIME DEFAULT NULL, DROP last_lodified_date, DROP number_of_views, CHANGE writed_by_id writed_by_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD last_lodified_date DATETIME NOT NULL, ADD number_of_views INT NOT NULL, DROP last_modified_date, CHANGE writed_by_id writed_by_id INT NOT NULL');
    }
}
