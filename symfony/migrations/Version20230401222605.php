<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230401222605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA74B4A4BC9');
        $this->addSql('DROP INDEX UNIQ_3BAE0AA74B4A4BC9 ON event');
        $this->addSql('ALTER TABLE event ADD place_id INT DEFAULT NULL, DROP event_place_id, DROP image, DROP date');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7DA6A219 FOREIGN KEY (place_id) REFERENCES event_place (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA7DA6A219 ON event (place_id)');
        $this->addSql('ALTER TABLE event_place DROP image');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7DA6A219');
        $this->addSql('DROP INDEX UNIQ_3BAE0AA7DA6A219 ON event');
        $this->addSql('ALTER TABLE event ADD event_place_id INT NOT NULL, ADD image VARCHAR(255) NOT NULL, ADD date DATETIME NOT NULL, DROP place_id');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA74B4A4BC9 FOREIGN KEY (event_place_id) REFERENCES event_place (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA74B4A4BC9 ON event (event_place_id)');
        $this->addSql('ALTER TABLE event_place ADD image VARCHAR(255) NOT NULL');
    }
}
