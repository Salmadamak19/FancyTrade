<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230509231708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conversation CHANGE idconv_user idconv_user INT NOT NULL, CHANGE idconv_user2 idconv_user2 INT NOT NULL');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E9E4513A06 FOREIGN KEY (idconv_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E9F3524A02 FOREIGN KEY (idconv_user2) REFERENCES user (id_user)');
        $this->addSql('CREATE INDEX IDX_8A8E26E9E4513A06 ON conversation (idconv_user)');
        $this->addSql('CREATE INDEX IDX_8A8E26E9F3524A02 ON conversation (idconv_user2)');
        $this->addSql('ALTER TABLE message CHANGE from_user from_user INT NOT NULL, CHANGE to_conv to_conv INT NOT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF8050BAA FOREIGN KEY (from_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FEEAA8803 FOREIGN KEY (to_conv) REFERENCES conversation (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FF8050BAA ON message (from_user)');
        $this->addSql('CREATE INDEX IDX_B6BD307FEEAA8803 ON message (to_conv)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conversation DROP FOREIGN KEY FK_8A8E26E9E4513A06');
        $this->addSql('ALTER TABLE conversation DROP FOREIGN KEY FK_8A8E26E9F3524A02');
        $this->addSql('DROP INDEX IDX_8A8E26E9E4513A06 ON conversation');
        $this->addSql('DROP INDEX IDX_8A8E26E9F3524A02 ON conversation');
        $this->addSql('ALTER TABLE conversation CHANGE idconv_user idconv_user VARCHAR(255) NOT NULL, CHANGE idconv_user2 idconv_user2 VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF8050BAA');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FEEAA8803');
        $this->addSql('DROP INDEX IDX_B6BD307FF8050BAA ON message');
        $this->addSql('DROP INDEX IDX_B6BD307FEEAA8803 ON message');
        $this->addSql('ALTER TABLE message CHANGE from_user from_user VARCHAR(255) NOT NULL, CHANGE to_conv to_conv VARCHAR(255) NOT NULL');
    }
}
