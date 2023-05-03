<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502173135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404C54C8C93');
        $this->addSql('DROP INDEX IDX_CE606404C54C8C93 ON reclamation');
        $this->addSql('ALTER TABLE reclamation ADD message VARCHAR(180) NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD status TINYINT(1) NOT NULL, ADD image VARCHAR(200) DEFAULT NULL, DROP object, DROP contenu, CHANGE target user_id INT DEFAULT NULL, CHANGE type_id category_id INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404A76ED395 FOREIGN KEY (user_id) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE60640412469DE2 FOREIGN KEY (category_id) REFERENCES reclamation_category (id)');
        $this->addSql('CREATE INDEX IDX_CE606404A76ED395 ON reclamation (user_id)');
        $this->addSql('CREATE INDEX IDX_CE60640412469DE2 ON reclamation (category_id)');
        $this->addSql('ALTER TABLE reclamation_category CHANGE nom nom VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404A76ED395');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE60640412469DE2');
        $this->addSql('DROP INDEX IDX_CE606404A76ED395 ON reclamation');
        $this->addSql('DROP INDEX IDX_CE60640412469DE2 ON reclamation');
        $this->addSql('ALTER TABLE reclamation ADD object VARCHAR(255) NOT NULL, ADD contenu VARCHAR(255) NOT NULL, DROP message, DROP created_at, DROP status, DROP image, CHANGE category_id type_id INT NOT NULL, CHANGE user_id target INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404C54C8C93 FOREIGN KEY (type_id) REFERENCES reclamation_category (id)');
        $this->addSql('CREATE INDEX IDX_CE606404C54C8C93 ON reclamation (type_id)');
        $this->addSql('ALTER TABLE reclamation_category CHANGE nom nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7A76ED395');
    }
}
