<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502135923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, nomuser VARCHAR(255) NOT NULL, imagec VARCHAR(255) DEFAULT \'NULL\', descriptionc VARCHAR(255) NOT NULL, datec DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, analyse_co VARCHAR(255) DEFAULT \'NULL\', datec_ts DATETIME DEFAULT CURRENT_TIMESTAMP, INDEX IDX_67F068BC4B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, sujet VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, nbr_jaime INT NOT NULL, image VARCHAR(255) DEFAULT \'NULL\', nom_user VARCHAR(255) NOT NULL, date_p DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, communaute VARCHAR(255) NOT NULL, analyse_po VARCHAR(255) DEFAULT \'NULL\', liked INT DEFAULT NULL, badlevel INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC4B89032C');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE post');
    }
}
