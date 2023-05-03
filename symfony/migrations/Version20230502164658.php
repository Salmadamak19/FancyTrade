<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502164658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BFE5197E49 FOREIGN KEY (user_request_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BFEB4681A8 FOREIGN KEY (produit_request_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A76ED395 FOREIGN KEY (user_id) REFERENCES user (id_user)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BFA76ED395');
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BFE5197E49');
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BFEB4681A8');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A76ED395');
    }
}
