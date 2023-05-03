<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502164536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE echange (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, user_id INT DEFAULT NULL, user_request_id INT DEFAULT NULL, produit_request_id INT DEFAULT NULL, statut VARCHAR(255) NOT NULL, date_echange DATE NOT NULL, INDEX IDX_B577E3BFF347EFB (produit_id), INDEX IDX_B577E3BFA76ED395 (user_id), INDEX IDX_B577E3BFE5197E49 (user_request_id), INDEX IDX_B577E3BFEB4681A8 (produit_request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, categorie VARCHAR(255) NOT NULL, valeur INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_29A5EC27A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BFF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BFE5197E49 FOREIGN KEY (user_request_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BFEB4681A8 FOREIGN KEY (produit_request_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BFF347EFB');
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BFA76ED395');
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BFE5197E49');
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BFEB4681A8');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A76ED395');
        $this->addSql('DROP TABLE echange');
        $this->addSql('DROP TABLE produit');
    }
}
