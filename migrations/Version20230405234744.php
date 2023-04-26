<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405234744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire CHANGE post_id post_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentairee DROP FOREIGN KEY fk_id_userr');
        $this->addSql('ALTER TABLE commentairee DROP FOREIGN KEY fk_poste');
        $this->addSql('ALTER TABLE commentairee CHANGE id_poste id_poste INT DEFAULT NULL, CHANGE id_user id_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentairee ADD CONSTRAINT FK_2D6A75956B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE commentairee ADD CONSTRAINT FK_2D6A7595920C4E9B FOREIGN KEY (id_poste) REFERENCES poste (id)');
        
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE commentaire CHANGE post_id post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentairee CHANGE id_user id_user INT NOT NULL, CHANGE id_poste id_poste INT NOT NULL');
        $this->addSql('ALTER TABLE commentairee ADD CONSTRAINT fk_id_userr FOREIGN KEY (id_user) REFERENCES user (id_user) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentairee ADD CONSTRAINT fk_poste FOREIGN KEY (id_poste) REFERENCES poste (id) ON UPDATE CASCADE ON DELETE CASCADE');
    
       $this->addSql('ALTER TABLE post CHANGE liked liked INT DEFAULT 0, CHANGE badlevel badlevel INT DEFAULT 0');
        $this->addSql('ALTER TABLE poste CHANGE id_user id_user INT NOT NULL');
        
    }
}
