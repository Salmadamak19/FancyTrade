<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510014625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FEEAA8803');
        $this->addSql('CREATE TABLE conv (id INT AUTO_INCREMENT NOT NULL, idconv_user INT NOT NULL, idconv_user2 INT NOT NULL, INDEX IDX_94499CCE4513A06 (idconv_user), INDEX IDX_94499CCF3524A02 (idconv_user2), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conv ADD CONSTRAINT FK_94499CCE4513A06 FOREIGN KEY (idconv_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE conv ADD CONSTRAINT FK_94499CCF3524A02 FOREIGN KEY (idconv_user2) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE conversation DROP FOREIGN KEY FK_8A8E26E9E4513A06');
        $this->addSql('ALTER TABLE conversation DROP FOREIGN KEY FK_8A8E26E9F3524A02');
        $this->addSql('DROP TABLE conversation');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FEEAA8803');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FEEAA8803 FOREIGN KEY (to_conv) REFERENCES conv (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FEEAA8803');
        $this->addSql('CREATE TABLE conversation (id INT AUTO_INCREMENT NOT NULL, idconv_user INT NOT NULL, idconv_user2 INT NOT NULL, INDEX IDX_8A8E26E9E4513A06 (idconv_user), INDEX IDX_8A8E26E9F3524A02 (idconv_user2), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E9E4513A06 FOREIGN KEY (idconv_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E9F3524A02 FOREIGN KEY (idconv_user2) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE conv DROP FOREIGN KEY FK_94499CCE4513A06');
        $this->addSql('ALTER TABLE conv DROP FOREIGN KEY FK_94499CCF3524A02');
        $this->addSql('DROP TABLE conv');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FEEAA8803');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FEEAA8803 FOREIGN KEY (to_conv) REFERENCES conversation (id)');
    }
}
