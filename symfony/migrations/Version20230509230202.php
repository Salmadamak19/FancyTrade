<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230509230202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conversation (id INT AUTO_INCREMENT NOT NULL, idconv_user INT NOT NULL, idconv_user2 INT NOT NULL, INDEX IDX_8A8E26E95B09067D (idconv_user), INDEX IDX_8A8E26E9EA3686FA (idconv_user2), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id_message INT AUTO_INCREMENT NOT NULL, from_user INT NOT NULL, to_conv INT NOT NULL, text VARCHAR(255) NOT NULL, date_time DATETIME NOT NULL, INDEX IDX_B6BD307F2130303A (from_user), INDEX IDX_B6BD307FA15E2332 (to_conv), PRIMARY KEY(id_message)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E95B09067D FOREIGN KEY (idconv_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E9EA3686FA FOREIGN KEY (idconv_user2) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F2130303A FOREIGN KEY (from_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA15E2332 FOREIGN KEY (to_conv) REFERENCES conversation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conversation DROP FOREIGN KEY FK_8A8E26E95B09067D');
        $this->addSql('ALTER TABLE conversation DROP FOREIGN KEY FK_8A8E26E9EA3686FA');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F2130303A');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA15E2332');
        $this->addSql('DROP TABLE conversation');
        $this->addSql('DROP TABLE message');
    }
}
